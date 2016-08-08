<?php
	require '../db_connection.php';
	
	print_r($_GET);
	
	/* modifying original design slightly to support integration of filters
	function getMovies(){
	    global $dbConn;
	    
	    $sql = "SELECT movie_id, title, year, rating, length
	            FROM Z_Movies
	            ORDER BY title";
	    $stmt = $dbConn -> prepare($sql);
	    $stmt -> execute();
		
	    return $stmt->fetchAll();
	}*/
	
	if(empty($_GET))
	{
    	$sql = "SELECT movie_id, title, year, rating, length
                FROM Z_Movies
                ORDER BY title";
	}
	else 
	{
		
		$sql = '';
		//Alter the following depending on what attributes we want from the tables
	    if(isset($_GET['title']))
		{
			$title = $_GET['key'];
			echo "Filtering based on title...</br>";
			$sql = "SELECT movie_id, title, year, rating, length
                	FROM Z_Movies 
                	WHERE title like '%$title%'";
		}
		if(isset($_GET['genre']))
		{
			if($sql == "")
			{
				$genre = $_GET['genre'];
				switch($genre)
				{
					case 'Sci-fi':	echo "Selecting all Sci-fi films...</br>";
									$sql = "SELECT movie_id, title, year, length, rating
											FROM z_movies, z_genres
											WHERE name = 'Science Fiction'";
									break;
					case 'Noir':	echo "Selecting all Noir films...</br>";
									$sql = "SELECT movie_id, title, year, length, rating
											FROM z_movies, z_genres
											WHERE name = 'Film Noir'";
									break;
					case 'Action':	echo "Selecting all Action films...</br>";
									$sql = "SELECT movie_id, title, year, length, rating
											FROM z_movies, z_genres
											WHERE name = 'Action'";
									break;
					case 'Drama':	echo "Selecting all Drama films...</br>";
									$sql = "SELECT movie_id, title, year, length, rating
											FROM z_movies, z_genres
											WHERE name = 'Drama'";
									break;
					case 'Romance':	echo "Selecting all Romance films...</br>";
									$sql = "SELECT movie_id, title, year, length, rating
											FROM z_movies, z_genres
											WHERE name = 'Romance'";
									break;
					case 'War':	echo "Selecting all War films...</br>";
									$sql = "SELECT movie_id, title, year, length, rating
											FROM z_movies, z_genres
											WHERE name = 'War'";
									break;
					case 'Adventure':	echo "Selecting all Adventure films...</br>";
									$sql = "SELECT movie_id, title, year, length, rating
											FROM z_movies, z_genres
											WHERE name = 'Adventure'";
									break;
					case 'Crime':	echo "Selecting all Crime films...</br>";
									$sql = "SELECT movie_id, title, year, length, rating
											FROM z_movies, z_genres
											WHERE name = 'Crime'";
									break;
					case 'Horror':	echo "Selecting all Horror films...</br>";
									$sql = "SELECT movie_id, title, year, length, rating
											FROM z_movies, z_genres
											WHERE name = 'Horror'";
									break;
					case 'Mystery':	echo "Selecting all Mystery films...</br>";
									$sql = "SELECT movie_id, title, year, length, rating
											FROM z_movies, z_genres
											WHERE name = 'Mystery'";
									break;
					//Add more cases along with more genres
					default:
									break;
				}
			}
			else
			{
				$genre = $_GET['genre'];
				switch($genre)
				{
					case 'Sci-fi':	echo "Selecting all Sci-fi films...</br>";
									$sql .= " AND name = 'Science Fiction'";
									break;
					case 'Noir':	echo "Selecting all Noir films...</br>";
									$sql .= " AND name = 'Film Noir'";
									break;
					case 'Action':	echo "Selecting all Action films...</br>";
									$sql .= " AND name = 'Action'";
									break;
					case 'Drama':	echo "Selecting all Drama films...</br>";
									$sql .= " AND name = 'Drama'";
									break;
					case 'Romance':	echo "Selecting all Romance films...</br>";
									$sql .= " AND name = 'Romance'";
									break;
					case 'War':	echo "Selecting all War films...</br>";
									$sql .= " AND name = 'War'";
									break;
					case 'Adventure':	echo "Selecting all Adventure films...</br>";
									$sql .= " AND name = 'Adventure'";
									break;
					case 'Crime':	echo "Selecting all Crime films...</br>";
									$sql .= " AND name = 'Crime'";
									break;
					case 'Horror':	echo "Selecting all Horror films...</br>";
									$sql .= " AND name = 'Horror'";
									break;
					case 'Mystery':	echo "Selecting all Mystery films...</br>";
									$sql .= " AND name = 'Mystery'";
									break;
					//Add more cases along with more genres
					default:
									break;
				}
			}
		}
		if(isset($_GET['actor']))
		{
			if($sql == "")
			{
				echo "Filtering based on actor...</br>";
				$actor = $_GET['name'];
				$sql = 	"SELECT movie_id, title, year, length, rating
						FROM z_movies, z_assets
						WHERE name = '$actor'";
			}
			else
			{
				echo "Filtering based on actor...</br>";
				$actor = $_GET['name'];
				$sql .= " AND name = '$actor'";
			}
		}

	}
	
	/*!TODO CGP-4, add a sort, e.g. ORDER BY statement, to the existing SQL statement here
	 *		for now we'll just apply a default sort order by movie title
	 */

	echo "<br><br>Executing following SQL statement:<br>";
	echo "$sql" . "<br><br>";
	$stmt = $dbConn -> prepare($sql); //prepares a statement for execution and returns a statement object
	$stmt -> execute(); //execute the prepared statement
	$movies = $stmt->fetchAll(); //store the obtained data into an array variable*/
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
					//$movies = getMovies();

					foreach($movies as $movie)
					{
						
						echo "<tr>";
						echo "<td>";
						echo "<a href='streamflix_detail.php?movie_id=" . $movie['movie_id'] . "'>" . $movie['title'] . "</a>";
						echo "</td>";
						echo "<td>" . $movie['year'] . "</td>";
						echo "<td>" . $movie['rating'] . "</td>";
						echo "<td>" . $movie['length'] . "</td>";
						echo "</tr>";
						echo "</a>";
					}	
				?>
			</table>
			<br>
			<form method = "get">
				Filter by title?<input type="radio" name="title"> Yes
				</br>
				Then enter a keyword in the movie's title:</br>
				<input type="text" name="key">
				</br></br>
				Select genre:</br>
				<input type="radio" name="genre" value="Sci-fi"> Sci-fi			<!--Search for value "Science Fiction"-->
				<input type="radio" name="genre" value="Noir"> Noir				<!--Search for value "Film Noir"-->
				<input type="radio" name="genre" value="Action"> Action			<!--Search for value "Action"-->
				<input type="radio" name="genre" value="Drama"> Drama			<!--Search for value "Drama"-->
				<input type="radio" name="genre" value="Romance"> Romance		<!--Search for value "Romance"-->
				<input type="radio" name="genre" value="War"> War				<!--Search for value "War"-->
				<input type="radio" name="genre" value="Adventure"> Adventure	<!--Search for value "Adventure"-->
				<input type="radio" name="genre" value="Crime"> Crime			<!--Search for value "Crime"-->
				<input type="radio" name="genre" value="Horror"> Horror			<!--Search for value "Horror"-->
				<input type="radio" name="genre" value="Mystery"> Mystery		<!--Search for value "Mystery"-->
				<!--Add more radio buttons as more z_genres are added-->
				</br></br>
				Filter by actor?<input type="radio" name="actor"> Yes
				</br>
				Then type an actor's name:</br>
				<input type="text" name="name">
				</br></br>
				<input type="submit" value="Filter">
				<?php
					//Here will be where the data will be outputted after filtering
				?>
			</form>
		</div>
	</body>
</html>