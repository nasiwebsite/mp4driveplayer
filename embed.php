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
<body>

	<div id="picasa"></div>

	<script src="//ssl.p.jwpcdn.com/player/v/8.4.1/jwplayer.js"></script>
	<script type="text/javascript">
		jwplayer("picasa").setup({
			playlist: [{
				"sources":<?php echo $file?>
			}],
			allowfullscreen: true,
			autostart: false,
		});
	</script>

</body>
</html>
