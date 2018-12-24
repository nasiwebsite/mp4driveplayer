<?php
error_reporting(0);
include "curl_gd.php";

if($_GET['url'] != ""){
	$gid = $_GET['url'];
	$original_id = my_simple_crypt($gid, 'd');
	$title = fetch_value(file_get_contents_curl('https://drive.google.com/get_video_info?docid='.$original_id), "title=", "&");
	$url = 'https://drive.google.com/file/d/'.$original_id.'/view';
	$img = gdImg($gdurl);
	$linkdown = Drive($url);
	$file = '[{"type": "video/mp4", "image": "'.$img.'", "label": "HD", "file": "'.$linkdown.'"}]';
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
	<title><?php echo $title?> - Google Drive</title>
<script src="https://content.jwplatform.com/libraries/DbXZPMBQ.js"></script>
</head>
	<style type='text/css'>
            #myElement{
		    position: absolute;
		    top: 0;
		    right: 0;
		    bottom: 0;
		    left: 0;
		    width: 100%;
		    height: 100%;
		    margin: auto;
		    background: transparent;
		}
	</style>
<body>

	<div id="myElement"></div>
	<script type="text/javascript">
		jwplayer("myElement").setup({
			playlist: [{
				"image":"<?php echo $image?>",
				"sources":<?php echo $file?>
			}],
			allowfullscreen: true,
			autostart: false,	
			height: '100vh',
			aspectratio: '16:9',
		});
	</script>

</body>
</html>
