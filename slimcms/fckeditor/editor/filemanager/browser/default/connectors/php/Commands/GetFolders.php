<?php
/*
PHP Connector for the FCKEditor v2 File Manager
Written By Grant French, UK, Sept 2004
http://www.mcpuk.net

FCKEditor - By Frederico Caldeira Knabben
http://www.fckeditor.net

File Description:
Implements the GetFolders command, to list the folders 
in the current directory. Output is in XML

*/

class GetFolders {
	var $config;
	var $type;
	var $cwd;
	var $actual_cwd;
	
	function GetFolders($config,$type,$cwd) {
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
<Connector command="GetFolders" resourceType="<?php echo $this->type; ?>">
	<CurrentFolder path="<?php echo $this->raw_cwd; ?>" url="<?php echo $this->actual_cwd; ?>" />
	<Folders>
		<?php
			if ($dh=opendir($this->real_cwd)) {
				while (($filename=readdir($dh))!==false) {
					if (($filename!=".")&&($filename!="..")) {
						if (is_dir($this->real_cwd."/$filename")) {
							
							//check if configured not to show this folder
							$hide=false;
							for($i=0;$i<sizeof($this->config['HideFolders'][$this->type]);$i++) 
								$hide=(ereg($this->config['HideFolders'][$this->type][$i],$filename)?true:$hide);
							
							if (!$hide) echo "<Folder name=\"$filename\" />\n";
						}
					}
				}
				closedir($dh);
			}
		?>
	</Folders>
</Connector>
		<?php
	}
}

?>