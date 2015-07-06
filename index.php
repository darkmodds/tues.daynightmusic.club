<?
$dev = $_SERVER['HTTP_HOST'] == 'localhost';
if ($dev) {
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
}
$path = $dev ? '/tues.daynightmusic.club/' : '/';
$root_path = $_SERVER['DOCUMENT_ROOT'] . $path;
$www_path = 'http://' . $_SERVER['HTTP_HOST'] . $path;
include('data.php');
if (isset($_GET['url'])) {
	$url = explode("/", $_GET['url']);
	foreach ($url as $ukey => $u) {
		if ($u == '') { unset($url[$ukey]); }
	}
	$url = array_values($url);
	if (count($url) == 2 && $url[0] == 'episode') {
		foreach ($episodes as $ep) {
			if ($ep[0] == $url[1]) {
				$episode = $ep;
				$f = $root_path . 'episodes/' . $ep[0] . '.htm';
				if (file_exists($f)) {
					ob_start();
					include($f);
					$episode['text'] = ob_get_contents();
					ob_end_clean();
				}
			}
		}
	}
}
?>
<html>
<head>
<title>Tuesday Night Music Club</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="daily m00ds, most days" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="<?= $www_path; ?>css/reset.css" />
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Serif:400,400italic,700">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?= $www_path; ?>css/tnmc.css" />
</head>
<body>
	
<h1><a href="<?= $www_path; ?>">#TNMC</a></h1>

<section>
<? 

if (isset($episode)) {
	echo '<div class="episode-post">';
	if (file_exists($root_path . 'episodes/images/' . $episode[0] . '.jpg')) {
		echo '<img src="' . $www_path . 'episodes/images/' . $episode[0] . '.jpg" class="cover" />';
	}
	echo '<h2>' . $episode[1] . '<br /><span>' . $episode[2] . '</span></h2>';
	$subs = array();
	if (isset($episode[3])) {
		$subs[] = date("F j, Y", strtotime($episode[3]));
	}
	if (isset($episode[4])) {
		$subs[] = 'Hosted by ' . $episode[4];
	}
	if (count($subs) > 0) {
		echo '<h3>' . implode('<br />', $subs) . '</h3>';
	}
	if (isset($episode['text'])) {
		$text = trim($episode['text']);
		$text = preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $text);
		$text = nl2br($text);
		echo '<p>' . $text . '</p>';
	}
	else {
		echo '<p>No description of this episode has been submitted yet.</p>';
	}
	echo '</div>';
}

else {
	foreach ($episodes as $ep) {
		echo '<div class="episode">';
		echo '<div class="ep-id">' . $ep[0] . '</div>';
		echo '<div class="ep-date">' . (isset($ep[3]) ? date("F j, Y", strtotime($ep[3])) : 'N/A') . '</div>';
		echo '<div class="ep-artist">' . $ep[1] . '</div>';
		echo '<div class="ep-album">' . $ep[2] . '</div>';
		echo '<div class="ep-details">';
		$opts = array();
		$f = $root_path . 'episodes/' . $ep[0] . '.htm';
		if (file_exists($f)) {
			$opts[] = '<a href="' . $www_path . 'episode/' . $ep[0] . '/"><i class="fa fa-file-text-o"></i></a>';
		}
		echo count($opts) > 0 ? implode(" ", $opts) : "&nbsp;";
		echo '</div>';
		echo '</div>' . "\n\n";
	} 
}
?>

</section>

<footer>&copy; 2013-<?= date("Y"); ?></footer>

</body>
</html>