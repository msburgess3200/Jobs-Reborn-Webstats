<?php
/**********************************************************************************************************
****	Minecraft Jobs Reborn Web Stats
****	Copyright 2020, CunterFuck.com
****	This script was created by
****	SkyWalker, aka SkyWalker3200
****	Open source license. Please help me keep it working.
****	From SkyWalker himself.
**********************************************************************************************************/


// debug work...
// parse_str(implode('&', array_slice($argv, 1)), $_GET);


require("config.php");
$link = mysqli_connect($cfg['database']['hostname'], $cfg['database']['username'], $cfg['database']['password'], $cfg['database']['db']) or die(mysqli_error());

// setup parsing...
if (isset($_GET['job']) && $_GET['job'] == ""){
	echo "Nope.";
	exit;
}elseif (isset($_GET['job']) && $_GET['job'] !== ""){
	$sjob = $_GET['job'];
	$i=0;
	$jobs = array();
	$jobs_list_query = mysqli_query($link, "SELECT * FROM `jobs_jobnames` ORDER BY `id` ASC;");
	while ($jobs_list = mysqli_fetch_array($jobs_list_query, MYSQLI_ASSOC)){
		$jobs[$i] = $jobs_list['name'];
		$i++;
	}
	if (!in_array($_GET['job'],$jobs)){
		echo "No such luck. :(";
		exit;
	}
}
?>
<html>
	<head>
		<title>.: Top Player Jobs : CunterFuck.com :.</title>
	</head>
	<body>
		<table>
			<tr>
				<th align="center">Player Name</th>
				<th align="center">Job Level</th>
			</tr>
			<?php
			$query = mysqli_query($link, "SELECT `jobs_users`.`username`, `jobs_jobs`.`level` FROM `jobs_jobs`, `jobs_users` WHERE `jobs_users`.`id` = `jobs_jobs`.`userid` AND `jobs_jobs`.`job` = '". $sjob ."' ORDER BY `jobs_jobs`.`level` DESC;") or die(mysqli_error());
			while($tab = mysqli_fetch_assoc($query)){
			?>
				<tr>
					<td align="center"><?php echo $tab['username']; ?></td>
					<td align="center"><?php echo $tab['level']; ?></td>
				</tr>
			<?php
			}
			?>
		</table><br /><br /><br /><br />
		<a href="index.php">Go Back</a>
	</body>
</html>