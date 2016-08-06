<?php
	require '../db_connection.php';
	
	function getMovies(){
	    global $dbConn;
	    
	    $sql = "SELECT title, year, rating, length
	            FROM Z_Movies
	            ORDER BY title";
	    $stmt = $dbConn -> prepare($sql);
	    $stmt -> execute();
		
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
		
		<title>StreamFlix Main Page</title>
		<meta name="description" content="">
		<meta name="author" content="lara4594">
		
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		
		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	</head>
	
	<body>
		<div>
			
			<table>
				<tr>
					<th>Movie</th>
					<th>Year</th>
					<th>Rating</th>
					<th>Length</th>
				</tr>
				<?php
					$movies = getMovies();

					foreach($movies as $movie)
					{
						echo "<tr>";
						echo "<td>" . $movie['title'] . "</td>";
						echo "<td>" . $movie['year'] . "</td>";
						echo "<td>" . $movie['rating'] . "</td>";
						echo "<td>" . $movie['length'] . "</td>";
						echo "</tr>";
					}	
				?>
			</table>
			
		</div>
	</body>
</html>