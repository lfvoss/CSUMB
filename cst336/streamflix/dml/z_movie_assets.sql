INSERT IGNORE INTO
    `Z_Movie_Assets` (movie_id, asset_id, role_id)
VALUES
((SELECT movie_id FROM `Z_Movies` WHERE title = 'Blade Runner'),
 (SELECT asset_id FROM `Z_Assets` WHERE name = 'Ridley Scott'),
 (SELECT role_id FROM `Z_Roles` WHERE name = 'Director')),
((SELECT movie_id FROM `Z_Movies` WHERE title = 'Blade Runner'),
 (SELECT asset_id FROM `Z_Assets` WHERE name = 'Harrison Ford'),
 (SELECT role_id FROM `Z_Roles` WHERE name = 'Cast')),
((SELECT movie_id FROM `Z_Movies` WHERE title = 'Blade Runner'),
 (SELECT asset_id FROM `Z_Assets` WHERE name = 'Rutger Hauer'),
 (SELECT role_id FROM `Z_Roles` WHERE name = 'Cast')),
((SELECT movie_id FROM `Z_Movies` WHERE title = 'Blade Runner'),
 (SELECT asset_id FROM `Z_Assets` WHERE name = 'Sean Young'),
 (SELECT role_id FROM `Z_Roles` WHERE name = 'Cast')),
((SELECT movie_id FROM `Z_Movies` WHERE title = 'The Great Dictator'),
 (SELECT asset_id FROM `Z_Assets` WHERE name = 'Charlie Chaplin'),
 (SELECT role_id FROM `Z_Roles` WHERE name = 'Director')),
((SELECT movie_id FROM `Z_Movies` WHERE title = 'The Great Dictator'),
 (SELECT asset_id FROM `Z_Assets` WHERE name = 'Charlie Chaplin'),
 (SELECT role_id FROM `Z_Roles` WHERE name = 'Cast')),
((SELECT movie_id FROM `Z_Movies` WHERE title = 'The Great Dictator'),
 (SELECT asset_id FROM `Z_Assets` WHERE name = 'Paulette Goddard'),
 (SELECT role_id FROM `Z_Roles` WHERE name = 'Cast')),
((SELECT movie_id FROM `Z_Movies` WHERE title = 'The Great Dictator'),
 (SELECT asset_id FROM `Z_Assets` WHERE name = 'Jack Oakie'),
 (SELECT role_id FROM `Z_Roles` WHERE name = 'Cast')),
((SELECT movie_id FROM `Z_Movies` WHERE title = 'L''Atalante'),
 (SELECT asset_id FROM `Z_Assets` WHERE name = 'Jean Vigo'),
 (SELECT role_id FROM `Z_Roles` WHERE name = 'Director')),
((SELECT movie_id FROM `Z_Movies` WHERE title = 'L''Atalante'),
 (SELECT asset_id FROM `Z_Assets` WHERE name = 'Dita Parlo'),
 (SELECT role_id FROM `Z_Roles` WHERE name = 'Cast')),
((SELECT movie_id FROM `Z_Movies` WHERE title = 'L''Atalante'),
 (SELECT asset_id FROM `Z_Assets` WHERE name = 'Jean Dasté'),
 (SELECT role_id FROM `Z_Roles` WHERE name = 'Cast')),
((SELECT movie_id FROM `Z_Movies` WHERE title = 'L''Atalante'),
 (SELECT asset_id FROM `Z_Assets` WHERE name = 'Michel Simon'),
 (SELECT role_id FROM `Z_Roles` WHERE name = 'Cast')),
((SELECT movie_id FROM `Z_Movies` WHERE title = 'Frozen'),
 (SELECT asset_id FROM `Z_Assets` WHERE name = 'Jennifer Lee'),
 (SELECT role_id FROM `Z_Roles` WHERE name = 'Director')),
((SELECT movie_id FROM `Z_Movies` WHERE title = 'Frozen'),
 (SELECT asset_id FROM `Z_Assets` WHERE name = 'Chris Buck'),
 (SELECT role_id FROM `Z_Roles` WHERE name = 'Director')),
((SELECT movie_id FROM `Z_Movies` WHERE title = 'Frozen'),
 (SELECT asset_id FROM `Z_Assets` WHERE name = 'Kristen Bell'),
 (SELECT role_id FROM `Z_Roles` WHERE name = 'Cast')),
((SELECT movie_id FROM `Z_Movies` WHERE title = 'Frozen'),
 (SELECT asset_id FROM `Z_Assets` WHERE name = 'Idina Menzel'),
 (SELECT role_id FROM `Z_Roles` WHERE name = 'Cast')),
((SELECT movie_id FROM `Z_Movies` WHERE title = 'Frozen'),
 (SELECT asset_id FROM `Z_Assets` WHERE name = 'Jonathan Groff'),
 (SELECT role_id FROM `Z_Roles` WHERE name = 'Cast')),
((SELECT movie_id FROM `Z_Movies` WHERE title = 'My Neighbor Totoro'),
 (SELECT asset_id FROM `Z_Assets` WHERE name = 'Hayao Miyazaki'),
 (SELECT role_id FROM `Z_Roles` WHERE name = 'Director')),
((SELECT movie_id FROM `Z_Movies` WHERE title = 'My Neighbor Totoro'),
 (SELECT asset_id FROM `Z_Assets` WHERE name = 'Hitoshi Takagi'),
 (SELECT role_id FROM `Z_Roles` WHERE name = 'Cast')),
((SELECT movie_id FROM `Z_Movies` WHERE title = 'My Neighbor Totoro'),
 (SELECT asset_id FROM `Z_Assets` WHERE name = 'Noriko Hidaka'),
 (SELECT role_id FROM `Z_Roles` WHERE name = 'Cast')),
((SELECT movie_id FROM `Z_Movies` WHERE title = 'My Neighbor Totoro'),
 (SELECT asset_id FROM `Z_Assets` WHERE name = 'Chika Sakamoto'),
 (SELECT role_id FROM `Z_Roles` WHERE name = 'Cast'));
