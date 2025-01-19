<?php session_cache_limiter(FALSE);
if (!session_start()) session_start(); ?>
<?php if (isset($_SESSION["userName"])) { ?>

	<?php ob_start();
	include("conn.php");
	?>
	<?php ini_set('max_execution_time', 600); //600 seconds = 10 minutes 

	$startScriptTime = microtime(TRUE);
	$user_id 	= 	$_SESSION['userName'];

	$cat		=	$_REQUEST['cat'];

	$prod_cat	=	urldecode($_REQUEST['prod_cat']);
	$from		=	$_REQUEST['from'];
	$to			=	$_REQUEST['to'];
	$d			=	date_create($from);
	$from		=	$d->format('d-M-Y');
	$dd			=	date_create($to);
	$to			=	$dd->format('d-M-Y');
	//ECHO $unit.$prod_cat;

	if ($cat == 'WALTON EAP LIFT PARTY') {
		$level1 = "HOS ID";
		$level2 = "HOS Name";
		$level3 = "Logst ID";
		$level4 = "Logst Name";
		$level5 = "SR1 ID";
		$level6 = "SR1 Name";
		$level7 = "SR2 ID";
		$level8 = "SR2 Name";
	} else if ($cat == 'CORPORATE WITP' || $cat == 'WALTON SOFTWARE (WDSS)' || $cat == 'EXPORT CUSTOMER WITP') {
		$level1 = "TEAM LEADER ID";
		$level2 = "TEAM LEADER NAME";
		$level3 = "KAM ID";
		$level4 = "KAM Name";
		$level5 = "Coordinator ID";
		$level6 = "Coordinator Name";
		$level7 = "Deputy Coordinator ID";
		$level8 = "Deputy Coordinator Name";
	} else {
		$level1 = "DSM ID";
		$level2 = "DSM Name";
		$level3 = "TSM ID";
		$level4 = "TSM Name";
		$level5 = "SR1 ID";
		$level6 = "SR1 Name";
		$level7 = "SR2 ID";
		$level8 = "SR2 Name";
	}


	?>
