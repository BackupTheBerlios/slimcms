<?php
/*
PHP Connector for the FCKEditor v2 File Manager
Written By Grant French, UK, Sept 2004
http://www.mcpuk.net

FCKEditor - By Frederico Caldeira Knabben
http://www.fckeditor.net

File Description:
Implements the FileUpload command,
Checks the file uploaded is allowed, 
then moves it to the user data area. 
*/

class FileUpload {
	var $config;
	var $type;
	var $cwd;
	var $actual_cwd;
	var $newfolder;
	
	function FileUpload($config,$type,$cwd) {
		$this->config=$config;
		$this->type=$type;
		$this->raw_cwd=$cwd;
		$this->actual_cwd=str_replace("//","/",($config['UserFilesPath']."/$type/".$_GET['CurrentFolder']));
		$this->real_cwd=str_replace("//","/",($this->config['basedir']."/".$this->actual_cwd));
	}
	
	function run() {
		
		header ("content-type: text/html");
		if (sizeof($_FILES)>0) {
			if (array_key_exists("NewFile",$_FILES)) {
				if ($_FILES['NewFile']['size']<$this->config['MaxSize'][$this->type]) {

					$filename=$_FILES['NewFile']['name'];
					
					$lastdot=strrpos($filename,".");
					
					if ($lastdot!==false) {
						$ext=substr($filename,($lastdot+1));
						$filename=substr($filename,0,$lastdot);
						
						if (in_array(strtolower($ext),$this->config['AllowedExtensions'][$this->type])) {
						
							$test=0;
							$dirSizes=array();
							$globalSize=0;
							$failSizeCheck=false;
							if ($this->config['DiskQuota']['Global']!=-1) {
								foreach ($this->config['ResourceTypes'] as $resType) {
									
									$dirSizes[$resType]=
										$this->getDirSize(
											$this->config['basedir']."/".$this->config['UserFilesPath']."/$resType");
									
									if ($dirSizes[$resType]===false) {
										//Failed to stat a directory, fall out
										$failSizeCheck=true;
										$msg="\\nUnable to determine the size of a folder.";
										break;
									}
									$globalSize+=$dirSizes[$resType];
								}
								
								$globalSize+=$_FILES['NewFile']['size'];
								
								if (!$failSizeCheck) {
									if ($globalSize>($this->config['DiskQuota']['Global']*1048576)) {
										$failSizeCheck=true;
										$msg="\\nYou are over the global disk quota.";
									}
								}
							}
							
							if (($this->config['DiskQuota'][$this->type]!=-1)&&(!$failSizeCheck)) {
								if ($this->config['DiskQuota']['Global']==-1) {
									$dirSizes[$this->type]=
										$this->getDirSize(
											$this->config['basedir']."/".$this->config['UserFilesPath']."/".$this->type);
								}
								
								if (($dirSizes[$this->type]+$_FILES['NewFile']['size'])>
									($this->config['DiskQuota'][$this->type]*1048576)) {
									$failSizeCheck=true;	
									$msg="\\nYou are over the disk quota for this resource type.";
								}
							}
							
							if ((($this->config['DiskQuota']['Global']!=-1)||($this->config['DiskQuota'][$this->type]!=-1))&&$failSizeCheck) {
								//Disk Quota over
								$disp="202,'Over disk quota, ".$msg."'";
							} else {
						
								if (file_exists($this->real_cwd."/$filename.$ext")) {
									$taskDone=false;
									
									//File already exists, try renaming
									//If there are more than 200 files with
									//	the same name giveup
									for ($i=1;(($i<200)&&($taskDone==false));$i++) {
										if (!file_exists($this->real_cwd."/$filename($i).$ext")) {
											if (move_uploaded_file($_FILES['NewFile']['tmp_name'],($this->real_cwd."/$filename($i).$ext"))) {
												$disp="201,'$filename($i).$ext'";
											} else {
												$disp="202,'Failed to upload file, internal error.'";
											}
											$taskDone=true;	
										}
									}
									if ($taskDone==false) {
										$disp="202,'Failed to upload file, internal error..'";
									}
								} else {
									//Upload file
									if (move_uploaded_file($_FILES['NewFile']['tmp_name'],($this->real_cwd."/$filename.$ext"))) {
										$disp="0";
									} else {
										$disp="202,'Failed to upload file, internal error...'";
									}
								}
							}
						} else {
							//Disallowed file extension
							$disp="202,'Disallowed file type.'";
						}
						
					} else {
						//No file extension to check
						$disp="202,'Unable to determine file type.'";
					}	
					
				} else {
					//Too big
					$disp="202,'This file exceeds the maximum upload size.'";
				}
			} else {
				//No file uploaded with field name NewFile
				$disp="202,'Unable to find uploaded file.'";
			}
		} else {
			//No files uploaded
			
			//Should really send something back saying
			//invalid file, but this breaks the filemanager 
			//with firefox, so for now we'll just exit
			exit(0);
			//$disp="202";
		}

		?>
		<html>
		<head>
			<title>Upload Complete</title>
		</head>
		<body>
		<script type="text/javascript">
			window.parent.frames['frmUpload'].OnUploadCompleted(<?php echo $disp; ?>) ;
		</script>
		</body>
		</html>
		<?php
		
	}
	
	function getDirSize($dir) {
		$dirSize=0;
		if ($dh=@opendir($dir)) {
			while ($file=@readdir($dh)) {
				if (($file!=".")&&($file!="..")) {
					if (is_dir($dir."/".$file)) {
						$tmp_dirSize=$this->getDirSize($dir."/".$file);
						if ($tmp_dirSize!==false) $dirSize+=$tmp_dirSize;
					} else {
						$dirSize+=filesize($dir."/".$file);
					}
				}
			}
			@closedir($dh);
		} else {
			return false;
		}
		
		return $dirSize;
	}
}

?>