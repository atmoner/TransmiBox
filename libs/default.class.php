<?php


#doc
#	classname:	ClassName
#	scope:		PUBLIC
#
#/doc

class SeedBox
{
	#	internal variables

	#	Constructor
	function __construct ()
	{
		# code...
		
	}
	###
	function bytesToSize($bytes, $precision = 2) {  
		$kilobyte = 1024;
		$megabyte = $kilobyte * 1024;
		$gigabyte = $megabyte * 1024;
		$terabyte = $gigabyte * 1024;
	   
		if (($bytes >= 0) && ($bytes < $kilobyte)) {
		    return $bytes . ' B';
	 
		} elseif (($bytes >= $kilobyte) && ($bytes < $megabyte)) {
		    return round($bytes / $kilobyte, $precision) . ' KB';
	 
		} elseif (($bytes >= $megabyte) && ($bytes < $gigabyte)) {
		    return round($bytes / $megabyte, $precision) . ' MB';
	 
		} elseif (($bytes >= $gigabyte) && ($bytes < $terabyte)) {
		    return round($bytes / $gigabyte, $precision) . ' GB';
	 
		} elseif ($bytes >= $terabyte) {
		    return round($bytes / $terabyte, $precision) . ' TB';
		} else {
		    return $bytes . ' B';
		}
	}
	### 	
	function addTorrent($tid,$hash,$title,$size) {
		global $db,$conf;
		$date = time();
		$query = "INSERT INTO ".$this->prefix_db."torrents (id,tid,info_hash,name,date,size) 
	          VALUES (
			  'NULL',
			  '".$db->escape($tid)."',
			  '".$db->escape($hash)."',
			  '".$db->escape($title)."', 
			  '$date',
			  '".$db->escape($size)."'
			  )";
    		$db->query($query);
    		$db->debug();
    		return $db->insert_id;
 
    		// $paste = $db->get_row("SELECT uniqueid FROM ".$this->prefix_db."torrents WHERE id='$id'");
     		// $this->redirect($conf['baseurl'].'/'.$paste->uniqueid);
	}
}
###

