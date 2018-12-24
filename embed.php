<?php
error_reporting(0);
include "curl_gd.php";

if($_GET['url'] != ""){
	$gid = $_GET['url'];
	$original_id = my_simple_crypt($gid, 'd');
	$title = fetch_value(file_get_contents_curl('https://drive.google.com/get_video_info?docid='.$original_id), "title=", "&");
	$url = 'https://drive.google.com/file/d/'.$original_id.'/view';
	$linkdown = Drive($url);
	$file = '[{"type": "video/mp4", "label": "HD", "file": "'.$linkdown.'"}]';
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
	<title><?php echo $title?> - Google Drive</title>
</head>
        <style type='text/css'>
            body, html
            {
                margin: 0; padding: 0; height: 100%; overflow: hidden;
            }
        </style>	
<body>
<script type="text/javascript" src="https://content.jwplatform.com/libraries/Xw6BiVxW.js"></script>
<div id="thePlayer"></div>
<script type="text/javascript">
    jwplayer("thePlayer").setup({
      width: "100%",
      position: "absolute",
      top: "0",
      left: "0",
      height: "100vh",
      playlist: [{
	      "sources":<?php echo $file?>
      });
</script>

</body>
</html>
