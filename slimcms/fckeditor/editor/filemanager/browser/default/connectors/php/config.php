<?php
/*
PHP Connector for the FCKEditor v2 File Manager
Written By Grant French, UK, Sept 2004
http://www.mcpuk.net

FCKEditor - By Frederico Caldeira Knabben
http://www.fckeditor.net

File Description:
Configuration file

*/

//Change normally only required for a web server not providing DOCUMENT_ROOT
//variable under $_SERVER in PHP if specified and not required this will be
//ignored. This may also be needed if the open_basedir setting is set.
$config['basedir']=$_SERVER['DOCUMENT_ROOT'];

//Path to user files relative to the document root (no trailing slash)
$config['UserFilesPath']="/img";


//Extensions that may be uploaded and viewed in each resource type
//        extensions should be specified in lowercase only.
$config['AllowedExtensions']['File']=array("zip","doc","xls","pdf","rtf","csv","jpg","gif","jpeg","png","avi","mpg","mpeg","swf","fla");
$config['AllowedExtensions']['Image']=array("jpg","gif","jpeg","png");
$config['AllowedExtensions']['Flash']=array("swf","fla");
$config['AllowedExtensions']['Media']=array("swf","fla","jpg","gif","jpeg","png","avi","mpg","mpeg");


//Maximum upload file size for each resource type
$config['MaxSize']['File']=2097152; //In Bytes (default: 2mb (2097152 bytes))
$config['MaxSize']['Image']=1048576; //In Bytes (default: 1mb (1048576 bytes))
$config['MaxSize']['Flash']=1048576; //In Bytes (default: 1mb (1048576 bytes))
$config['MaxSize']['Media']=5242880; //In Bytes (default: 5mb (5242880 bytes))


//Maximum size of a resource folder (Disk Quota's : Suggested by ralf57)
//Setting these to -1 disables the disk quota feature

//Global is the total of all resource type directories,
// individual resources types may also be quota'ed seperately.
$config['DiskQuota']['Global']=50; //In MBytes (default: 50mb)
$config['DiskQuota']['File']=10; //In MBytes (default: 10mb)
$config['DiskQuota']['Image']=10; //In MBytes (default: 10mb)
$config['DiskQuota']['Flash']=10; //In MBytes (default: 10mb)
$config['DiskQuota']['Media']=20; //In MBytes (default: 20mb)


//Hidden file & folder names should be in Extended Posix RegExp form
//(see http://www.tin.org/bin/man.cgi?section=7&topic=regex)

//Folders to hide from view
$config['HideFolders']['File']=array("^\."); //Hide all folders starting with . (hidden *nix folders)
$config['HideFolders']['Image']=array("^\.");
$config['HideFolders']['Flash']=array("^\.");
$config['HideFolders']['Media']=array("^\.");


//Files to hide from view
$config['HideFiles']['File']=array("^\."); //Hide all files starting with . (hidden *nix folders)
$config['HideFiles']['Image']=array("^\.");
$config['HideFiles']['Flash']=array("^\.");
$config['HideFiles']['Media']=array("^\.");


//The maximum length of a directory name the user is allowed to create
$config['MaxDirNameLength']=25;

//The characters allowed to appear in a new directory name
$config['DirNameAllowedChars']=array();

        //Allow numbers
        for($i=48;$i<58;$i++) array_push($config['DirNameAllowedChars'],chr($i));

        //Allow lowercase letters
        for($i=97;$i<123;$i++) array_push($config['DirNameAllowedChars'],chr($i));

        //Allow uppercase letters
        for($i=65;$i<91;$i++) array_push($config['DirNameAllowedChars'],chr($i));

        //Allow space,dash,underscore,dot
        array_push($config['DirNameAllowedChars']," ","-","_",".");


//Turn on/off debugging (sends output to a file as well as to the client)
$config['Debug']=false;


//File to send debugging information to (absolute path)
$config['DebugOutput']="/tmp/fck_conn_dbg";

//Allows for expansion of FCKEditors file browser in the future
$config['ResourceTypes'] = array('File','Image','Flash','Media');
$config['Commands'] = array("CreateFolder","GetFolders","GetFoldersAndFiles","FileUpload","Thumbnail","DeleteFile","DeleteFolder");

?>