INSERT IGNORE INTO
    `Z_Movie_Genres` (movie_id, genre_id)
VALUES
((SELECT movie_id FROM `Z_Movies` WHERE title = 'Blade Runner'),
 (SELECT genre_id FROM `Z_Genres` WHERE name = 'Science-Fiction')),
((SELECT movie_id FROM `Z_Movies` WHERE title = 'Blade Runner'),
 (SELECT genre_id FROM `Z_Genres` WHERE name = 'Action')),
((SELECT movie_id FROM `Z_Movies` WHERE title = 'Blade Runner'),
 (SELECT genre_id FROM `Z_Genres` WHERE name = 'Film Noir')),
((SELECT movie_id FROM `Z_Movies` WHERE title = 'The Great Dictator'),
 (SELECT genre_id FROM `Z_Genres` WHERE name = 'Silent')),
((SELECT movie_id FROM `Z_Movies` WHERE title = 'The Great Dictator'),
 (SELECT genre_id FROM `Z_Genres` WHERE name = 'Comedy')),
((SELECT movie_id FROM `Z_Movies` WHERE title = 'L''Atalante'),
 (SELECT genre_id FROM `Z_Genres` WHERE name = 'Silent')),
((SELECT movie_id FROM `Z_Movies` WHERE title = 'L''Atalante'),
 (SELECT genre_id FROM `Z_Genres` WHERE name = 'Drama')),
((SELECT movie_id FROM `Z_Movies` WHERE title = 'Frozen'),
 (SELECT genre_id FROM `Z_Genres` WHERE name = 'Family')),
((SELECT movie_id FROM `Z_Movies` WHERE title = 'Frozen'),
 (SELECT genre_id FROM `Z_Genres` WHERE name = 'Animated')),
((SELECT movie_id FROM `Z_Movies` WHERE title = 'Frozen'),
 (SELECT genre_id FROM `Z_Genres` WHERE name = 'Musical')),
((SELECT movie_id FROM `Z_Movies` WHERE title = 'My Neighbor Totoro'),
 (SELECT genre_id FROM `Z_Genres` WHERE name = 'Family')),
((SELECT movie_id FROM `Z_Movies` WHERE title = 'My Neighbor Totoro'),
 (SELECT genre_id FROM `Z_Genres` WHERE name = 'Animated'));
