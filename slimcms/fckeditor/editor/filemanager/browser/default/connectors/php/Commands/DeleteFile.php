<?php
/*
PHP Connector for the FCKEditor v2 File Manager
Written By Grant French, UK, Sept 2004
http://www.mcpuk.net

FCKEditor - By Frederico Caldeira Knabben
http://www.fckeditor.net

File Description:
Implements the DeleteFile command to delete a file
in the current directory. Output is in XML
*/

class DeleteFile {
	var $config;
	var $type;
	var $cwd;
	var $actual_cwd;
	var $newfolder;
	
	function DeleteFile($config,$type,$cwd) {
		$this->config=$config;
		$this->type=$type;
		$this->raw_cwd=$cwd;
		$this->actual_cwd=str_replace("//","/",($config['UserFilesPath']."/$type/".$_GET['CurrentFolder']));
		$this->real_cwd=str_replace("//","/",($this->config['basedir']."/".$this->actual_cwd));
		$this->filename=$_GET['FileName'];
	}
	
	function run() {
		$result1=false;
		$result2=true;
		
		$thumb=$this->real_cwd.'/.thumb_'.$this->filename;
		$result1=unlink($this->real_cwd.'/'.$this->filename);
		if (file_exists($thumb)) $result2=unlink($thumb);
		
		header ("content-type: text/xml");
		echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n";
		?>
<Connector command="DeleteFolder" resourceType="<?php echo $this->type; ?>">
	<CurrentFolder path="<?php echo $this->raw_cwd; ?>" url="<?php echo $this->actual_cwd; ?>" />
	<?php
		if ($result1&&$result2) {
			$err_no=0;
		} else {
			$err_no=202;
		}
		
	?>
	<Error number="<?php echo "".$err_no; ?>" />
</Connector>
		<?php
	}
}

?>