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
	
	if (isset($_POST['addMovie'])) { //checks whether we're coming from "add movie" form
	
		// need more logic here to check if fields are actually set
		$sql = "INSERT INTO `Z_Movies` (`title`, `year`, `description`, `rating`, `length`) VALUES
				(:title, :year, :description, :rating, :length)";
		$stmt = $dbConn -> prepare($sql);
		
		try {
			$stmt -> execute(array(":title"=>$_POST['movieTitle'],
							   	   ":year"=>$_POST['movieYear'],
							   	   ":description"=>$_POST['movieDesc'],
								   ":rating"=>$_POST['movieRating'],
								   ":length"=>$_POST['movieLength']));
								   	 				
			echo "<br>RECORD Added!! <br> <br>"; 

		} catch (PDOException $e) {
   			if ($e->errorInfo[1] == 1062) {
      			echo "<br>That movie already exists.";
   			} else {
      			echo "<br>An error occured.";
				echo $e;
   			}
		}
	}
	
	if (isset($_POST['delete'])) { //checks whether the delete button was clicked
		$sql = "DELETE FROM Z_Movie_Assets
	            WHERE movie_id = :movie_id;
	            DELETE FROM Z_Movie_Genres
	            WHERE movie_id = :movie_id;
	            DELETE FROM Z_Movies
	            WHERE movie_id = :movie_id";
				
		$stmt = $dbConn -> prepare($sql);
		$stmt -> execute( array(":movie_id"=> $_POST['movie_id']));
		echo "Movie Deleted! <br /><br />";    
	}
	
	if (isset($_POST['addGenre'])) { //checks whether we're coming from "add genre" form
	
		// need more logic here to check if fields are actually set
		$sql = "INSERT INTO `Z_Genres` (`name`) VALUES
				(:name)";
		$stmt = $dbConn -> prepare($sql);
		
		try {
			$stmt -> execute(array(":name"=>$_POST['genreName']));
								   	 				
			echo "<br>RECORD Added!! <br> <br>"; 

		} catch (PDOException $e) {
   			if ($e->errorInfo[1] == 1062) {
      			echo "<br>That genre already exists.";
   			} else {
      			echo "<br>An error occured.";
				echo $e;
   			}
		}
	}
	
	if (isset($_POST['addAsset'])) { //checks whether we're coming from "add asset" form
	
		// need more logic here to check if fields are actually set
		$sql = "INSERT INTO `Z_Assets` (`name`) VALUES
				(:name)";
		$stmt = $dbConn -> prepare($sql);
		
		try {
			$stmt -> execute(array(":name"=>$_POST['assetName']));
								   	 				
			echo "<br>RECORD Added!! <br> <br>"; 

		} catch (PDOException $e) {
   			if ($e->errorInfo[1] == 1062) {
      			echo "<br>That asset already exists.";
   			} else {
      			echo "<br>An error occured.";
				echo $e;
   			}
		}
	}
	
	if (isset($_POST['addRole'])) { //checks whether we're coming from "add role" form
	
		// need more logic here to check if fields are actually set
		$sql = "INSERT INTO `Z_Roles` (`name`) VALUES
				(:name)";
		$stmt = $dbConn -> prepare($sql);
		
		try {
			$stmt -> execute(array(":name"=>$_POST['roleName']));
								   	 				
			echo "<br>RECORD Added!! <br> <br>"; 

		} catch (PDOException $e) {
   			if ($e->errorInfo[1] == 1062) {
      			echo "<br>That role already exists.";
   			} else {
      			echo "<br>An error occured.";
				echo $e;
   			}
		}
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
				echo $e;
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
		
		<title>StreamFlix Categorize Page</title>
		<meta name="description" content="">
		<meta name="author" content="lara4594">
		
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		
		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	</head>
	
	<body>
		<div>
			
			<h2>Add Movie</h2>
			<form method="post">
				<table>
					<tr>
						<td>Title</td>
						<td><input type='text' name='movieTitle'></td>
					</tr>
					<tr>
						<td>Year Released</td>
						<td><input type='number' name='movieYear'></td>
					</tr>
					<tr>
						<td>Description</td>
						<td><textarea rows="5" cols="40" name='movieDesc' placeholder='Enter a brief description of the movie here.'></textarea></td>
					</tr>
					<tr>
						<td>Rating</td>
						<td><input type='text' name='movieRating'></td>
					</tr>
					<tr>
						<td>Length (min)</td>
						<td><input type='number' name='movieLength'></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" name='addMovie' value="Add Movie"> 
						</td>
					</tr>					
				</table>
			</form>
			
			<h2>Delete Movie</h2>
			<?php
				$movieList = getMovies();
				
			    foreach ($movieList as $movie) { ?>
		        
		        	<?=$movie['title']?>
		        	<!--<form method="post">
		            	<input type="hidden" name="movie_id" value="<?=$movie['movie_id']?>">
		            	<input type="submit" name="update" value="Update">
		        	</form>-->
		        	<form method="post">
		            	<input type="hidden" name="movie_id" value="<?=$movie['movie_id']?>">         
		            	<input type="submit" name="delete" value="Delete">
		        	</form>
		        	<br>      
				<?        
		    	} //end foreach
	   		?>
			
			<h2>Add Genre</h2>
			<form method="post">
				<table>
					<tr>
						<td>Name</td>
						<td><input type='text' name='genreName'></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" name='addGenre' value="Add Genre"> 
						</td>
					</tr>
				</table>
			</form>
			
			<h2>Add Asset</h2>
			<form method="post">
				<table>
					<tr>
						<td>Name</td>
						<td><input type='text' name='assetName'></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" name='addAsset' value="Add Asset"> 
						</td>
					</tr>
				</table>
			</form>
			
			<h2>Add Role</h2>
			<form method="post">
				<table>
					<tr>
						<td>Name</td>
						<td><input type='text' name='roleName'></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" name='addRole' value="Add Role"> 
						</td>
					</tr>
				</table>
			</form>

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
