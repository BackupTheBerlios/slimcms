<?php
/*
PHP Connector for the FCKEditor v2 File Manager
Written By Grant French, UK, Sept 2004
http://www.mcpuk.net

FCKEditor - By Frederico Caldeira Knabben
http://www.fckeditor.net

File Description:
Implements the DeleteFolder command to delete a folder
in the current directory. Output is in XML
*/

class DeleteFolder {
	var $config;
	var $type;
	var $cwd;
	var $actual_cwd;
	var $newfolder;
	
	function DeleteFolder($config,$type,$cwd) {
		$this->config=$config;
		$this->type=$type;
		$this->raw_cwd=$cwd;
		$this->actual_cwd=str_replace("//","/",($config['UserFilesPath']."/$type/".$_GET['CurrentFolder']));
		$this->real_cwd=str_replace("//","/",($this->config['basedir']."/".$this->actual_cwd));
		$this->foldername=$_GET['FolderName'];
	}
	
	function run() {
		
		if ($this->delDir($this->real_cwd.'/'.$this->foldername)) {
			$err_no=0;
		} else {
			$err_no=202;
		}
		
		header ("content-type: text/xml");
		echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n";
		?>
<Connector command="DeleteFolder" resourceType="<?php echo $this->type; ?>">
	<CurrentFolder path="<?php echo $this->raw_cwd; ?>" url="<?php echo $this->actual_cwd; ?>" />
	<Error number="<?php echo "".$err_no; ?>" />
</Connector>
		<?php
	}
	
	
	function delDir($dir) {
		$dh=opendir($dir);
		if ($dh) {
			while ($entry=readdir($dh)) {
				if (($entry!=".")&&($entry!="..")) {
					if (is_dir($dir.'/'.$entry)) {
						$this->delDir($dir.'/'.$entry);	
					} else {
						$thumb=$dir.'/.thumb_'.$entry;
						if (file_exists($thumb)) if (!unlink($thumb)) return false;
						if (!unlink($dir.'/'.$entry)) return false;
					}
				}
			}	
			return rmdir($dir);
		} else {
			return false;
		}
	}
}

?>