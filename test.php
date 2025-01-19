<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>EAP Party Info</title>
		<link rel="icon" href="image/icon.png" type="image" />
		<link href="style.css" rel="stylesheet" type="text/css" />
	</head>

	<body class="bodyback">
		<div class="main">
			<div class="header">
				<div class="ebs"></div>
			</div>



			<script type="text/javascript" src="ibox.js"></script>
			<div class="slice"></div>
			<div style="font-weight:bold;margin-top:00px; text-align:center;">

				<?php echo $cat; ?><br>EAP Party Info
			</div>

			<div class="slice"></div>
			<div style="font-weight:bold;margin-top:0px; text-align:center;"></div>
			<link href="datatable/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
			<link href="datatable/fixedHeader.dataTables.min.css" rel="stylesheet" type="text/css" />
			<script type="text/javascript" src="datatable/jquery-1.11.3.min.js"></script>
			<script type="text/javascript" src="datatable/jquery.dataTables.min.js"></script>
			<script type="text/javascript" src="datatable/jquery.dataTables.min.js"></script>
			<script type="text/javascript" src="datatable/dataTables.fixedHeader.min.js"></script>

			<script type="text/javascript" charset="utf-8">
				// UK Date Sorting 
				/*			jQuery.fn.dataTableExt.oSort['uk_date-asc'] = function (a, b) {
								var ukDatea = $(a).text().split('/');
								var ukDateb = $(b).text().split('/');

								var x = (ukDatea[2] + ukDatea[1] + ukDatea[0]) * 1;
								var y = (ukDateb[2] + ukDateb[1] + ukDateb[0]) * 1;

								return ((x < y) ? -1 : ((x > y) ? 1 : 0));
							};

							jQuery.fn.dataTableExt.oSort['uk_date-desc'] = function (a, b) {
								var ukDatea = $(a).text().split('/');
								var ukDateb = $(b).text().split('/');

								var x = (ukDatea[2] + ukDatea[1] + ukDatea[0]) * 1;
								var y = (ukDateb[2] + ukDateb[1] + ukDateb[0]) * 1;

								return ((x < y) ? 1 : ((x > y) ? -1 : 0));
							} */

				jQuery.fn.dataTableExt.oSort['uk_date-asc'] = function(a, b) {
					a = parseInt($(a).text());
					b = parseInt($(b).text());
					return ((a < b) ? -1 : ((a > b) ? 1 : 0));
				};

				jQuery.fn.dataTableExt.oSort['uk_date-desc'] = function(a, b) {
					a = parseInt($(a).text());
					b = parseInt($(b).text());
					return ((a < b) ? 1 : ((a > b) ? -1 : 0));
				};

				$(document).ready(function() {
					$('#example').dataTable({
						"bJQueryUI": true,
						"sPaginationType": "full_numbers",
						"aLengthMenu": [
							[-1, 100, 500, 1000, 5000],
							["All", 100, 500, 1000, 5000]
						],
						"aoColumnDefs": [{
							"aTargets": ["uk-date-column", "num-column"],
							"sType": "uk_date"
						}],
						fixedHeader: true,
						"fnDrawCallback": function() {


						}
					});
				});
			</script>

			<div id="demo">
				<table style=" font-size:11px;" cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="1250">
					<thead>
						<tr>
							<th scope="col" style='font-weight:bold' align='center'>SL</th>

							<th scope="col" style='font-weight:bold'>Party No</th>
							<th scope="col" style='font-weight:bold'>Party Name</th>
							<th scope="col" style='font-weight:bold'>Address</th>

							<th scope="col" style='font-weight:bold'><?php echo $level3 ?></th>
							<th scope="col" style='font-weight:bold'><?php echo $level4 ?></th>
							<th scope="col" style='font-weight:bold'><?php echo $level1 ?> </th>
							<th scope="col" style='font-weight:bold'><?php echo $level2 ?></th>
							<?php if ($cat == 'CORPORATE WITP' || $cat == 'WALTON SOFTWARE (WDSS)') { ?>
								<th scope="col" style='font-weight:bold'>Is Incentive</th>
								<th scope="col" style='font-weight:bold'>Is Doc Up to date</th>
								<th scope="col" style='font-weight:bold'>Rating Certificate</th>
							<?php } ?>
							<th scope="col" style='font-weight:bold'><?php echo $level7 ?></th>
							<th scope="col" style='font-weight:bold'><?php echo $level8 ?></th>
							<th scope="col" style='font-weight:bold'><?php echo $level5 ?></th>
							<th scope="col" style='font-weight:bold'><?php echo $level6 ?></th>

							<th scope="col" style='font-weight:bold'>Zone</th>
							<th scope="col" style='font-weight:bold'>Area</th>
							<th scope="col" style='font-weight:bold'>Group</th>
							<th scope="col" style='font-weight:bold'>Email</th>
							<th scope="col" style='font-weight:bold'>Status</th>

							<th scope="col" style='font-weight:bold'>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr class="gradeU" style="border:1px solid #d3d3d3;">
							<?php
							$sl = 1;

							$sql = "
  SELECT  DISTINCT CUS.PARTY_ID,     P.PARTY_NUMBER P_NUMBER,  INF.PARTY_NUMBER, CUS.SALES_CHANNEL_CODE CUS_CATEGORY ,   INF.PROD_GROUP, 
  INF.AREA_NAME,  INF.AREA2,  DECODE(INF.AREA_NAME,'EAP-02','34242','EAP-01','34083' ,'EAP-03','41581' ,'EAP-04','41531') HID,  INF.HOA_ID,    INF.ZONE,  INF.PARTY_STATUS,
INF.DSM_ID,   INF.LATITUDE , INF.LONGITUDE , INF.EMAIL,INF.IS_INCENTIVE,INF.RATING_CERTIFICATE,INF.IS_ALL_DOC_UP,
 ( SELECT EMP_NAME  FROM  APPS.XX_HRMS_MASTER_DATA
WHERE  INF.DSM_ID=EMP_CODE )  DSM_NAME ,
 INF.TSO_NAME TSO_ID,   
 ( SELECT EMP_NAME  FROM  APPS.XX_HRMS_MASTER_DATA
WHERE  TSO_NAME=EMP_CODE )  TSO_NAME ,
 P.PARTY_NAME CUSTOMER_NAME, (P.ADDRESS1||','||P.ADDRESS2||','||P.ADDRESS3) ADDRESS ,  INF.SR_NAME SR_ID,    INF.SR_NAME2 SR_ID2,
    ( SELECT EMP_NAME  FROM  APPS.XX_HRMS_MASTER_DATA
WHERE  SR_NAME=EMP_CODE )  SR_NAME ,
 ( SELECT EMP_NAME  FROM  APPS.XX_HRMS_MASTER_DATA
WHERE  SR_NAME2=EMP_CODE )  SR_NAME2

          FROM    APPS.HZ_PARTIES P,    APPS.HZ_CUST_ACCOUNTS CUS , APPS.XX_CUSTOMER_INFO INF
          WHERE  P.PARTY_NUMBER=INF.PARTY_NUMBER(+) 
           AND CUS.PARTY_ID=P.PARTY_ID -- AND NVL(P.VALIDATED_FLAG,'Y')<>'N'
 AND CUS.SALES_CHANNEL_CODE='$cat'
 ORDER BY CUS.PARTY_ID
";
							//echo $sql;
							$stid = oci_parse($conn, $sql);
							oci_execute($stid);
							while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {



							?>
								<td align="center" style='border:1px solid #d3d3d3;'><?php echo $sl; ?></td>

								<td align="center" style='border:1px solid #d3d3d3;'><?php echo $row["P_NUMBER"]; ?></td>
								<td align="center" style='border:1px solid #d3d3d3;'><?php echo $row["CUSTOMER_NAME"]; ?></td>
								<td align="center" style='border:1px solid #d3d3d3;'><?php echo $row["ADDRESS"]; ?></td>
								<form name="d" method="post" action="wmt_ea_party_info_action.php">
									<input type="hidden" name="cat" value="<?php echo $row["CUS_CATEGORY"]; ?>" />
									<input type="hidden" name="party_id" value="<?php echo $row["PARTY_ID"]; ?>" />
									<input type="hidden" name="party" value="<?php echo $row["P_NUMBER"]; ?>" />
									<input type="hidden" name="hid" value="<?php echo $row["HID"]; ?>" />
									<input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />






									<td align="center" style='border:1px solid #d3d3d3;' align="center" width="5">
										<input type="text" size="6" align="center" name="tsm" style="font:Arial Narrow; font-size:11px;" value='<?php echo $row["TSO_ID"]; ?>' />
									</td>

									<td align="center" style='border:1px solid #d3d3d3;'><?php echo $row["TSO_NAME"]; ?></td>
									<td align="center" style='border:1px solid #d3d3d3;' align="center" width="3">
										<input type="text" size="6" name="dsm" style="font:Arial Narrow; font-size:11px;" value='<?php echo $row["DSM_ID"]; ?>' />
									</td>

									<td style='border:1px solid #d3d3d3;'><?php echo $row["DSM_NAME"]; ?></td>
									<?php if ($cat == 'CORPORATE WITP' || $cat == 'WALTON SOFTWARE (WDSS)') { ?>
										<td align="center" style='border:1px solid #d3d3d3;' align="center" width="14">
											<select name="is_incentive">
												<option value="<?php if (isset($row["IS_INCENTIVE"])) echo $row["IS_INCENTIVE"]; ?>"><?php if (isset($row["IS_INCENTIVE"])) echo $row["IS_INCENTIVE"]; ?></option>
												<option value="YES">YES</option>
												<option value="NO">NO</option>
											</select>
										</td>
										<td align="center" style='border:1px solid #d3d3d3;' align="center" width="14">
											<select name="is_all_doc_up">
												<option value="<?php if (isset($row["IS_ALL_DOC_UP"])) echo $row["IS_ALL_DOC_UP"]; ?>"><?php if (isset($row["IS_ALL_DOC_UP"])) echo $row["IS_ALL_DOC_UP"]; ?></option>
												<option value="YES">YES</option>
												<option value="NO">NO</option>
												<option value="OTHERS">Others</option>
											</select>
										</td>
										<td align="center" style='border:1px solid #d3d3d3;' align="center" width="14">
											<select name="rating_certificate">
												<option value="">Select</option>
												<option value="AAA" <?php if ($row["RATING_CERTIFICATE"] == 'AAA') echo "selected"; ?>>AAA Rating</option>
												<option value="AA" <?php if ($row["RATING_CERTIFICATE"] == 'AA') echo "selected"; ?>>AA+ / AA / AA- Rating</option>
												<option value="A" <?php if ($row["RATING_CERTIFICATE"] == 'A') echo "selected"; ?>>A+ / A / A- Rating</option>
												<option value="BBB" <?php if ($row["RATING_CERTIFICATE"] == 'BBB') echo "selected"; ?>>BBB+ / BBB / BBB- Rating</option>
												<option value="BB" <?php if ($row["RATING_CERTIFICATE"] == 'BB') echo "selected"; ?>>BB+ / BB / BB- Rating</option>
												<option value="O" <?php if ($row["RATING_CERTIFICATE"] == 'O') echo "selected"; ?>>Any Rating</option>
											</select>
										</td>
									<?php } ?>
									<td align="center" style='border:1px solid #d3d3d3;' align="center" width="5">
										<input type="text" size="6" name="sr2" style="font:Arial Narrow; font-size:11px;" value='<?php echo $row["SR_ID2"]; ?>' />
									</td>

									<td align="center" style='border:1px solid #d3d3d3;'><?php echo $row["SR_NAME2"]; ?></td>
									<td align="center" style='border:1px solid #d3d3d3;' align="center" width="5">
										<input type="text" size="6" name="sr" style="font:Arial Narrow; font-size:11px;" value='<?php echo $row["SR_ID"]; ?>' />
									</td>

									<td align="center" style='border:1px solid #d3d3d3;'><?php echo $row["SR_NAME"]; ?></td>



									<td align="center" style='border:1px solid #d3d3d3;' align="center" width="10">
										<input type="text" size="6" name="area" style="font:Arial Narrow; font-size:11px;" value='<?php echo $row["AREA_NAME"]; ?>' />
									</td>

									<td align="center" style='border:1px solid #d3d3d3;' align="center" width="10">
										<input type="text" size="6" name="area2" style="font:Arial Narrow; font-size:11px;" value='<?php echo $row["AREA2"]; ?>' />
									</td>

									<td align="center" style='border:1px solid #d3d3d3;' align="center" width="14">
										<select name="grp">
											<option value="<?php if (isset($row["PROD_GROUP"])) echo $row["PROD_GROUP"]; ?>"><?php if (isset($row["PROD_GROUP"])) echo $row["PROD_GROUP"]; ?></option>
											<option value="Accessories">Accessories</option>
											<option value="Lighting">Lighting</option>
											<option value="Common">Common</option>
										</select>
									</td>

									<td align="center" style='border:1px solid #d3d3d3;' align="center" width="5">
										<input type="text" size="6" name="mail" style="font:Arial Narrow; font-size:11px;" value='<?php echo $row["EMAIL"]; ?>' />
									</td>

									<td align="center" style='border:1px solid #d3d3d3;' align="center" width="14">
										<select name="st">
											<option value="<?php if (isset($row["PARTY_STATUS"])) echo $row["PARTY_STATUS"]; ?>"><?php if (isset($row["PARTY_STATUS"])) echo $row["PARTY_STATUS"]; ?></option>
											<option value="Active">Active</option>
											<option value="Inactive">Inactive</option>
										</select>
									</td>


									<td align="center" style='border:1px solid #d3d3d3;' align="right" width="20">
										<?php if (
											$user_id == '12977' || $user_id == '14155' || $user_id == '18625' || $user_id == '6309' || $user_id == '35557' || $user_id == '4717' || $user_id == '34083' || $user_id == '10267'
											|| $user_id == '5150' || $user_id == '4093' || $user_id == '36899' || $user_id == '34242' || $user_id == '37589'	|| $user_id == '36625'	|| $user_id == '37440'	|| $user_id == '37437'
											|| $user_id == '37562'	|| $user_id == '36655'	|| $user_id == '37696'	|| $user_id == 'C-945'	|| $user_id == '37561'	|| $user_id == '37974' || $user_id == '36780' || $user_id == '33156'  || $user_id == '37993'
											|| $user_id == '41727' || $user_id == '43449' || $user_id == '40065' || $user_id == '43781' || $user_id == '42137' || $user_id == '38161' || $user_id == '43376' || $user_id == '43398' || $user_id == '43898' || $user_id == '43903' || $user_id == '44371' || $user_id == '19759' || $user_id == '52489'
										) {
											if (isset($row["PARTY_NUMBER"])) { ?>

												<input style='font-weight:bold; color:blue' ; type="submit" target="_blank" name="btn" value="Update" />
											<?php } else { ?>

												<input style='font-weight:bold; color:blue; background:yellow' type="submit" name="btn" value="Add" />

										<?php }
										} ?>
									</td>
								</form>

						</tr>
					<?php
								$sl++;
							}

					?>

					<tfoot>


						</tbody>
					</tfoot>
					</tfoot>
				</table>


				<div class="slice"></div>

				<div class="fotter">
					<div align="center">
						<div style="font-size:12px; align=" center">Copyrights &copy; Reserved by IT Dept. Walton Group </div>
						<?php $endScriptTime = microtime(TRUE);
						$totalScriptTime = $endScriptTime - $startScriptTime;
						echo "\n\r" . ' Load time: ' . number_format($totalScriptTime, 2) . ' seconds '; ?>
					</div>
				</div>
			</div>
	</body>

	</html>
    
    <?php include('conn_close.php'); ?>

<?php
} else {
	header("Location:index.php");
}
?>

<!-- query builder -->
 <?php
    use Illuminate\Support\Facades\DB;

    $query = DB::table('HZ_PARTIES as P')
        ->distinct()
        ->select([
            'CUS.PARTY_ID',
            'P.PARTY_NUMBER as P_NUMBER',
            'INF.PARTY_NUMBER',
            'CUS.SALES_CHANNEL_CODE as CUS_CATEGORY',
            'INF.PROD_GROUP',
            'INF.AREA_NAME',
            'INF.AREA2',
            DB::raw("
                DECODE(
                    INF.AREA_NAME,
                    'EAP-02', '34242',
                    'EAP-01', '34083',
                    'EAP-03', '41581',
                    'EAP-04', '41531'
                ) as HID
            "),
            'INF.HOA_ID',
            'INF.ZONE',
            'INF.PARTY_STATUS',
            'INF.DSM_ID',
            'INF.LATITUDE',
            'INF.LONGITUDE',
            'INF.EMAIL',
            'INF.IS_INCENTIVE',
            'INF.RATING_CERTIFICATE',
            'INF.IS_ALL_DOC_UP',
            DB::raw("(SELECT EMP_NAME FROM APPS.XX_HRMS_MASTER_DATA WHERE INF.DSM_ID = EMP_CODE) as DSM_NAME"),
            'INF.TSO_NAME as TSO_ID',
            DB::raw("(SELECT EMP_NAME FROM APPS.XX_HRMS_MASTER_DATA WHERE TSO_NAME = EMP_CODE) as TSO_NAME"),
            'P.PARTY_NAME as CUSTOMER_NAME',
            DB::raw("CONCAT(P.ADDRESS1, ',', P.ADDRESS2, ',', P.ADDRESS3) as ADDRESS"),
            'INF.SR_NAME as SR_ID',
            'INF.SR_NAME2 as SR_ID2',
            DB::raw("(SELECT EMP_NAME FROM APPS.XX_HRMS_MASTER_DATA WHERE SR_NAME = EMP_CODE) as SR_NAME"),
            DB::raw("(SELECT EMP_NAME FROM APPS.XX_HRMS_MASTER_DATA WHERE SR_NAME2 = EMP_CODE) as SR_NAME2"),
        ])
        ->join('HZ_CUST_ACCOUNTS as CUS', 'CUS.PARTY_ID', '=', 'P.PARTY_ID')
        ->leftJoin('XX_CUSTOMER_INFO as INF', 'P.PARTY_NUMBER', '=', 'INF.PARTY_NUMBER')
        ->where('CUS.SALES_CHANNEL_CODE', '=', $cat)
        ->orderBy('CUS.PARTY_ID')
        ->get();
    
?>

<!-- query builder end -->