<html>
<head>
        <title>Test PHP Connector</title>
</head>
<body>
<?php
        error_reporting(E_ALL ^ E_NOTICE);

        include "config.php";

        $resources=$config['ResourceTypes'];

        $dr=$config['basedir'];
        $actual_userfolder=str_replace("//","/",$dr."/".$config['UserFilesPath']."/");

        echo "Base Dir is set to: $dr<br />\n";
        echo "PHP_SELF: ".$_SERVER['PHP_SELF']."<br />\n";

        echo "\n<br /><hr /><br />\n";

        echo "Checking for mime magic support: ".((function_exists("mime_content_type"))?"Yes":"No - you won't get icons by mime type")."<br />";
        echo "Checking for GD support: ".((function_exists("imagecreate"))?"Yes":"No - you won't get thumbnails for images")."<br />";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;JPEG Support: ".((function_exists("imagecreatefromjpeg"))?"Yes":"No - you won't get thumbnails for jpeg images")."<br />";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;PNG Support: ".((function_exists("imagecreatefrompng"))?"Yes":"No - you won't get thumbnails for png images")."<br />";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;GIF Support: ".((function_exists("imagecreatefromgif"))?"Yes":"No - you won't get thumbnails for gif images")."<br />";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;Image Write Support: ".((function_exists("imagegif") || function_exists("imagepng") || function_exists("imagejpeg"))?"Yes":"No - you won't get thumbnails for any images, as i cant write GIFs, PNGs or JPEGs")."<br />";

        echo "\n<br /><hr /><br />\n";

        echo "Checking if user files folder exists ($actual_userfolder): ";
        if (is_dir($actual_userfolder)) {
                echo "[ Passed ]<br />\n";
        } else {
                echo "[ Failed ] <br />Task: Create the user files folder in the webroot and point the config.php file to it.<br />\n";
                echo "Skipping all other tests, fix this one first.";
                exit(0);
        }
        echo "\n<br /><hr /><br />\n";
        echo "Checking for resource type folders under user file folder: <br />\n";
        foreach ($resources as $value) {
                $passed=false;
                echo "&nbsp;&nbsp;&nbsp;&nbsp;$value exists: ";
                if (is_dir(($actual_userfolder.$value))) {
                        echo "[ Passed ]<br />\n";
                        $passed=true;
                } else {
                        echo "[ Failed ]<br /> Task: chmod this folder to make it writeable to the php processes user.<br />\n";
                }

                echo "&nbsp;&nbsp;&nbsp;&nbsp;$value writeable: ";
                if ($passed) {
                        if (is_writeable(($actual_userfolder.$value))) {
                                echo "[ Passed ]<br />\n";
                        } else {
                                echo "[ Failed ]<br /> Task: chmod this folder to make it writeable to the php processes user.<br />\n";
                        }
                } else {
                        echo "[ Skipped ]<br />\n";
                }
                echo "<br />\n";
        }

        echo "Checking if open_basedir restriction in place: (".((($bd=ini_get("open_basedir"))==null)?"Not Set":$bd." - This may cause you some troubles.").")<br />";
        echo "Trying an opendir on the user files folder: ".((opendir($actual_userfolder))?"[ Passed ]":"[ Failed ]")."<br />";

        echo "\n<br /><hr /><br />\n";


                $uri="http".((isset($_SERVER['HTTPS']))?"s":"")."://".$_SERVER['SERVER_NAME'].dirname($_SERVER['REQUEST_URI'])."/";


                echo "Requesting connector.php?Command=GetFolders&Type=Image&CurrentFolder=/ :<br />\n
                        <div style=\"border-style:solid;border-width:1px;border-color:#000000\">\n";

                $test = implode("",file($uri."connector.php?Command=GetFolders&Type=Image&CurrentFolder=/"));
                $test=htmlentities($test);
                echo str_replace("\n","<br />",$test);
                echo "</div> Please do a sanity check on this, it should be something like: \n
                        <div style=\"border-style:solid;border-width:1px;border-color:#000000\">\n";

                $expect="
<?xml version=\"1.0\" encoding=\"utf-8\" ?>
<Connector command=\"GetFolders\" resourceType=\"Image\">
    <CurrentFolder path=\"/\" url=\"/data/resources/Image/\" />
    <Folders>
    </Folders>
</Connector>";


                $expect=htmlentities($expect);
                $expect=str_replace(array("\n","\r"),"<br />",$expect);
                echo "<b>EXAMPLE RESPONSE</b>".$expect;
                ?>
                </div>
                <br /><br />
                <?php

                echo "\n<br /><hr /><br />\n";

                echo "Requesting connector.php?Command=GetFoldersAndFiles&Type=Image&CurrentFolder=/ :<br />\n
                        <div style=\"border-style:solid;border-width:1px;border-color:#000000\">\n";

                $test = implode("",file($uri."connector.php?Command=GetFoldersAndFiles&Type=Image&CurrentFolder=/"));
                $test=htmlentities($test);
                echo str_replace("\n","<br />",$test);
                echo "</div> Please do a sanity check on this, it should be something like: \n
                        <div style=\"border-style:solid;border-width:1px;border-color:#000000\">\n";

                $expect="
<?xml version=\"1.0\" encoding=\"utf-8\" ?>
<Connector command=\"GetFoldersAndFiles\" resourceType=\"Image\">
<CurrentFolder path=\"/\" url=\"/data/resources/Image/\" />
<Folders>
</Folders>
<Files>
</Files>
</Connector>";


                $expect=htmlentities($expect);
                $expect=str_replace(array("\n","\r"),"<br />",$expect);
                echo "<b>EXAMPLE RESPONSE</b>".$expect;
                ?>
                </div>
                <br /><br />
                <?php

                echo "\n<br /><hr /><br />\n";

                echo "Requesting connector.php?Command=CreateFolder&Type=Image&CurrentFolder=/&NewFolderName=TestFolder99 :<br />\n
                        <div style=\"border-style:solid;border-width:1px;border-color:#000000\">\n";

                $test = implode("",file($uri."connector.php?Command=CreateFolder&Type=Image&CurrentFolder=/&NewFolderName=TestFolder99"));
                $test=htmlentities($test);
                echo str_replace("\n","<br />",$test);
                echo "</div> Please do a sanity check on this, it should be something like: \n
                        <div style=\"border-style:solid;border-width:1px;border-color:#000000\">\n";

                $expect="
<?xml version=\"1.0\" encoding=\"utf-8\" ?>
<Connector command=\CreateFolder\" resourceType=\"Image\">
<CurrentFolder path=\"/\" url=\"/data/resources/Image/\" />
        <Error number=\"0\" />
</Connector>";


                $expect=htmlentities($expect);
                $expect=str_replace(array("\n","\r"),"<br />",$expect);
                echo "<b>EXAMPLE RESPONSE</b>".$expect;
                ?>
                </div>
                <br /><br />
                <?php

                echo "\n<br /><hr /><br />\n";

                echo "Attempting to delete the new folder: ";
                if (rmdir($actual_userfolder."Image/TestFolder99")) {
                        echo "[ Passed ]<br />\n";
                } else {
                        echo "[ Failed ] <br />Create new folder command failed?<br />\n";
                }

?>
</body>
</html> 