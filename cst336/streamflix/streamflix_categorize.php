<?php
    require '../db_connection.php';
	
	function getMovies(){
	    global $dbConn;
	    
	    $sql = "SELECT movie_id, title
	            FROM Z_Movies
	            ORDER BY title";
	    $stmt = $dbConn -> prepare($sql);
	    $stmt -> execute();
		
	    return $stmt->fetchAll();
	}
	
	function getGenres(){
	    global $dbConn;
	    
	    $sql = "SELECT genre_id, name
	            FROM Z_Genres
	            ORDER BY name";
	    $stmt = $dbConn -> prepare($sql);
	    $stmt -> execute();
		
	    return $stmt->fetchAll();
	}
	
	function getAssets(){
	    global $dbConn;
	    
	    $sql = "SELECT asset_id, name
	            FROM Z_Assets
	            ORDER BY name";
	    $stmt = $dbConn -> prepare($sql);
	    $stmt -> execute();
		
	    return $stmt->fetchAll();
	}
	
	function getRoles(){
	    global $dbConn;
	    
	    $sql = "SELECT role_id, name
	            FROM Z_Roles
	            ORDER BY name";
	    $stmt = $dbConn -> prepare($sql);
	    $stmt -> execute();
		
	    return $stmt->fetchAll();
	}
	
	if (isset($_POST['assignGenre'])) { //checks whether we're coming from "assign Genre" form
	
		$sql = "INSERT INTO `Z_Movie_Genres` (`movie_id`, `genre_id`) 
				VALUES
				(:movieId, :genreId)";
		$stmt = $dbConn -> prepare($sql);
		
		try {
			$stmt -> execute(array(":movieId"=>$_POST['movie'],
							   	   ":genreId"=>$_POST['genre']));
								   	 				
			echo "RECORD UPDATED!! <br> <br>"; 

		} catch (PDOException $e) {
   			if ($e->errorInfo[1] == 1062) {
      			echo "<br>That movie has already been assigned that genre, please make a different selection.";
   			} else {
      			echo "<br>An error occured.";
   			}
		}
	}
	
	if (isset($_POST['assignRole'])) { //checks whether we're coming from "assign Genre" form
	
		$sql = "INSERT INTO `Z_Movie_Assets` (`movie_id`, `asset_id`, `role_id`)
				VALUES
				(:movieId, :assetId, :roleId)";
		$stmt = $dbConn -> prepare($sql);
		
		try {
			$stmt -> execute(array(":movieId"=>$_POST['movie'],
								   ":assetId"=>$_POST['asset'],
							   	   ":roleId"=>$_POST['role']));
								   	 				
			echo "RECORD UPDATED!! <br> <br>"; 

		} catch (PDOException $e) {
   			if ($e->errorInfo[1] == 1062) {
      			echo "<br>That asset has already been assigned that role in that movie, please make a different selection.";
   			} else {
      			echo "<br>An error occured.";
   			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		
		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
		<title>updateStadium</title>
		<meta name="description" content="">
		<meta name="author" content="lara4594">
		
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		
		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	</head>
	
	<body>
		<div>

			<h2>Assign a Genre to a Movie</h2>
			<form method="post">
				<table>
					<tr>
						<th>Movie</th>
						<th>Genre</th>
					</tr>
					<tr>
						<td>
			         		<select name="movie">
				            	<?php            
				                	$movies = getMovies();
				                                          
									foreach ($movies as $movie) {
								    	echo "<option value='" . $movie['movie_id'] . "' >" . $movie['title'] . "</option>";
									}               
				              	?>
		             		</select>
						</td>
						<td>
			         		<select name="genre">
				            	<?php            
				                	$genres = getGenres();
				                                          
									foreach ($genres as $genre) {
								    	echo "<option value='" . $genre['genre_id'] . "' >" . $genre['name'] . "</option>";
									}               
				              	?>
		             		</select>
						</td>
						<td>
							<input type="submit" name="assignGenre" value="Assign Genre"> 
						</td>
					</tr>
				</table>		
			</form>
			
			<h2>Assign An Asset's Role in a Movie</h2>
			<form method="post">
				<table>
					<tr>
						<th>Movie</th>
						<th>Asset</th>
						<th>Role</th>
					</tr>
					<tr>
						<td>
			         		<select name="movie">
				            	<?php            
				                	$movies = getMovies();
				                                          
									foreach ($movies as $movie) {
								    	echo "<option value='" . $movie['movie_id'] . "' >" . $movie['title'] . "</option>";
									}               
				              	?>
		             		</select>
						</td>
						<td>
			         		<select name="asset">
				            	<?php            
				                	$assets = getAssets();
				                                          
									foreach ($assets as $asset) {
								    	echo "<option value='" . $asset['asset_id'] . "' >" . $asset['name'] . "</option>";
									}               
				              	?>
		             		</select>
						</td>
						<td>
			         		<select name="role">
				            	<?php            
				                	$roles = getRoles();
				                                          
									foreach ($roles as $role) {
								    	echo "<option value='" . $role['role_id'] . "' >" . $role['name'] . "</option>";
									}               
				              	?>
		             		</select>
						</td>
						<td>
							<input type="submit" name="assignRole" value="Assign Role"> 
						</td>
					</tr>
				</table>
			</form>
			
				
		</div>
	</body>
</html>