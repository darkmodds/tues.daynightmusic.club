<?
include('data.php');
?>
<html>
<head>
<title>Tuesday Night Music Club</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="daily m00ds, most days" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="css/reset.css" />
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Serif:400,400italic,700">
<link rel="stylesheet" href="css/tnmc.css" />
</head>
<body>
	
<h1>#TNMC</h1>

<section>
<? 
foreach ($episodes as $ep) {
	echo '<div class="episode">';
	echo '<div class="ep-id">' . $ep[0] . '</div>';
	echo '<div class="ep-artist">' . $ep[1] . '</div>';
	echo '<div class="ep-album">' . $ep[2] . '</div>';
	echo '</div>' . "\n\n";
} 
?>

</section>

<footer>&copy; 2013-<?= date("Y"); ?></footer>

</body>
</html>