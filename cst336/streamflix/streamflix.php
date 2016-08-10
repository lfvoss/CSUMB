<?php
	
	session_start();

	if(!isset($_SESSION['username'])){
		header("Location: streamflix_login.php");
	}
	
	require '../db_connection.php';
		
	echo "<h2>Welcome to Streamflix " . $_SESSION['username'] . "!</h2><br>";
	
	//debug only
	print_r($_GET);
		
	if(empty($_GET))
	{
    	$sql = "SELECT Z_movies.movie_id, title, year, rating, length
                FROM Z_Movies
                ORDER BY title";
	}
	else 
	{	
	    $sql = "";
	    if(isset($_GET['title']))
		{
			$title = $_GET['key'];
			echo "Filtering based on title...</br>";
			$sql = "SELECT Z_movies.movie_id, title, year, rating, length
					FROM Z_Movies, Z_Genres, Z_Movie_Genres, Z_Assets, Z_Movie_Assets, Z_Roles
					WHERE title = '$title'";
		}
		
		if(isset($_GET['genre']))
		{
			if($sql == "")
			{
				$genre = $_GET['genre'];
				switch($genre)
				{
					case 'Sci-fi':	echo "Selecting all Sci-fi films...</br>";
									$sql = "SELECT DISTINCT Z_movies.movie_id, title, year, rating, length
											FROM Z_Movies, Z_Genres, Z_Movie_Genres, Z_Assets, Z_Movie_Assets, Z_Roles
											WHERE Z_Genres.name = 'Science Fiction'";
									break;
					case 'Noir':	echo "Selecting all Noir films...</br>";
									$sql = "SELECT DISTINCT Z_movies.movie_id, title, year, rating, length
											FROM Z_Movies, Z_Genres, Z_Movie_Genres, Z_Assets, Z_Movie_Assets, Z_Roles
											WHERE Z_Genres.name = 'Film Noir'";
									break;
					case 'Action':	echo "Selecting all Action films...</br>";
									$sql = "SELECT DISTINCT Z_movies.movie_id, title, year, rating, length
											FROM Z_Movies, Z_Genres, Z_Movie_Genres, Z_Assets, Z_Movie_Assets, Z_Roles
											WHERE Z_Genres.name = 'Action'";
									break;
					case 'Drama':	echo "Selecting all Drama films...</br>";
									$sql = "SELECT DISTINCT Z_movies.movie_id, title, year, rating, length
											FROM Z_Movies, Z_Genres, Z_Movie_Genres, Z_Assets, Z_Movie_Assets, Z_Roles
											WHERE Z_Genres.name = 'Drama'";
									break;
					case 'Romance':	echo "Selecting all Romance films...</br>";
									$sql = "SELECT DISTINCT Z_movies.movie_id, title, year, rating, length
											FROM Z_Movies, Z_Genres, Z_Movie_Genres, Z_Assets, Z_Movie_Assets, Z_Roles
											WHERE Z_Genres.name = 'Romance'";
									break;
					case 'War':	echo "Selecting all War films...</br>";
									$sql = "SELECT DISTINCT Z_movies.movie_id, title, year, rating, length
											FROM Z_Movies, Z_Genres, Z_Movie_Genres, Z_Assets, Z_Movie_Assets, Z_Roles
											WHERE Z_Genres.name = 'War'";
									break;
					case 'Adventure':	echo "Selecting all Adventure films...</br>";
									$sql = "SELECT DISTINCT Z_movies.movie_id, title, year, rating, length
											FROM Z_Movies, Z_Genres, Z_Movie_Genres, Z_Assets, Z_Movie_Assets, Z_Roles
											WHERE Z_Genres.name = 'Adventure'";
									break;
					case 'Crime':	echo "Selecting all Crime films...</br>";
									$sql = "SELECT DISTINCT Z_movies.movie_id, title, year, rating, length
											FROM Z_Movies, Z_Genres, Z_Movie_Genres, Z_Assets, Z_Movie_Assets, Z_Roles
											WHERE Z_Genres.name = 'Crime'";
									break;
					case 'Horror':	echo "Selecting all Horror films...</br>";
									$sql = "SELECT DISTINCT Z_movies.movie_id, title, year, rating, length
											FROM Z_Movies, Z_Genres, Z_Movie_Genres, Z_Assets, Z_Movie_Assets, Z_Roles
											WHERE Z_Genres.name = 'Horror'";
									break;
					case 'Mystery':	echo "Selecting all Mystery films...</br>";
									$sql = "SELECT DISTINCT Z_movies.movie_id, title, year, rating, length
											FROM Z_Movies, Z_Genres, Z_Movie_Genres, Z_Assets, Z_Movie_Assets, Z_Roles
											WHERE Z_Genres.name = 'Mystery'";
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
									$sql .= " AND Z_Genres.name = 'Science Fiction'";
									break;
					case 'Noir':	echo "Selecting all Noir films...</br>";
									$sql .= " AND Z_Genres.name = 'Film Noir'";
									break;
					case 'Action':	echo "Selecting all Action films...</br>";
									$sql .= " AND Z_Genres.name = 'Action'";
									break;
					case 'Drama':	echo "Selecting all Drama films...</br>";
									$sql .= " AND Z_Genres.name = 'Drama'";
									break;
					case 'Romance':	echo "Selecting all Romance films...</br>";
									$sql .= " AND Z_Genres.name = 'Romance'";
									break;
					case 'War':	echo "Selecting all War films...</br>";
									$sql .= " AND Z_Genres.name = 'War'";
									break;
					case 'Adventure':	echo "Selecting all Adventure films...</br>";
									$sql .= " AND Z_Genres.name = 'Adventure'";
									break;
					case 'Crime':	echo "Selecting all Crime films...</br>";
									$sql .= " AND Z_Genres.name = 'Crime'";
									break;
					case 'Horror':	echo "Selecting all Horror films...</br>";
									$sql .= " AND Z_Genres.name = 'Horror'";
									break;
					case 'Mystery':	echo "Selecting all Mystery films...</br>";
									$sql .= " AND Z_Genres.name = 'Mystery'";
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
				$sql = 	"SELECT DISTINCT Z_movies.movie_id, title, year, rating, length
						 FROM Z_Movies, Z_Genres, Z_Movie_Genres, Z_Assets, Z_Movie_Assets, Z_Roles
						 WHERE Z_Assets.name = '$actor'";
			}
			else
			{
				echo "Filtering based on actor...</br>";
				$actor = $_GET['name'];
				$sql .= " AND Z_Assets.name = '$actor'";
			}
		}
		
		//Finally, adds ID comparison between tables so proper data is returned
		$sql .= 	" AND Z_Assets.asset_id = Z_Movie_Assets.asset_id
					AND Z_Genres.genre_id = Z_Movie_Genres.genre_id
					AND Z_Movies.movie_id = Z_Movie_Assets.movie_id;
					AND Z_Movies.movie_id = Z_Movie_Genres.movie_id
					AND Z_Movie_Assets.movie_id = Z_Movie_Genres.movie_id
					AND Z_Roles.role_id = Z_Movie_Assets.role_id";
	}
		
	if(isset($_GET['sort']) and isset($_GET['AD']))
	{
		$sort = $_GET['sort'];
		switch($sort)
		{
			case 'title':	$sql = 	"SELECT Z_movies.movie_id, title, year, rating, length
									FROM z_movies
									ORDER BY title";
							break;
			case 'year':	$sql = 	"SELECT Z_movies.movie_id, title, year, rating, length
									FROM z_movies
									ORDER BY year";
							break;
			default:		
							break;
		}
		$AD = $_GET['AD'];
		if($AD == 'descending')
		{
			$sql .= " DESC";
		}
		//By default, it should sort in ascending, so an else-statement is unnecessary
		$sql .= ";";
	}

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
		<meta name="author" content="Team Enhydra">
		
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		
		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
		<link rel="stylesheet" type="text/css" href="streamflix.css">

	</head>
	
	<body>
		<div>
			<div>
				<form method="post" action="streamflix_chpass.php">
				<input type="submit" value="Change Password" />
				</form>
			</div>
			<div>
				<form method="post" action="streamflix_logout.php">
					<input type="submit" value="Logout" />
				</form>
			</div>

			<div>
				<h1>Click on a movie for more information:</h1>
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
				<h1>Sorter</h1>
				<h3>Please be sure to select from both options for the sorter to function.</h3>
				<form method="get">
					Sort data by ascending or descending order?</br>
					<input type="radio" name="AD" value="ascending"> Ascending		<!--Sorts in ascending order-->
					<input type="radio" name="AD" value="descending"> Descending	<!--Sorts in descending order-->
					</br></br>
					How would you like to sort the data?</br>
					<input type="radio" name="sort" value="title"> Movie Title
					<input type="radio" name="sort" value="year"> Year of Release
					<!--Any other options to sort by needed?-->
					</br></br>
					<input type="submit" value="Sort!">
				</form>
			</div>
		</div>
	</body>
</html>
