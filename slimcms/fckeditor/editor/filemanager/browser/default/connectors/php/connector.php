<?php
/*
PHP Connector for the FCKEditor v2 File Manager
Written By Grant French, UK, Sept 2004
http://www.mcpuk.net

FCKEditor - By Frederico Caldeira Knabben
http://www.fckeditor.net

File Description:
Main connector file, implements the State Pattern to
redirect requests to the appropriate class based on
the command name passed.
*/

error_reporting(E_ALL);

require_once "config.php";
if (!isset($_SERVER['DOCUMENT_ROOT'])) $_SERVER["DOCUMENT_ROOT"] = substr($_SERVER['PATH_TRANSLATED'], 0, strlen($_SERVER['REQUEST_URI']) * - 1);

if ($config['Debug']===true) ob_start();
outputHeaders();

//These are the commands we may expect
$valid_commands=$config['Commands'];
$valid_resource_types=$config['ResourceTypes'];

//Get the passed data
$command=(
                ((isset($_GET['Command']))&&($_GET['Command']!=""))?
                        $_GET['Command']:
                        ""
                );

$type=(
                ((isset($_GET['Type']))&&($_GET['Type']!=""))?
                        $_GET['Type']:
                        "File"
                );

$cwd=(
                ((isset($_GET['CurrentFolder']))&&($_GET['CurrentFolder']!=""))?
                        $_GET['CurrentFolder']:
                        "/"
                );


if (in_array($command,$valid_commands)) {

        //bit of validation
        if (!in_array($type,$valid_resource_types)) {
                echo "Invalid resource type.";
                if ($config['Debug']===true) recordOutput();
                exit(0);
        }

        require_once "Commands/$command.php";

        $action=new $command($config,$type,$cwd);

        $action->run();
        if ($config['Debug']===true) recordOutput();

} else {
        //No reason for me to be here.
        echo "Invalid command.";
        if ($config['Debug']===true) recordOutput();
        exit(0);
}


function recordOutput() {
        global $config;

        if ($config['Debug']===true) {
                $contents=ob_get_contents();
                if (strlen($contents)>0) {
                        if ($fh=fopen($config['DebugOutput'],"w")) {
                                fwrite($fh,"\n\$_GET::\n".print_r($_GET,true)."\n");
                                fwrite($fh,$contents);
                                fclose($fh);
                        }
                }
                ob_flush();
        }
}

function outputHeaders() {

        //Anti browser caching headers
        //Borrowed from fatboy's implementation  (fatFCK@code247.com)

        // ensure file is never cached
        // Date in the past
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

        // always modified
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

        // HTTP/1.1
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);

        // HTTP/1.0
        header("Pragma: no-cache");
}
?> 