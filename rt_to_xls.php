<?php

    ini_set('max_execution_time', 700);

    $DBHost = "localhost"; 
    $DBLogin = "XXX"; 
    $DBPassword = "XXX"; 
 
    mysql_connect("$DBHost", "$DBLogin", "$DBPassword") or die('error while connecting'); 
    @mysql_select_db("rt3"); 
       
    $start = $_GET['period_start']. " 00:00:00"; 
    $start_clean = mysql_real_escape_string($start);
    $end = $_GET['period_end']. " 23:59:59"; 
    $end_clean = mysql_real_escape_string($end);
	
	
	
$sql = "
SELECT 
DATE_ADD(`Tickets`.`Created`, INTERVAL 10800 SECOND ) as sukurimo_data,
DATE_ADD(`Tickets`.`Resolved`, INTERVAL 10800 SECOND ) as uzdarymo_data, 
`Tickets`.`EffectiveId` as tiketo_numeris, 
U.`Country` as salis,
`Queues`.`Name` as queue, 
`Users`.`Name` as owneris,
`Transactions`.`Type` as transakcijos_tipas, 
`Transactions`.`Field` as kas_nutiko, 
`Transactions`.`OldValue` as sena_reiksme,
`Transactions`.`NewValue` as nauja_reiksme, 
DATE_ADD(`Transactions`.`Created`, INTERVAL 10800 SECOND ) as statuso_pakeitimas
FROM `Tickets`
INNER JOIN  `Transactions` ON `Tickets`.`EffectiveId`  = `Transactions`.`ObjectId`
INNER JOIN `Queues` on `Tickets`.`Queue`=Queues.Id
INNER JOIN  `Users` on `Tickets`.`Owner`=Users.ID
INNER JOIN  `Users` U on Tickets.Creator=U.ID 
WHERE `Tickets`.`Created` >= '$start_clean' AND `Tickets`.`Created`<= '$end_clean'
AND `Transactions`.`ObjectType`='RT::Ticket'
ORDER BY tiketo_numeris
";
	

$csv_output="";    
    
$result = mysql_query($sql) or die(mysql_error());
$i = 0;

if (mysql_num_rows($result) > 0) {
    for ($i=0; $i < mysql_num_fields($result); $i++) {
    $csv_output .= mysql_field_name($result, $i) . "\t";
    }
}

$csv_output .= "\n";

$values = mysql_query($sql);
while ($rowr = mysql_fetch_row($values)) {

for ($j=0;$j<$i;$j++) {

    if(!isset($rowr[$j]) || $rowr[$j] == "" || $rowr[$j] == null){
      $csv_output .= "\t";
    } else { 
	$line = $rowr[$j];
	$line = str_replace("\r", " ", $line);
	$line = str_replace("\n", "", $line);
	$csv_output .= $line . "\t";}

	}
$csv_output = trim($csv_output)."\n";
}

$filename = "rt_source_".date("Y-m-d_H-i",time());
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=$filename.xls");
header("Pragma: no-cache");

echo $csv_output;
    
mysql_close();
?>
