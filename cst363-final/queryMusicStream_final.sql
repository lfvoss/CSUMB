
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
select song.SONG_TITLE as "Song Title", album.ALBUM_TITLE as "Album Title", ARTIST.ARTIST_NAME as "Artist", song.SONG_GENRE as "Album Genre" from song join album on song.ALBUM_ID = album.ALBUM_ID where song.SONG_GENRE = 'Rock';

COLUMN ARTIST_INFO HEADING 'Artist |Information';
COLUMN ARTIST_INFO FORMAT A20 WRAP;
SELECT * FROM ARTIST;

SPOOL OFF

