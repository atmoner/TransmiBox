<?php
 
/* AJAX check  */
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

		require '/var/www/libs/TransmissionRPC.class.php';
		$rpc    = new TransmissionRPC();

	function bytes($bytes, $force_unit = NULL, $format = NULL, $si = TRUE)
	{
		global $smarty;
		// Format string
		$format = ($format === NULL) ? '%01.2f %s' : (string) $format;

		// IEC prefixes (binary)
		if ($si == FALSE OR strpos($force_unit, 'i') !== FALSE)
		{
		    $units = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB');
		    $mod   = 1024;
		}
		// SI prefixes (decimal)
		else
		{
		    $units = array('B', 'kB', 'MB', 'GB', 'TB', 'PB');
		    $mod   = 1000;
		}

		// Determine unit to use
		if (($power = array_search((string) $force_unit, $units)) === FALSE)
		{
		    $power = ($bytes > 0) ? floor(log($bytes, $mod)) : 0;
		}
		$arrayStats = array(sprintf($format, $bytes / pow($mod, $power), ''),$units[$power]);
		return $arrayStats;
	}



	if (isset($_GET['downloadSpeed'])) {
		$result = $rpc->sstats();
		$arr = bytes($result->arguments->downloadSpeed);
		echo '<div class="huge" id="dlspeed">' . $arr[0] . '</div><div>' . $arr[1] .'/s</div>';
	}
	if (isset($_GET['uploadSpeed'])) {
		$result = $rpc->sstats();
		$arr = bytes($result->arguments->uploadSpeed);
		echo '<div class="huge" id="upspeed">' . $arr[0] . '</div><div>' . $arr[1] .'/s</div>';
	}
	if (isset($_GET['activeTorrentCount'])) {
		$result = $rpc->sstats();
		if (!$result->arguments->activeTorrentCount)
		echo '<div class="huge" id="activeTorrentCount">0</div><div> Torrent Actif</div>';		
		else
		echo '<div class="huge" id="activeTorrentCount">' . $result->arguments->activeTorrentCount . '</div><div> Torrent(s) Actif(s)</div>';
	}	
}


