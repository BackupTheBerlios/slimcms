PHP Connector for the FCKEditor v2 File Manager
Written By Grant French, Sept 2004
grant@mcpuk.net - http://www.mcpuk.net 

FCK Editor - Written By Frederico Caldeira Knabben
http://www.fckeditor.net 

Icons supplied for file types from everaldo - 
http://www.everaldo.com


!!PLEASE READ THROUGH THIS README *BEFORE* CRYING FOR HELP!!


NOTES:
------

This software is provided as is with no guarantees or
warranties what so ever. It has been tested under:-

PHP 4.3.3 / Apache 1.3.28 (OpenBSD 4.4)
PHP 4.3.3 / Apache 1.3.27 (WinXP Pro)
PHP 4.3.8 / Apache 1.3.31 (FreeBSD)
PHP 5.0.2 / Apache 2.0.50 (Linux)


A small effort has been made to introduce windows(IIS) compatibility
but has not been tested in any way. If you have this working on 
a different platform in particular under IIS or another non 
apache environment please contact me so it can be added to the 
list.

!!! if you specify the relative path of the connector in 
	the fckconfig.js file you may experience some unusual
	behaviour mainly in firefox, like the resource list
	failing to refresh. To avoid this specify the absolute
	path of the connector.

	
	
SETUP FOR JUST CONNECTOR:
-------------------------

The php folder in this zip can go anywhere in the webroot.

(test script included, visit the testme.php file in the php folder
in your webbrowser, doesnt test file upload, thumbnail, deletefolder,
deletefile commands yet, but it may help find problems.)

(Jump to recommended changes if you dont want the extra features)



SETUP FOR EXTRAS:
-----------------

the Folder96.jpg file in the bits folder need to go in the
/editor/filemanager/browser/default/images/ folder.

the frmresourceslist.html should overwrite the file in the
/editor/filemanager/browser/default/ folder.



RECOMMENDED CHANGES:
--------------------
all referenced files in in 
editor/filemanager/browser/default/ 
unless specified otherwise.

1.
comment out (prefix with //) line 57 of frmupload.html 

("document.getElementById('NewFile').reset() ;")

this line sometimes causes problems mainly with IE
not allowing the user to submit a second file.

---

2.
change line 73 of the frmupload.html file from:

alert( 'Invalid file' ) ;
	to
alert( 'Error, "'+fileName+'"' ) ;

to allow for more informative error message to be passed from
the connector to the user.

---

3.
change line 151 in frmfolders.html from:

OpenFolder ( '/' ) ;

to

{
	oListManager.ShowUpFolder( '/' ) ;
	sActiveFolder = folderPath ;
	oConnector.SendCommand( 'GetFolders', null, GetFoldersCallBack ) ;	
}

(include the braces, there not just for decoration)
This makes the root level folders appear in the left
frame, rather than starting with a blank box.

---

if you have problems in firefox please look at:
http://sourceforge.net/tracker/index.php?func=detail&aid=1025909&group_id=75348&atid=543653




CONFIGURATION:
--------------
the connector.php file must be referenced in the fckconfig.js file e.g.

Example Configuration (fckconfig.js)
------------------------------------

FCKConfig.LinkBrowserURL = 
	FCKConfig.BasePath + 
	"filemanager/browser/default/browser.html?Connector=" + 
	FCKConfig.BasePath + 
	"filemanager/browser/default/connectors/php/connector.php" ;

FCKConfig.LinkUploadURL = 
	FCKConfig.BasePath + 
	"filemanager/browser/default/browser.html?Connector=" + 
	FCKConfig.BasePath + 
	"filemanager/browser/default/connectors/php/connector.php" ;

FCKConfig.ImageBrowserURL = 
	FCKConfig.BasePath + 
	"filemanager/browser/default/browser.html?Type=Image&Connector=" + 
	FCKConfig.BasePath + 
	"filemanager/browser/default/connectors/php/connector.php" ;
	

Please make sure you comment out or remove any other lines in the 
fckconfig.js starting with:
FCKConfig.ImageBrowserURL =
FCKConfig.LinkUploadURL = 
FCKConfig.LinkBrowserURL = 

in this case the php folder in this zip was placed in the 
filemanager/browser/default/connectors/ folder in the 
FCKEditor's base directory.

Then look at the config.php and customize it to your needs, 
it is fully comments so this should be quite simple.




FILE & FOLDER SETUP:
--------------------

1. Create the user files folder (set in the config.php) and 
	the following folders inside that:
		Image
		File
		Media
		Flash

2. Chmod each of these so they are writeable to the php processes user. 
	(if all else fails chmod 0777 them)



FINAL NOTE:
-----------

1. After testing it is recommended that you remove the testme.php file.
2. Limited support will be provided by email as and when i have time.
3. Think you could do a better job of the readme? Go on then...
4. If you have any ideas share them either by mailing me or in the 
	forum for the fckeditor (sf.net/projects/fckeditor/forums)


LICENSE:
--------

LGPL - Lesser General Public License (see LICENSE.txt file)

