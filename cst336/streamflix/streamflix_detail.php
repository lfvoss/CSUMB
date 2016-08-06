<?php
	require '../db_connection.php';
	
	function getMovie($id){
	    global $dbConn;
	    
	    $sql = "SELECT *
	            FROM Z_Movies
	            WHERE movie_id = :id";
	    $stmt = $dbConn -> prepare($sql);
		$stmt -> execute(array(":id"=>$_GET['movie_id']));
		
		//implement better error handling here, best option likely try/catch above
	    return $stmt->fetchAll();
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		
		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
		<title>StreamFlix Movie Detail Page</title>
		<meta name="description" content="">
		<meta name="author" content="lara4594">
		
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		
		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	</head>
	
	<body>
		<div>
			<?php
				if (isset($_GET['movie_id'])) { //checks whether we're coming from "add movie" form
					$result = getMovie($_GET['movie_id']);
					
					if(!empty($result))
					{
						$movie = array_shift($result);
											
						echo "<h1>" . $movie['title'] . "</h1>";
						echo "<h2>" . $movie['description'] . "</h2>";
						
					}
				}
			?>
		</div>
	</body>
</html>