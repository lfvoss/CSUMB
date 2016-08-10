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
    CREATE TABLE `Z_Users` (
        user_id INT NOT NULL AUTO_INCREMENT,
        username VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        PRIMARY KEY (user_id)
	)
END_SQL;
    $dbConn->exec($users_table_sql);
    $users_table_idx_sql = <<<END_SQL
        CREATE INDEX Z_Users_username_idx ON Z_Users (username) USING HASH
END_SQL;
    $dbConn->exec($users_table_idx_sql);
}


function insert_user($dbConn, $username, $password, $msg) {
    $ret = false;
    $insert_user_sql = <<<END_SQL
	INSERT INTO `Z_Users` (`username`, `password`)
	VALUES
	(:username, :password)
END_SQL;

    $stmt = $dbConn->prepare($insert_user_sql);
    try {
        $stmt->execute(array(":username" => $username,
            ":password" => hash_sha512($password)));                                               
        $msg = "Successfully created new user $username.";
        $ret = true;
    } catch (PDOException $e) {
        $msg = "Failed to create a new user. Please try again. $e";
    }
    return $ret;
}


function chpass_user($dbConn, $username, $password, $new_password, $msg) {
    $ret = false;
    $salt = '';
    if (chk_user($dbConn, $username, $password, &$salt)) {
        $update_user_sql = <<<END_SQL
        UPDATE `Z_Users`
        SET
            password = :new_password
        WHERE
            username = :username
            AND password = :password
END_SQL;

        $stmt = $dbConn->prepare($update_user_sql);
        try {
            $stmt->execute(array(
                ":new_password" => hash_sha512($new_password),
                ":username" => $username,
                ":password" => hash_sha512($password, $salt))
            );
            $count = $stmt->rowCount();
            if ($count == 0) {
                $msg = "Failed to update password.";
            }else {
                $msg = "Updated password.";
                $ret = true;
            }
        } catch (PDOException $e) {
            $msg = "Failed to update password.";
        }
    }
    return $ret;
}


function chk_user($dbConn, $username, $password, $pass_out = null) {
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
    try {
        $stmt->execute(array(":username" => $username));
        $record = $stmt->fetch();
        /**
         * Perform the same amount of work regardless of whether the user
         * was found.
         */
        $ret = hash_cmp($password, empty($record) ? '' : $record['password']);
        if ($ret && !empty($record) && !is_null($pass_out)) {
            $pass_out = $record['password'];
        }
    } catch (PDOException $e) {
        $ret = false;
    }
    return $ret;
}


function create_log_table($dbConn)
{
	$log_table_sql = <<<END_SQL
    CREATE TABLE `Z_Users_Log` (
        log_id INT NOT NULL AUTO_INCREMENT,
        user_id INT NOT NULL,
        login_time TIMESTAMP NOT NULL,
        PRIMARY KEY (log_id),
        FOREIGN KEY (user_id)
        	REFERENCES z_users(user_id)
	)
END_SQL;
    $dbConn->exec($log_table_sql);
}


function create_successful_login_entry($dbConn, $username)
{
	$insert_log_sql = <<<END_SQL
	INSERT INTO `Z_Users_Log` (user_id) VALUES 
	((select user_id from z_users where username = :username))
END_SQL;
    $stmt = $dbConn->prepare($insert_log_sql);
    $stmt->execute(array(":username" => $username)); 
}
?>