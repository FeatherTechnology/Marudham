

<?php
include('../../../ajaxconfig.php');

//////////////////////// To get Exchange reference Code once again /////////////////////////
$myStr = "EL";
$codeAvailable = $con->query("SELECT ref_code FROM ct_cr_bel WHERE ref_code != '' UNION SELECT ref_code FROM ct_db_bel WHERE ref_code != '' ORDER BY ref_code DESC LIMIT 1");

if ($codeAvailable->num_rows > 0) {
    $row = $codeAvailable->fetch_assoc();
    $latestRefCode = $row["ref_code"];
    $latestAppNo = ltrim(strstr($latestRefCode, '-'), '-');
    $appno2 = $latestAppNo + 1;
    $ref_code = $myStr . "-" . str_pad($appno2, 6, '0', STR_PAD_LEFT);
} else {
    $initialapp = $myStr . "-100001";
    $ref_code = $initialapp;
}
///////////////////////////////////////////////////////////////////////////////////////////

$ref_code = str_replace(`"`,'',$ref_code);

echo $ref_code;
?>
