<?php
	error_reporting(0);
	include "curl_gd.php";
	$base_url = 'http://blodunet149.000webhostapp.com';
	$server = 'drive.google.com';

	$url = isset($_GET['url']) ? htmlspecialchars($_GET['url']) : null;
	if(empty($url)) {
	  $url = '';
	}

	if($url) {
	  preg_match('@^(?:http.?://)?([^/]+)@i', $url, $matches);
	  $host = $matches[1];
	  if($host != $server) {
	    echo 'Please input a valid google drive url.';
	    exit;
	  }
		$results = file_get_contents($base_url.'/json.php?url='.$url);
		$results = json_decode($results, true);
		if($results['file']==1){
	     '<center>Sorry, the owner hasn\'t given you permission to download this file.</center>';
			exit;
	  }elseif($results['file']==2) {
			echo '<center>Error 404. We\'re sorry. You can\'t access this item because it is in violation of our Terms of Service.</center>';
			exit;
	  }
	}
 header("Location: ".$results['file']);
die();
?>