<?php

// require_once 'dbconn.php';

/* create a single place to update table names */
define('ASSETS', 'Z_Assets');
define('ROLES', 'Z_Roles');
define('GENRES', 'Z_Genres');
define('MOVIES', 'Z_Movies');
define('MOVIE_ASSETS', 'Z_Movie_Assets');
define('MOVIE_GENRES', 'Z_Movie_Genres');

/* 'z' is for 'Zammis get four five?' - Enemy Mine */
$z = array(
    'assets' => ASSETS,
    'roles' => ROLES,
    'genres' => GENRES,
    'movies' => MOVIES,
    'movie_assets' => MOVIE_ASSETS,
    'movie_genres' => MOVIE_GENRES
);

$create_table_assets = <<<"END_SQL"
    CREATE TABLE `{$z['assets']}` (
        `asset_id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        PRIMARY KEY (`asset_id`),
        UNIQUE KEY `name` (`name`)
    )
END_SQL;

$create_table_genres = <<<"END_SQL"
    CREATE TABLE `{$z['genres']}` (
        `genre_id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        PRIMARY KEY (`genre_id`),
        UNIQUE KEY `name` (`name`)
    )
END_SQL;

$create_table_roles = <<<"END_SQL"
    CREATE TABLE `{$z['roles']}` (
        `role_id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        PRIMARY KEY (`role_id`),
        UNIQUE KEY `name` (`name`)
    )
END_SQL;

$create_table_movies = <<<"END_SQL"
    CREATE TABLE `{$z['movies']}` (
        `movie_id` int(11) NOT NULL AUTO_INCREMENT,
        `title` varchar(255) NOT NULL,
        `year` year(4) NOT NULL,
        `description` blob,
        `rating` varchar(10) DEFAULT NULL,
        `length` int(11) NOT NULL,
        PRIMARY KEY (`movie_id`),
        UNIQUE KEY `title` (`title`)
    )
END_SQL;

$create_table_movie_assets = <<<"END_SQL"
    CREATE TABLE `{$z['movie_assets']}` (
        `movie_id` int(11) NOT NULL,
        `asset_id` int(11) NOT NULL,
        `role_id` int(11) NOT NULL,
        PRIMARY KEY (`movie_id`,`asset_id`,`role_id`),
        FOREIGN KEY (`movie_id`) REFERENCES `{$z['movies']}` (`movie_id`),
        FOREIGN KEY (`asset_id`) REFERENCES `{$z['assets']}` (`asset_id`),
        FOREIGN KEY (`role_id`) REFERENCES `{$z['roles']}` (`role_id`)
    )
END_SQL;

$create_table_movie_genres = <<<"END_SQL"
    CREATE TABLE `{$z['movie_genres']}` (
        `movie_id` int(11) NOT NULL,
        `genre_id` int(11) NOT NULL,
        PRIMARY KEY (`movie_id`,`genre_id`),
        FOREIGN KEY (`movie_id`) REFERENCES `{$z['movies']}` (`movie_id`),
        FOREIGN KEY (`genre_id`) REFERENCES `{$z['genres']}` (`genre_id`)
    )
END_SQL;

function drop_z_tables($dbConn) {
    $drop_table_order = array(
        MOVIE_ASSETS,
        MOVIE_GENRES,
        ASSETS,
        ROLES,
        GENRES,
        MOVIES
    );

    /* unfortunately parameterization doesn't work for table names */
    foreach ($drop_table_order as $tname) {
        $dbConn->exec("DROP TABLE IF EXISTS `$tname`");   
    }
}

function create_z_tables($dbConn) {
    $dbConn->exec($create_table_assets);
    $dbConn->exec($create_table_genres);
    $dbConn->exec($create_table_roles);
    $dbConn->exec($create_table_movies);
    $dbConn->exec($create_table_movie_assets);
    $dbConn->exec($create_table_movie_genres);
}

$insert_sql = <<<"END_SQL"
    INSERT IGNORE INTO
        TABLE ()
    VALUES ()
END_SQL;

$insert_assets_sql = <<<"END_SQL"
    INSERT IGNORE INTO
        {$z['assets']} (name)
    VALUES (:name)
END_SQL;

$insert_roles_sql = <<<"END_SQL"
    INSERT IGNORE INTO
        {$z['roles']} (name)
    VALUES (:name)
END_SQL;

$insert_genres_sql = <<<"END_SQL"
    INSERT IGNORE INTO
        {$z['genres']} (name)
    VALUES (:name)
END_SQL;

$insert_movies_sql = <<<"END_SQL"
    INSERT IGNORE INTO
        {$z['movies']} (title, year, description, rating, length)
    VALUES (:title, :year, :description, :rating, :length)
END_SQL;

$insert_movie_assets_sql = <<<"END_SQL"
    INSERT IGNORE INTO
        {$z['movie_assets']} (movie_id, asset_id, role_id)
    VALUES (
        (SELECT movie_id FROM {$z['movies']} WHERE title = :movies_name),
        (SELECT asset_id FROM {$z['assets']} WHERE name = :assets_name),
        (SELECT role_id FROM {$z['roles']} WHERE name = :roles_name)
    )
END_SQL;

$insert_movie_genres_sql = <<<"END_SQL"
    INSERT IGNORE INTO
        {$z['movie_genres']} (movie_id, genre_id)
    VALUES (
        (SELECT movie_id FROM {$z['movies']} WHERE title = :movies_name),
        (SELECT genre_id FROM {$z['genres']} WHERE name = :genres_name)
    )
END_SQL;

function check_tables() {
    /**
     * Print out data insertion SQL like the DML *.sql files.
     * XXX Currently prints out extra commas at end of INSERT statements XXX
     */
    $sw_movies = array(
        array('title' => 'Blade Runner',
            'year' => 1982,
            'description' => 'Ridley Scott\'\'s adaptation of Philip K. Dicks\'\'s Do androids dream of electric sheep?',
            'rating' => 'R',
            'length' => 116),
        array('title' => 'The Great Dictator',
            'year' => 1940,
            'description' => 'Charlie Chaplin satire of WWII era dictator.',
            'rating' => 'NR',
            'length' => 125),
        array('title' => 'L\'\'Atalante',
            'year' => 1934,
            'description' => 'French newlyweds on a boat!',
            'rating' => 'NR',
            'length' => 89),
        array('title' => 'Frozen',
            'year' => 2013,
            'description' => 'Academy Award winning Walt Disney motion picture.',
            'rating' => 'PG',
            'length' => 102
        ),
        array('title' => 'My Neighbor Totoro',
            'year' => 1988,
            'description' => 'Hayao Miyazaki film about forest spirits.',
            'rating' => 'G',
            'length' => 86
        )
    );
    
    echo <<<"END_SQL"
    INSERT IGNORE INTO
        `{$z['movies']}` (`title`, `year`, `description`, `rating`, `length`)
    VALUES
    
END_SQL;
    
    foreach ($sw_movies as $row) {
        echo <<<"END_SQL"
    ('{$row['title']}', {$row['year']}, '{$row['description']}', '{$row['rating']}', {$row['length']}),
    
END_SQL;
    }
    
    echo <<<"END_SQL"
    ;
    
END_SQL;
    
    $sw_assets = array();
    $sw_roles = array();
    
    $sw_movie_assets = array(
        /*
        array('movies_name' => '',
            'assets_name' => '',
            'roles_name' => ''),
        */
        /* Blade Runner */
        array('movies_name' => 'Blade Runner',
            'assets_name' => 'Ridley Scott',
            'roles_name' => 'Director'),
        array('movies_name' => 'Blade Runner',
            'assets_name' => 'Harrison Ford',
            'roles_name' => 'Cast'),
        array('movies_name' => 'Blade Runner',
            'assets_name' => 'Rutger Hauer',
            'roles_name' => 'Cast'),
        array('movies_name' => 'Blade Runner',
            'assets_name' => 'Sean Young',
            'roles_name' => 'Cast'),
        /* The Great Dictator */
        array('movies_name' => 'The Great Dictator',
            'assets_name' => 'Charlie Chaplin',
            'roles_name' => 'Director'),
        array('movies_name' => 'The Great Dictator',
            'assets_name' => 'Charlie Chaplin',
            'roles_name' => 'Cast'),
        array('movies_name' => 'The Great Dictator',
            'assets_name' => 'Paulette Goddard',
            'roles_name' => 'Cast'),
        array('movies_name' => 'The Great Dictator',
            'assets_name' => 'Jack Oakie',
            'roles_name' => 'Cast'),
        /* L'Atalante */       
        array('movies_name' => 'L\'\'Atalante',
            'assets_name' => 'Jean Vigo',
            'roles_name' => 'Director'),
        array('movies_name' => 'L\'\'Atalante',
            'assets_name' => 'Dita Parlo',
            'roles_name' => 'Cast'),
        array('movies_name' => 'L\'\'Atalante',
            'assets_name' => 'Jean Dasté',
            'roles_name' => 'Cast'),
        array('movies_name' => 'L\'\'Atalante',
            'assets_name' => 'Michel Simon',
            'roles_name' => 'Cast'),
        /* Frozen */
        array('movies_name' => 'Frozen',
            'assets_name' => 'Jennifer Lee',
            'roles_name' => 'Director'),
        array('movies_name' => 'Frozen',
            'assets_name' => 'Chris Buck',
            'roles_name' => 'Director'),
        array('movies_name' => 'Frozen',
            'assets_name' => 'Kristen Bell',
            'roles_name' => 'Cast'),
        array('movies_name' => 'Frozen',
            'assets_name' => 'Idina Menzel',
            'roles_name' => 'Cast'),
        array('movies_name' => 'Frozen',
            'assets_name' => 'Jonathan Groff',
            'roles_name' => 'Cast'),
        /* Tonari No Totoro */
        array('movies_name' => 'My Neighbor Totoro',
            'assets_name' => 'Hayao Miyazaki',
            'roles_name' => 'Director'),
        array('movies_name' => 'My Neighbor Totoro',
            'assets_name' => 'Hitoshi Takagi',
            'roles_name' => 'Cast'),
        array('movies_name' => 'My Neighbor Totoro',
            'assets_name' => 'Noriko Hidaka',
            'roles_name' => 'Cast'),
        array('movies_name' => 'My Neighbor Totoro',
            'assets_name' => 'Chika Sakamoto',
            'roles_name' => 'Cast')
        /*
        array('movies_name' => '',
            'assets_name' => '',
            'roles_name' => ''),
        */
    );
    
    foreach ($sw_movie_assets as $row) {
        if (!in_array($row['assets_name'], $sw_assets)) {
            array_push($sw_assets, $row['assets_name']);
        }
        if (!in_array($row['roles_name'], $sw_roles)) {
            array_push($sw_roles, $row['roles_name']);
        }    
    }
    
    echo <<<"END_SQL"
    INSERT IGNORE INTO
        `{$z['assets']}` (`name`)
    VALUES
    
END_SQL;
    
    foreach ($sw_assets as $row) {
        echo <<<"END_SQL"
    ('$row'),
     
END_SQL;
    }
    
    echo <<<"END_SQL"
    ;
    INSERT IGNORE INTO
        `{$z['roles']}` (`name`)
    VALUES
    
END_SQL;
    
    foreach ($sw_roles as $row) {
        echo <<<"END_SQL"
    ('$row'),
     
END_SQL;
    }
    
    $sw_genres = array();
    
    $sw_movie_genres = array(
        /*
        array('movies_name' => '',
            'genres_name' => ''),
        */
        array('movies_name' => 'Blade Runner',
            'genres_name' => 'Science-Fiction'),
        array('movies_name' => 'Blade Runner',
            'genres_name' => 'Action'),
        array('movies_name' => 'Blade Runner',
            'genres_name' => 'Film Noir'),
        array('movies_name' => 'The Great Dictator',
            'genres_name' => 'Silent'),
        array('movies_name' => 'The Great Dictator',
            'genres_name' => 'Comedy'),
        array('movies_name' => 'L\'\'Atalante',
            'genres_name' => 'Silent'),
        array('movies_name' => 'L\'\'Atalante',
            'genres_name' => 'Drama'),
        array('movies_name' => 'Frozen',
            'genres_name' => 'Family'),
        array('movies_name' => 'Frozen',
            'genres_name' => 'Animated'),
        array('movies_name' => 'Frozen',
            'genres_name' => 'Musical'),
        array('movies_name' => 'My Neighbor Totoro',
            'genres_name' => 'Family'),
        array('movies_name' => 'My Neighbor Totoro',
            'genres_name' => 'Animated')
        /*
        array('movies_name' => '',
            'genres_name' => ''),
        */
    );
    
    foreach ($sw_movie_genres as $row) {
        if (!in_array($row['genres_name'], $sw_genres)) {
            array_push($sw_genres, $row['genres_name']);
        }
    }
    
    echo <<<"END_SQL"
    ;
    INSERT IGNORE INTO
        `{$z['genres']}` (`name`)
    VALUES
    
END_SQL;
    
    foreach ($sw_genres as $row) {
        echo <<<"END_SQL"
    ('$row'),
     
END_SQL;
    }
    
    echo <<<"END_SQL"
    ;
    INSERT IGNORE INTO
        `{$z['movie_assets']}` (movie_id, asset_id, role_id)
    VALUES
    
END_SQL;
    
    
    foreach ($sw_movie_assets as $row) {
        echo <<<"END_SQL"
    ((SELECT movie_id FROM `{$z['movies']}` WHERE title = '{$row['movies_name']}'),
     (SELECT asset_id FROM `{$z['assets']}` WHERE name = '{$row['assets_name']}'),
     (SELECT role_id FROM `{$z['roles']}` WHERE name = '{$row['roles_name']}')),
    
END_SQL;
    }
    
    echo <<<"END_SQL"
    ;
    
    INSERT IGNORE INTO
        `{$z['movie_genres']}` (movie_id, genre_id)
    VALUES
        
        
END_SQL;
    
    foreach ($sw_movie_genres as $row) {
        echo <<<"END_SQL"
    ((SELECT movie_id FROM `{$z['movies']}` WHERE title = '{$row['movies_name']}'),
     (SELECT genre_id FROM `{$z['genres']}` WHERE name = '{$row['genres_name']}')),
    
END_SQL;
    }
    
    echo <<<"END_SQL"
    ;
END_SQL;

}

?>
