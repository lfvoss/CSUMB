<?php
	session_start();
	
	require '../db_connection.php';
	
	if(!isset($_SESSION['username'])){
		header("Location: streamflix_login.php");
	}
	
	function getMovie($id){
	    global $dbConn;
	    
	    $sql = "SELECT *
	            FROM Z_Movies
	            WHERE movie_id = :id";
	    $stmt = $dbConn -> prepare($sql);
		$stmt -> execute(array(":id"=>$id));
		
		//implement better error handling here, best option likely try/catch above
	    return $stmt->fetchAll();
	}
	
	function getGenres($id){
		global $dbConn;
		
	    $sql = "SELECT DISTINCT name
	            FROM 	Z_Movie_Genres, Z_Genres
	            WHERE 	Z_Movie_Genres.movie_id = :id AND
					  	Z_Movie_Genres.genre_id = Z_Genres.genre_id";
	    $stmt = $dbConn -> prepare($sql);
		$stmt -> execute(array(":id"=>$id));
		
		//implement better error handling here, best option likely try/catch above
	    
	    return $stmt->fetchAll();
	}
	
	function getMovieAssets($id){
		global $dbConn;
		
	    $sql = "SELECT DISTINCT Z_Roles.name as role, Z_Assets.name as name
	            FROM 	Z_Movie_Assets, Z_Roles, Z_Assets
	            WHERE 	Z_Movie_Assets.movie_id = :id AND
					  	Z_Movie_Assets.role_id = Z_Roles.role_id AND
						Z_Movie_Assets.asset_id = Z_Assets.asset_id";
	    $stmt = $dbConn -> prepare($sql);
		$stmt -> execute(array(":id"=>$id));
		
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
						$movie = array_shift($result); ?>
											
						<h1><?php echo $movie['title'] ?></h1>
						<h2><?php echo $movie['description'] ?></h2>
						<table>
							<tr>
								<th>Year Released:</th>
								<td><?php echo $movie['year'] ?></td>
							</tr>
							<tr>
								<th>Rating:</th>
								<td><?php echo $movie['rating'] ?></td>
							</tr>
							<tr>
								<th>Running Time:</th>
								<td><?php echo $movie['length'] ?></td>
							</tr>
							<tr>
								<th>Genre:</th>
								<?php foreach(getGenres($_GET['movie_id']) as $genre) { ?>
									<td><?php echo $genre['name'] ?></td>	
								<?php } ?>
							</tr>
						</table>
						<h3>Contributors:</h3>
						<table>
							<?php foreach(getMovieAssets($_GET['movie_id']) as $asset) { ?>
								<tr>
									<th><?php echo $asset['role'] ?></th>
									<td><?php echo $asset['name'] ?></td>
								</tr>
							<?php } ?>
						</table>	
					<?php } ?>
			<?php } ?>
		</div>
	</body>
</html>