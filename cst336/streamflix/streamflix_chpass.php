<?php
	require_once '../db_connection.php';
	require_once 'streamflix_session.php';

	session_start();
    $msg = array();
	/* Check to see if POST variable exists */
	if (array_key_exists('username', $_SESSION) &&
	   array_key_exists('password', $_POST) && !empty($_POST['password']) &&
	    array_key_exists('new_password', $_POST) && !empty($_POST['new_password'])) {
	    /**
	     * Confirm input
	     */
	    $matches = $username = null; 
	    preg_match('/^([\w\@_\.-]+)$/', $_SESSION['username'], $matches);
	    if (array_key_exists('1', $matches)) {
	        $username = $matches['1'];
	    } else {
	        $msg[] =  "Invalid username.";
	    }
	    $password = null;
	    /* hopefully you're not trying unicode passwords */
	    preg_match('/^([!-~]+)$/', $_POST['password'], $matches);
	    if (array_key_exists('1', $matches)) {
	        $password = $matches['1'];
	    } else {
	        $msg[] = "Invalid password.";
	    }
        $new_password = null;
        /* hopefully you're not trying unicode passwords */
        preg_match('/^([!-~]+)$/', $_POST['new_password'], $matches);
        if (array_key_exists('1', $matches)) {
            $new_password = $matches['1'];
        } else {
            $msg[] = "Invalid password.";
        }
	    if (is_null($username) || is_null($new_password)) {
	        $msg[] =  "Please retry login.";
	    } else {
	        $insert_msg = '';
	        $added = chpass_user($dbConn, $username, $password, $new_password,
	           &$insert_msg);
            $msg[] = $insert_msg;
	    }
	}
?>
		
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Streamflix Change Password</title>
        <link rel="stylesheet" type="text/css" href="streamflix.css">
    </head>
    <body>
        <header>
            <form method="post" action="#">
<?php
if (count($msg)){
    $msg_txt = join(' ', $msg);
    echo "<div>$msg_txt</div>\n";
}
?>
            <fieldset>
                <legend>Change Password:</legend>
                Current password: <input type="password" id="password" maxlength="127" pattern="[!-~]+" name="password" /><br/>
                New password: <input type="password" id="new_password" maxlength="127" pattern="[!-~]+" name="new_password" /><br/>
                <input class="submit" type="submit" name="submit" value="Submit">
            </fieldset>     
            </form>
        </header>
        <nav>
            <a href="streamflix_logout.php">Logout</a>
            <a href="streamflix.php">Home</a>
        </nav>
    </body>
</html>