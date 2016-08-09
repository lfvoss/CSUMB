<?php
	require_once '../db_connection.php';
	require_once 'streamflix_session.php';

	session_start();
	/* Check to see if POST variable exists */
	if (array_key_exists('username', $_POST) && !empty($_POST['username']) &&
	    array_key_exists('password', $_POST) && !empty($_POST['password'])) {
	    /**
	     * Confirm input
	     */
	    $matches = $username = null; 
	    preg_match('/^([\w\@_\.-]+)$/', $_POST['username'], $matches);
	    if (array_key_exists('1', $matches)) {
	        $username = $matches['1'];
	    } else {
	        echo "<div>Invalid username.</div>\n";
	    }
	    $password = null;
	    /* hopefully you're not trying unicode passwords */
	    preg_match('/^([!-~]+)$/', $_POST['password'], $matches);
	    if (array_key_exists('1', $matches)) {
	        $password = $matches['1'];
	    } else {
	        echo "<div>Invalid password.</div>\n";
	    }
	    if (is_null($username) || is_null($password)) {
	        echo "<div>Please retry login.</div>\n";
	    } else {
	        $found = chk_user($dbConn, $username, $password);
	        if ($found) {
	            $_SESSION['username'] = $username;
	            header('Location: streamflix.php');
	        } else {
	            // fail
	            echo "<div>Please retry login.</div>\n";
	        }
	    }
	}
?>
		
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Streamflix</title>
        <link rel="stylesheet" type="text/css" href="streamflix.css">
    </head>
    <body>
        <div>
        <form method="post" action="#">
            <div>
                username: <input type="text" id="name" name="username" />
            </div>
            <div>
                password: <input type="password" id="password" name="password" />
            </div>
            <button class="submit" type="submit" name="Login" value="submit">Submit</button>
        </form>
        </div>

    </body>
</html>