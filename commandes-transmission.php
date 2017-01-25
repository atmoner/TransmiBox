<?php

require_once( dirname( __FILE__ ) . '/libs/TransmissionRPC.class.php' );

$test_torrent = "http://www.slackware.com/torrents/slackware64-13.1-install-dvd.torrent";

$rpc = new TransmissionRPC();
$rpc->sstats( );

//$rpc->debug = true; 

if (isset($_GET['add']))
{
	try
	{ 

	  $result = $rpc->add( $test_torrent, '/tmp' );
	  $id = $result->arguments->torrent_added->id;
	  print "ADD TORRENT TEST... [{$result->result}] (id=$id)\n";
	  sleep( 2 );
 
	  $rpc->stop( $id );
 

	} catch (Exception $e) {
	  die('[ERROR] ' . $e->getMessage() . PHP_EOL);
	} 
}

if (isset($_GET['start']))
{

	$id = intval($_GET['start']);
 
	try
	{  
	  $result = $rpc->start( $id );
	  echo $result->result;
	  
	} catch (Exception $e) {
	  die('[ERROR] ' . $e->getMessage() . PHP_EOL);
	} 
}

if (isset($_GET['stop']))
{

	$id = intval($_GET['stop']);
 
	try
	{  
	  $result = $rpc->stop( $id );
	  print "STOP TORRENT TEST... [{$result->result}]\n";
	  
	} catch (Exception $e) {
	  die('[ERROR] ' . $e->getMessage() . PHP_EOL);
	} 
}

if (isset($_GET['verify']))
{

	$id = intval($_GET['verify']);
 
	try
	{  
	  $result = $rpc->verify( $id );
      echo "VERIFY TORRENT TEST... [{$result->result}]\n";
 
	} catch (Exception $e) {
	  die('[ERROR] ' . $e->getMessage() . PHP_EOL);
	} 
}

if (isset($_GET['get']))
{

	$id = intval($_GET['get']);
 
	try
	{  
 
	  $rpc->return_as_array = true;
	  $result = $rpc->get( );
 var_dump($result);
	  echo "GET TORRENT INFO AS ARRAY TEST... [{$result['result']}]\n";
	  $rpc->return_as_array = false;
	  
	} catch (Exception $e) {
	  die('[ERROR] ' . $e->getMessage() . PHP_EOL);
	} 
}
if (isset($_GET['stat']))
{
 
	try
	{  
 
	  $rpc->return_as_array = true;
	  $result = $rpc->sstats();
 var_dump($result);
	  echo "GET TORRENT INFO AS ARRAY TEST... [{$result['result']}]\n";
	  $rpc->return_as_array = false;
	  
	} catch (Exception $e) {
	  die('[ERROR] ' . $e->getMessage() . PHP_EOL);
	} 
}
