
SPOOL C:\Users\wwebster\Desktop\Mod3\JoeS\CSUMB\cst363-final\queryMusicStream_final.txt

/*
  Authors: Wayne Webster, Joe Sarabia, Lisa Voss, 
  Date: 06/16
  Class: CST363
  Final Project: Query Music Streaming DB Entities
  Instructor: Dr. Wendy Wang
*/

set linesize 255
set pagesize 80
select song.SONG_TITLE as "Song Title", ARTIST.ARTIST_NAME as "Artist", album.ALBUM_TITLE as "Album Title", song.SONG_GENRE as "Album Genre" from song join album on song.ALBUM_ID = album.ALBUM_ID join Release on release.album_id = album.album_id join ARTIST on artist.artist_id = release.artist_id where song.SONG_GENRE = 'Rock';

TTITLE CENTER - "Dotify Music Streaming Service";


COLUMN ARTIST_INFO HEADING 'ARTIST |INFO';

COLUMN ARTIST_ID HEADING 'ARTIST |ID';

COLUMN ARTIST_Name HEADING 'ARTIST |NAME';

COLUMN ARTIST_INFO FORMAT A20 WRAP;

SELECT * FROM ARTIST;


COLUMN SONG_TITLE HEADING 'SONG |TITLE';

COLUMN SONG_TIME_SEC HEADING 'SONG |TIME';

COLUMN SONG_GENRE HEADING 'SONG |GENRE';

COLUMN SONG_RATING HEADING 'SONG |RATING';

COLUMN SONG_PLAYS HEADING 'SONG |PLAYS';

COLUMN SONG_ALBUM_POSITION HEADING 'SONG |ALBUM |POSITION';

COLUMN ALBUM_ID HEADING 'ALBUM |ID';

COLUMN SONG_TITLE FORMAT A10 WRAP;

COLUMN SONG_GENRE FORMAT A15 WRAP;

COLUMN SONG_GENRE FORMAT A6 WRAP;

SELECT * FROM SONG;


-- Album Track Listing by Release Date
--select 	song_title as "Song", album_title as "Album", SUBSTR('0' + CAST(FLOOR(song_time_sec / 60) AS VARCHAR2), -2, 2) + ':' + 
--			SUBSTR('0' + CAST(MOD(song_time_sec, 60) AS VARCHAR2), -2, 2) as "Duration", album_us_release_date as "Release Date"
select 		song_title as "Song", album_title as "Album", album_us_release_date as "Release Date"
from 		song, album 
where 		song.album_id = album.album_id 
order by 	album_us_release_date, song.album_id, song_album_position;


-- "Classic" Rock, release date > 25 years
--select 		song_title as "Song", album_title as "Album", album_us_release_date as "Release Date"
--from 		song, album 
--where 		song.album_id = album.album_id	
--order by 	album_us_release_date, song.album_id, song_album_position;

-- Show Playlists
select 		subscriber_email, playlist_name
from 		subscriber, subscription, playlist 
where 		subscriber.subscriber_id = subscription.subscriber_id 
and 		subscription.playlist_id = playlist.playlist_id;

-- Show Playlist Songs
select 		subscriber_email, playlist_name, artist_name, song_title
from 		subscriber, subscription, playlist, playlist_entry, song, album, release, artist
where 		subscriber.subscriber_id = subscription.subscriber_id 
and 		subscription.playlist_id = playlist.playlist_id
and			playlist.playlist_id = playlist_entry.playlist_id
and			playlist_entry.song_id = song.song_id
and			song.album_id = album.album_id
and			album.album_id = release.album_id
and			release.artist_id = artist.artist_id
order by	subscriber_email, playlist_entry.playlist_id, playlist_entry.playlist_entry_position;

-- Show Highest Rated Songs
select 		song_title, song_genre, song_rating, song_plays
from 		song
where		song_rating = (	
							select 	max(song_rating)
							from 	song);

-- Show Most Played Song(s)
select 		song_title, song_genre, song_rating, song_plays
from 		song
where		song_plays = (	
							select max(song_plays)
							from song);



SPOOL OFF

