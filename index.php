<?php
/**********************************************************************************************************
****	Minecraft Jobs Reborn Web Stats
****	Copyright 2020, CunterFuck.com
****	This script was created by
****	SkyWalker, aka SkyWalker3200
****	You are not allowed to modify, download, or redistrute this script without WRITTEN CONSENT
****	From SkyWalker himself.
**********************************************************************************************************/


// debug work...
// parse_str(implode('&', array_slice($argv, 1)), $_GET);


require("config.php");
$link = mysqli_connect($cfg['database']['hostname'], $cfg['database']['username'], $cfg['database']['password'], $cfg['database']['db']) or die(mysqli_error());
$q = mysqli_query($link, "SELECT `name` FROM `jobs_jobnames`;");
?>
<html>
	<head>
		<title>.: Top Player Jobs : CunterFuck.com :.</title>
	</head>
	<body><center>
		<?php
			while($a = mysqli_fetch_array($q)){ ?>
				<a href="job.php?job=<?php echo $a['name']; ?>"><?php echo $a['name']; ?></a>
		<?php
			}
		?>
		</center>
	</body>
</html>