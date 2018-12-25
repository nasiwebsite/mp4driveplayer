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
            body, #myElement{
		    position: absolute;
		    top: 0;
		    right: 0;
		    bottom: 0;
		    left: 0;
		    margin: auto;
		    background: transparent;
		}
	</style>
<body>

	<div id="myElement"></div>

	<script src="https://cdn.staticaly.com/gh/nasiwebsite/mp4driveplayer/5e4f0cb1/JW7.12.13.js"></script>
	<script type="text/javascript">
		jwplayer("myElement").setup({
			playlist: [{
				"mute": false,
				"sources":<?php echo $file?>
			}],
			allowfullscreen: true,
			autostart: false,	
			width: '100%',
			aspectratio: '16:9',
		});
	</script>

</body>
</html>
