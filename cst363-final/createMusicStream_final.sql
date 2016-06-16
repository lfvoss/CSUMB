
SPOOL C:\CST363_MySQL\createMusicStream_final.txt

/*
  Authors: Joe Sarabia, Lisa Voss, Wayne Webster, Austin Hasemeyer
  Date: 06/16
  Class: CST363
  Final Project: Create Tables / Music Streaming DB Entities
  Instructor: Dr. Wendy Wang
*/

DROP TABLE SUBSCRIPTION;
DROP TABLE SUBSCRIBER;
DROP TABLE PLAYLIST_ENTRY;
DROP TABLE PLAYLIST;
DROP TABLE RELEASE;
DROP TABLE SONG;
DROP TABLE ALBUM;
DROP TABLE ARTIST;

CREATE TABLE ARTIST(
	ARTIST_ID				CHAR(7), 
	ARTIST_NAME				VARCHAR2(15)	NOT NULL,
	ARTIST_INFO				VARCHAR(100),
	PRIMARY KEY (ARTIST_ID));

CREATE TABLE ALBUM(
	ALBUM_ID				CHAR(7),
	ALBUM_TITLE				VARCHAR2(35)	NOT NULL,
	ALBUM_RELEASE_DATE			DATE		NOT NULL,
	PRIMARY KEY (ALBUM_ID));

CREATE TABLE SONG(
	SONG_ID					CHAR(7)
	CONSTRAINT				SONG_ID_PK PRIMARY KEY,
	SONG_TITLE				VARCHAR2(35)	NOT NULL,
	SONG_TIME_MIN				NUMBER(2,0)	NOT NULL,
	SONG_TIME_SEC				NUMBER(2,0)	NOT NULL,
	SONG_GENRE				VARCHAR2(30)	NOT NULL,
	SONG_RATING				SMALLINT,
	SONG_PLAYS				INTEGER		NOT NULL,
	ALBUM_ID				CHAR(7),
	CONSTRAINT				ALBUM_ID1_FK
	FOREIGN KEY (ALBUM_ID)	REFERENCES ALBUM(ALBUM_ID));		

CREATE TABLE RELEASE( 
	ARTIST_ID				CHAR(7),
	SONG_ID					CHAR(7),
	ALBUM_ID				CHAR(7),
	CONSTRAINT				RELEASE_COMP_PK PRIMARY KEY(ARTIST_ID, SONG_ID, ALBUM_ID),
	CONSTRAINT				ARTIST_ID_FK
	FOREIGN KEY (ARTIST_ID)			REFERENCES ARTIST(ARTIST_ID),
	CONSTRAINT				SONG_ID1_FK
	FOREIGN KEY (SONG_ID)			REFERENCES SONG(SONG_ID),
	CONSTRAINT				ALBUM_ID2_FK
	FOREIGN KEY (ALBUM_ID)			REFERENCES ALBUM(ALBUM_ID));
	
CREATE TABLE PLAYLIST(
	PLAYLIST_ID				SMALLINT,
	PLAYLIST_NAME				VARCHAR(20)	NOT NULL	UNIQUE,
	PLAYLIST_PUBLIC				CHAR(1)		NOT NULL,
	PRIMARY KEY (PLAYLIST_ID));	

CREATE TABLE PLAYLIST_ENTRY(
	PLAYLIST_ID				SMALLINT,
	SONG_ID					CHAR(7),
	PLAYLIST_ENTRY_POSITION			SMALLINT	NOT NULL	UNIQUE,
	CONSTRAINT				PLAYLIST_COMP_PK PRIMARY KEY(PLAYLIST_ID, SONG_ID),
	CONSTRAINT				PLAYLIST_ID1_FK
	FOREIGN KEY (PLAYLIST_ID)		REFERENCES PLAYLIST(PLAYLIST_ID),
	CONSTRAINT				SONG_ID2_FK
	FOREIGN KEY (SONG_ID)			REFERENCES SONG(SONG_ID));

CREATE TABLE SUBSCRIBER(
	SUBSCRIBER_ID			CHAR(7)
	CONSTRAINT			SUBSCRIBER_ID_PK PRIMARY KEY,
	SUBSCRIBER_EMAIL		VARCHAR2(45),
	SUBSCRIBER_PASSWORD		VARCHAR2(12)	NOT NULL,
	SUBSCRIBER_FNAME		VARCHAR2(20)	NOT NULL,
	SUBSCRIBER_LNAME		VARCHAR2(25)	NOT NULL,
	SUBSCRIBER_INITIAL		CHAR(1),
	SUBSCRIBER_JOIN_DATE		DATE		NOT NULL,
	SUBSCRIBER_DOB			DATE,
	SUBSCRIBER_ZIPCODE		CHAR(5)		NOT NULL);

CREATE TABLE SUBSCRIPTION(
	SUBSCRIBER_ID			CHAR(7),
	PLAYLIST_ID			SMALLINT,
	SUBSCRIPTION_DATE		DATE 	NOT NULL,
	CONSTRAINT			SUBSCRIPTION_COMP_PK PRIMARY KEY(SUBSCRIBER_ID, PLAYLIST_ID),
	CONSTRAINT			SUBSCRIBER_ID_FK
	FOREIGN KEY (SUBSCRIBER_ID)	REFERENCES SUBSCRIBER(SUBSCRIBER_ID),
	CONSTRAINT					PLAYLIST_ID2_FK
	FOREIGN KEY (PLAYLIST_ID)	REFERENCES PLAYLIST(PLAYLIST_ID));

SPOOL OFF

