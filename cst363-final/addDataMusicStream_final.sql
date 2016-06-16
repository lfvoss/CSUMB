
SPOOL C:\CST363\addDataMusicStream_final.txt

/*
  Authors: Joe Sarabia, Lisa Voss, Wayne Webster, Austin Hasemeyer
  Date: 06/16
  Class: CST363
  Final Project: Add data to Music Streaming DB Entities
  Instructor: Dr. Wendy Wang
*/

INSERT INTO ARTIST	
	VALUES('LDZP068', 'Led Zeppelin', 'English rock bank founded in London in 1968');
INSERT INTO ARTIST	
	VALUES('ABCL094', 'Andrea Bocelli', 'Italian classical crossover tenor');
INSERT INTO ARTIST	
	VALUES('CURE076', 'The Cure', 'English rock bank founded in Crawley in 1976');
INSERT INTO ARTIST
	VALUES('BDYL060', 'Bob Dylan', 'American singer-songwriter');

INSERT INTO ALBUM
	VALUES('LDZP001', 'Led Zeppelin I', '12-Jan-1969');
INSERT INTO ALBUM
	VALUES('LDZP002', 'Led Zeppelin II', '22-Oct-1969');
INSERT INTO ALBUM
	VALUES('LDZP005', 'Houses of the Holy', '28-Mar-1973');
INSERT INTO ALBUM
	VALUES('LDZP006', 'Physical Graffiti', '24-Feb-1975');
INSERT INTO ALBUM
	VALUES('LDZPCMP', 'Led Zeppelin BBC Sessions', '11-Nov-1997');
INSERT INTO ALBUM
	VALUES('ABCL001', 'Il Mare Calmo della Sera', '18-Apr-1994');
INSERT INTO ALBUM
	VALUES('ABCL012', 'Incanto', '04-Nov-2008');
INSERT INTO ALBUM
	VALUES('CURE008', 'Disintegration', '02-May-1989');
INSERT INTO ALBUM
	VALUES('CURE012', 'The Cure', '29-Jun-2004');
INSERT INTO ALBUM
	VALUES('BDYL001', 'Bob Dylan', '19-Mar-1962');
INSERT INTO ALBUM
	VALUES('BDYL006', 'Highway 61 Revisted', '30-Aug-1965');

INSERT INTO SONG
	VALUES('BDYLRLS', 'Like a Rolling Stone', 06, 09, 'Contemporary Folk', 100, 152, 'BDYL006');
INSERT INTO SONG
	VALUES('CUREPCS', 'Pictures of You', 07, 28, 'Indie', 100, 93, 'CURE008');
 
INSERT INTO RELEASE
	VALUES('CURE076', 'CUREPCS', 'CURE008');
INSERT INTO RELEASE
	VALUES('BDYL060', 'BDYLRLS', 'BDYL006');	

INSERT INTO PLAYLIST
	VALUES(1, 'Roadtrip08', 'Y');
INSERT INTO PLAYLIST
	VALUES(2, 'Downtime', 'Y');
INSERT INTO PLAYLIST
	VALUES(3, 'Italian Dinnertime', 'Y');
INSERT INTO PLAYLIST
	VALUES(4, 'Workday Commute', 'N');
	
INSERT INTO PLAYLIST_ENTRY
	VALUES(2, 'BDYLRLS', 1); 	
INSERT INTO PLAYLIST_ENTRY
	VALUES(2, 'CUREPCS', 2);

INSERT INTO SUBSCRIBER
	VALUES('9438911', 'jguardia@gmail.com', 'Pumpk1n!', 'Janelle', 'Guardia', 'F', '01-May-2015', '19-Feb-1988', '81702');
INSERT INTO SUBSCRIBER
	VALUES('8733090', 'frangelle@hotmail.com', 'P0o9i8u7y6*', 'Frangelle', 'Jolie', 'N', '08-Dec-2012', '31-Dec-1977', '93210'); 

INSERT INTO SUBSCRIPTION
	VALUES('9438911', 2, '22-May-2015');
INSERT INTO SUBSCRIPTION
	VALUES('8733090', 2, '02-Jan-2013');

SPOOL OFF

SPOOL OFF

