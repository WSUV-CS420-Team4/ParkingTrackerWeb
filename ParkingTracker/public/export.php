<?php

require 'assets/php/PHPExcel.php';

//http://php.net/manual/en/function.checkdate.php#113205
function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

if (isset($_GET['date']) && validateDate($_GET['date'])) {
  $date = $_GET['date'];
} else {
  $date = date('Y-m-d');
}

$times = array(8,9,10,11,12,13,14,15,16,17);

$db_host = "bend.encs.vancouver.wsu.edu";
$db_user = "CS420G4";
$db_pass = "f9AXr5NsYYqwJ2cT";
$db_name = "CS420G4";

$db = new PDO("mysql:dbname={$db_name};host={$db_host}", $db_user, $db_pass);

$query = $db->prepare("SELECT Plate, Block, Face, Stall, CONCAT_WS(':', Block, Face, Stall) AS StallStr, GROUP_CONCAT(a.Abbreviation SEPARATOR ',') AS Attr, HOUR(Time) AS Hour
                          FROM Parking AS p
                          LEFT JOIN ParkingAttributes AS pa ON p.ParkingId=pa.ParkingId
                          LEFT JOIN Attribute AS a ON pa.AttributeId=a.AttributeId
                          WHERE DATE(Time) = :date
                          GROUP BY Block, Face, Stall, Hour
                          ORDER BY Block, Face, Stall");
$query->execute(array(':date' => $date));
$results = $query->fetchAll(PDO::FETCH_OBJ);
/*
$data = array();

foreach ($results as $stall) {
  if (!array_key_exists($stall->StallStr, $data)) {
    $data[$stall->StallStr] = array();
    $data[$stall->StallStr]['StallStr'] = $stall->StallStr;
  }

  $data[$stall->StallStr][$stall->Hour] = $stall;
}
*/
$query = $db->prepare("SELECT Block, Face, numStalls FROM Block ORDER BY Block, Face");
$query->execute();

$blocks = $query->fetchAll(PDO::FETCH_OBJ);

$wb = new PHPExcel();
//$wb->getProperties->setCreator("Parking Tracker");
//$wb->getProperties->setTitle("Parking Usage");
//$wb->getProperties->setSubject("Southwest Waterfront Community");
//$wb->getProperties->setDescription("Parking usage data exported from Parking Tracker");

$wb->setActiveSheetIndex(0);
$wb->getActiveSheet()->setTitle('Usage');


$wb->getActiveSheet()->setCellValueByColumnAndRow(0,1,'Block #');
$wb->getActiveSheet()->setCellValueByColumnAndRow(1,1,'Space #');
for ($i = 0; $i < count($times); $i++) {
	$wb->getActiveSheet()->setCellValueByColumnAndRow($i+2,1, date("g:i a", strtotime($times[$i].":00")));
}

$i = 2;
$layout = array();

foreach ($blocks as $block) {
  $layout[$block->Block.$block->Face] = $i;
  for ($j = 0; $j < $block->numStalls; $j++) {
    $wb->getActiveSheet()->setCellValueByColumnAndRow(0,$i+$j,"{$block->Block}{$block->Face}");
    $wb->getActiveSheet()->setCellValueByColumnAndRow(1,$i+$j,"{$j}");
  }

  $i += $block->numStalls;
}

foreach ($results as $stall) {
  $y = $layout[$stall->Block.$stall->Face];
  $wb->getActiveSheet()->setCellValueByColumnAndRow($stall->Hour-6,$y,"{$stall->Plate}");
}

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="ParkingUsage-'.$date.'.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($wb, 'Excel5');
$objWriter->save('php://output');

?>
