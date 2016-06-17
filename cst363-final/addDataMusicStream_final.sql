
SPOOL C:\CST363\addDataMusicStream_final.txt

/*
  Authors: Joe Sarabia, Lisa Voss, Wayne Webster
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
INSERT INTO ARTIST
	VALUES('PRJM001', 'Pearl Jam', 'Seattle grunge band, formed in the early 1990s');

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
INSERT INTO ALBUM
	VALUES('PRJM025', 'Ten', '27-Aug-1991');
INSERT INTO ALBUM
	VALUES('PRJM050', 'Vs.', '19-Oct-1993');

INSERT INTO RELEASE
	VALUES('CURE076', 'CURE012');
INSERT INTO RELEASE
	VALUES('BDYL060', 'BDYL001');
INSERT INTO RELEASE
	VALUES('PRJM001', 'PRJM025');
INSERT INTO RELEASE
	VALUES('PRJM001', 'PRJM050');		

INSERT INTO SONG
	VALUES('BDYLRLS', 1, 'Like a Rolling Stone', 373, 'Contemporary Folk', 100, 152, 'BDYL006');
INSERT INTO SONG
	VALUES('CUREPCS', 2, 'Pictures of You', 449, 'Indie', 100, 93, 'CURE008');
INSERT INTO SONG
	VALUES('PRJM026', 1, 'Once', 232, 'Grunge', 95, 0, 'PRJM025');
INSERT INTO SONG
	VALUES('PRJM027', 2, 'Even Flow', 294, 'Grunge', 100, 0, 'PRJM025');
INSERT INTO SONG
	VALUES('PRJM028', 3, 'Alive', 341, 'Grunge', 98, 0, 'PRJM025');
INSERT INTO SONG
	VALUES('PRJM029', 4, 'Why Go', 200, 'Grunge', 89, 0, 'PRJM025');
INSERT INTO SONG
	VALUES('PRJM030', 5, 'Black', 344, 'Grunge', 100, 0, 'PRJM025');
INSERT INTO SONG
	VALUES('PRJM031', 6, 'Jeremy', 319, 'Grunge', 85, 0, 'PRJM025');
INSERT INTO SONG
	VALUES('PRJM032', 7, 'Oceans', 162, 'Grunge', 91, 0, 'PRJM025');
INSERT INTO SONG
	VALUES('PRJM033', 8, 'Porch', 211, 'Grunge', 97, 0, 'PRJM025');
INSERT INTO SONG
	VALUES('PRJM034', 9, 'Garden', 299, 'Grunge', 91, 0, 'PRJM025');
INSERT INTO SONG
	VALUES('PRJM035', 10, 'Deep', 258, 'Grunge', 88, 0, 'PRJM025');
INSERT INTO SONG
	VALUES('PRJM036', 11, 'Release', 546, 'Grunge', 94, 0, 'PRJM025');
INSERT INTO SONG
	VALUES('PRJM051', 1, 'Go', 193, 'Rock', 91, 0, 'PRJM050');
INSERT INTO SONG
	VALUES('PRJM052', 2, 'Animal', 169, 'Rock', 91, 0, 'PRJM050');
INSERT INTO SONG
	VALUES('PRJM053', 3, 'Daughter', 235, 'Rock', 93, 0, 'PRJM050');
INSERT INTO SONG
	VALUES('PRJM054', 4, 'Glorified G', 207, 'Rock', 89, 0, 'PRJM050');
INSERT INTO SONG
	VALUES('PRJM055', 5, 'Dissident', 215, 'Rock', 92, 0, 'PRJM050');
INSERT INTO SONG
	VALUES('PRJM056', 6, 'W.M.A.', 359, 'Rock', 87, 0, 'PRJM050');
INSERT INTO SONG
	VALUES('PRJM057', 7, 'Blood', 171, 'Rock', 92, 0, 'PRJM050');
INSERT INTO SONG
	VALUES('PRJM058', 8, 'Rearviewmirror', 284, 'Rock', 95, 0, 'PRJM050');
INSERT INTO SONG
	VALUES('PRJM059', 9, 'Rats', 255, 'Rock', 86, 0, 'PRJM050');
INSERT INTO SONG
	VALUES('PRJM060', 10, 'Elderly Woman Behind the Counter...', 196, 'Rock', 98, 0, 'PRJM050');
INSERT INTO SONG
	VALUES('PRJM061', 11, 'Leash', 190, 'Rock', 87, 0, 'PRJM050');
INSERT INTO SONG
	VALUES('PRJM062', 12, 'Indifference', 302, 'Rock', 94, 0, 'PRJM050');

INSERT INTO PLAYLIST
	VALUES(1, 'Roadtrip08', 'Y');
INSERT INTO PLAYLIST
	VALUES(2, 'Downtime', 'Y');
INSERT INTO PLAYLIST
	VALUES(3, 'Italian Dinnertime', 'Y');
INSERT INTO PLAYLIST
	VALUES(4, 'Workday Commute', 'N');
INSERT INTO PLAYLIST 
	VALUES(5, 'Pearl Jam Jams', 'N');
	
INSERT INTO PLAYLIST_ENTRY
	VALUES(2, 'BDYLRLS', 1); 	
INSERT INTO PLAYLIST_ENTRY
	VALUES(2, 'CUREPCS', 2);
INSERT INTO PLAYLIST_ENTRY
	VALUES(4, 'BDYLRLS', 1);
INSERT INTO PLAYLIST_ENTRY
	VALUES(5, 'PRJM033', 1);
INSERT INTO PLAYLIST_ENTRY
	VALUES(5, 'PRJM058', 2);
INSERT INTO PLAYLIST_ENTRY
	VALUES(5, 'PRJM051', 3);

INSERT INTO SUBSCRIBER
	VALUES('9438911', 'jguardia@gmail.com', 'Pumpk1n!', 'Janelle', 'Guardia', 'F', '01-May-2015', '19-Feb-1988', '81702');
INSERT INTO SUBSCRIBER
	VALUES('8733090', 'frangelle@hotmail.com', 'P0o9i8u7y6*', 'Frangelle', 'Jolie', 'N', '08-Dec-2012', '31-Dec-1977', '93210'); 

INSERT INTO SUBSCRIPTION
	VALUES('9438911', 2, '22-May-2015');
INSERT INTO SUBSCRIPTION
	VALUES('8733090', 2, '02-Jan-2013');
INSERT INTO SUBSCRIPTION
	VALUES('8733090', 5, '15-Jun-2016');
INSERT INTO SUBSCRIPTION
	VALUES('8733090', 4, '04-Jul-2014');

SPOOL OFF

SPOOL OFF

