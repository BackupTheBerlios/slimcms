<?php
/*
PHP Connector for the FCKEditor v2 File Manager
Written By Grant French, UK, Sept 2004
http://www.mcpuk.net

FCKEditor - By Frederico Caldeira Knabben
http://www.fckeditor.net

File Description:
Implements the GetFoldersAndFiles command, to list
files and folders in the current directory.
Output is in XML
*/

class GetFoldersAndFiles {
	var $config;
	var $type;
	var $cwd;
	var $actual_cwd;
	
	function GetFoldersAndFiles($config,$type,$cwd) {
		$this->config=$config;
		$this->type=$type;
		$this->raw_cwd=$cwd;
		$this->actual_cwd=str_replace("//","/",($config['UserFilesPath']."/$type/".$_GET['CurrentFolder']));
		$this->real_cwd=str_replace("//","/",($this->config['basedir']."/".$this->actual_cwd));
	}
	
	function run() {
		header ("content-type: text/xml");
		echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n";
		?>
<Connector command="GetFoldersAndFiles" resourceType="<?php echo $this->type; ?>">
	<CurrentFolder path="<?php echo $this->raw_cwd; ?>" url="<?php echo $this->actual_cwd; ?>" />
	<Folders>
<?php
			$files=array();
			if ($dh=opendir($this->real_cwd)) {
				while (($filename=readdir($dh))!==false) {
					if (($filename!=".")&&($filename!="..")) {
						if (is_dir($this->real_cwd."/$filename")) {
							//check if configured not to show this folder
							$hide=false;
							for($i=0;$i<sizeof($this->config['HideFolders'][$this->type]);$i++) 
								$hide=(ereg($this->config['HideFolders'][$this->type][$i],$filename)?true:$hide);
							
							if (!$hide) echo "\t\t<Folder name=\"$filename\" />\n";
							
						} else {
							array_push($files,$filename);
						}
					}
				}
				closedir($dh); 
			}
			echo "\t</Folders>\n";
			echo "\t<Files>\n";

			for ($i=0;$i<sizeof($files);$i++) {
				
				$lastdot=strrpos($files[$i],".");
				
				if ($lastdot!==false) {
					$ext=substr($files[$i],($lastdot+1));
					
					if (in_array(strtolower($ext),$this->config['AllowedExtensions'][$this->type])) {
						//check if configured not to show this file
						$hide=false;
						for($j=0;$j<sizeof($this->config['HideFiles'][$this->type]);$j++) 
							$hide=(ereg($this->config['HideFiles'][$this->type][$j],$files[$i])?true:$hide);
						
						if (!$hide) echo "\t\t<File name=\"".$files[$i]."\" size=\"".ceil(filesize($this->real_cwd."/".$files[$i])/1024)."\" />\n";	

					}
				}
				
			}
		
			echo "\t</Files>\n"; 
			echo "</Connector>\n";
	}
}

?>