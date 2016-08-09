<?php
	require_once '../db_connection.php';
	require_once 'streamflix_session.php';

	session_start();
    $msg = array();
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
	    if (is_null($username) || is_null($password)) {
	        $msg[] =  "Please retry login.";
	    } else {
	        $insert_msg = '';
	        $added = insert_user($dbConn, $username, $password, &$insert_msg);
	        if ($added) {
	            $_SESSION['username'] = $username;
	            header('Location: streamflix.php');
	        } else {
	            // fail
	            $msg[] = $insert_msg;
	        }
	    }
	}
?>
		
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Streamflix Registration</title>
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
                <legend>Register:</legend>
                username: <input type="text" id="name" maxlength="255" pattern="[\w\@_\.-]+"  name="username" />
                password: <input type="password" id="password" maxlength="127" pattern="[!-~]+" name="password" /><br/>
                <input class="submit" type="submit" name="submit" value="Submit">
            </fieldset>     
            </form>
        </header>
        <nav><a href="streamflix_login.php">Login</a></nav>
    </body>
</html>