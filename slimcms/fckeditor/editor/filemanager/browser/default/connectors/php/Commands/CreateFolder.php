<?php
/*
PHP Connector for the FCKEditor v2 File Manager
Written By Grant French, UK, Sept 2004
http://www.mcpuk.net

FCKEditor - By Frederico Caldeira Knabben
http://www.fckeditor.net

File Description:
Implements the CreateFolder command to make a new folder
in the current directory. Output is in XML
*/

class CreateFolder {
	var $config;
	var $type;
	var $cwd;
	var $actual_cwd;
	var $newfolder;
	
	function CreateFolder($config,$type,$cwd) {
		$this->config=$config;
		$this->type=$type;
		$this->raw_cwd=$cwd;
		$this->actual_cwd=str_replace("//","/",($config['UserFilesPath']."/$type/".$_GET['CurrentFolder']));
		$this->real_cwd=str_replace("//","/",($this->config['basedir']."/".$this->actual_cwd));
		$this->newfolder=$_GET['NewFolderName'];
	}
	
	function checkFolderName($folderName) {
		
		//Check the name is not too long
		if (strlen($folderName)>$this->config['MaxDirNameLength']) return false;
		
		//Check that it only contains valid characters
		for($i=0;$i<strlen($folderName);$i++) if (!in_array(substr($folderName,$i,1),$this->config['DirNameAllowedChars'])) return false;
		
		//If it got this far all is ok
		return true;
	}
	
	function run() {
		header ("content-type: text/xml");
		echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n";
		?>
<Connector command="CreateFolder" resourceType="<?php echo $this->type; ?>">
	<CurrentFolder path="<?php echo $this->raw_cwd; ?>" url="<?php echo $this->actual_cwd; ?>" />
	<?php
		$newdir=str_replace("//","/",($this->real_cwd."/".$this->newfolder));
		
		//Check the new name
		if ($this->checkFolderName($this->newfolder)) {
			
			//Check if it already exists
			if (is_dir($newdir)) {
				$err_no=101; //Folder already exists
			} else {
				
				//Check if we can create the directory here
				if (is_writeable($this->real_cwd)) {
					
					//Make the directory
					if (mkdir($newdir,0777)) {
						$err_no=0; //Success
					} else {
					
						$err_no=110; //Unknown error
					}	
				} else {
					$err_no=103; //No permissions to create
				}
			}
		} else {
			$err_no=102; //Invalid Folder Name
		}
		
	?>
	<Error number="<?php echo "".$err_no; ?>" />
</Connector>
		<?php
	}
}

?>