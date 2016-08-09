<?php
/* directory needs to be writable by user 'apache' */
define('SESSION_PATH', '.sessions');
function set_session_path() {
    session_save_path(SESSION_PATH);
}
function hash_sha512($pword, $salt = null) {
    /**
     * CRYPT_SHA512 wrapper that generates 96 bit salts.
     * XXX not cryptographically strong XXX
     */
    assert(CRYPT_SHA512);
    if (is_null($salt)) {
        /* 64 character map */
        $salt_alphabet = './0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        /* Get 6 * 16 bits of randomness */
        $bytes = unpack('S6', openssl_random_pseudo_bytes(12));
        $chars = array();
        $remainder = 0;
        $r_count = 0;
        foreach ($bytes as $ushort) {
            /* Start with 16 bits. Cut off the first 12 */
            $chars[] = $salt_alphabet[$ushort & 63];
            $ushort >>= 6;
            $chars[] = $salt_alphabet[$ushort & 63];
            $ushort >>= 6;
            /* Accumulate the remaining 4 bits. */
            if ($r_count > 0) {
                $remainder <<= 4;
            }
            $remainder |= $ushort & 15;
            $r_count += 4;
            /**
             * Trim off 6 bits every time we accumulate enough remaining bits.
             */
            if ($r_count >= 6) {
                $chars[] = $salt_alphabet[$remainder & 63];
                $remainder >>= 6;
                $r_count -= 6;
            }
        }
        assert($r_count == 0);
        /* The extra '' are to fence post $'s */
        $salt = join('$', array('','6',join('', $chars), ''));
    }
    $hash = crypt($pword, $salt);
    return $hash;
}
function hash_cmp($pword, $hash) {
    $pword_hash = hash_sha512($pword, $hash);
    return strcmp($pword_hash, $hash) == 0;
}
function create_users_table($dbConn) {
    $users_table_sql = <<<END_SQL
	create table `Z_Users`(
	    user_id int not null,
	    username varchar(255) not null unique,
	    password varchar(255) not null,
	    primary key (user_id)
	)
END_SQL;
    $dbConn->exec($users_table_sql);
    $users_table_idx_sql = <<<END_SQL
        create index Z_Users_username_idx ON Z_Users (username) using hash
END_SQL;
    $dbConn->exec($users_table_idx_sql);
}
function insert_user($dbConn, $username, $password) {
    $insert_user_sql = <<<END_SQL
	INSERT INTO `Z_Users` (`username`, `password`)
	VALUES
	(:username, :password)
END_SQL;
    $stmt = $dbConn->prepare($insert_user_sql);
    $stmt->execute(array(":username" => $username,
	":password" => hash_sha512($password)));
}
function chk_user($dbConn, $username, $password) {
    $ret = 0;
    $user_sql = <<<"END_SQL"
        SELECT
            user_id,
            username,
            password
        FROM (Z_Users)
        WHERE
            username = :username
        LIMIT 1
END_SQL;
    $stmt = $dbConn->prepare($user_sql);
    $stmt->execute(array(":username" => $username));
    $record = $stmt->fetch();
    /**
     * Perform the same amount of work regardless of whether the user
     * was found.
     */
    $ret = hash_cmp($password, empty($record) ? '' : $record['password']);
    return $ret;
}
?>