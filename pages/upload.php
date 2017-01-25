<?php

require_once $path.'/libs/class.bdecode.php';
require_once $path.'/libs/class.bencode.php'; // To create info hash of torrent

$data = array();

   if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size = $_FILES['image']['size'];
      $file_tmp = $_FILES['image']['tmp_name'];
      $file_type = $_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("torrent");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please upload Torrent file.";
      }
      
      if($file_size > 2097152) {
         $errors[]='File size must be excately 2 MB';
      }
     
      if(empty($errors)==true) {
      
	 	 $torrent = new BDECODE($file_tmp);
		 $resultTorrent = $torrent->result;
		 $hash = sha1(BEncode($resultTorrent['info']));       	
         move_uploaded_file($file_tmp,"upload/".$hash.".torrent");



	// Calcul the total size of content torrent
	if (isset($resultTorrent["info"]) && $resultTorrent["info"]) $upfile=$resultTorrent["info"];
		else $upfile = 0;

	if (isset($upfile["length"]))
	{
	  $size = (float)($upfile["length"]);
	}
	else if (isset($upfile["files"]))
		 {
	// multifiles torrent
		     $size=0;
		     foreach ($upfile["files"] as $file)
		             {
		             $size+=(float)($file["length"]);
		             }
		 }
	else
		$size = "0";


         
             
         // echo "Success";
		  $resultrpc = $rpc->add( "http://localhost/upload/".$hash.".torrent", '/tmp' );
		  $id = $resultrpc->arguments->torrent_added->id;
		  //print "ADD TORRENT TEST... [{$result->result}] (id=$id)\n";
		  sleep( 2 );
	  	  $rpc->stop( $id );
	  	  // $startUp->addTorrent($id,$hash,$resultTorrent['info']['name'],$size);
	  	  // header('Location: ?page=upload&h='.$hash);  
      }else{
         print_r($errors);
      }
   }
if (isset($_GET['h'])) {

$torrent = new BDECODE($path.'/upload/'.$_GET['h'].'.torrent');
$resultTorrent = $torrent->result;
$hash = sha1(BEncode($resultTorrent['info']));

	// Calcul the total size of content torrent
	if (isset($resultTorrent["info"]) && $resultTorrent["info"]) $upfile=$resultTorrent["info"];
		else $upfile = 0;

	if (isset($upfile["length"]))
	{
	  $size = (float)($upfile["length"]);
	}
	else if (isset($upfile["files"]))
		 {
	// multifiles torrent
		     $size=0;
		     foreach ($upfile["files"] as $file)
		             {
		             $size+=(float)($file["length"]);
		             }
		 }
	else
		$size = "0";

$smarty->assign('torrentHash',$hash);
$smarty->assign('torrentBytestoSize',$startUp->bytesToSize($size));
$smarty->assign('torrentSize',$size);
$smarty->assign('torrentUrlname',preg_replace("/[^a-zA-Z0-9]+/", "-", strtolower($resultTorrent['info']['name'])));          
$smarty->assign('resultTorrent',$resultTorrent); 

}  

