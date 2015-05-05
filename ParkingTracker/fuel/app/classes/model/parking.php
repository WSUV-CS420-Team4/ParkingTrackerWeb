<?php

namespace Model;

class Parking extends \Model {
    public static function get_parking() {
        $query = "SELECT p.ParkingId, Plate, Block, Face, Stall, Time, GROUP_CONCAT(a.Abbreviation SEPARATOR ',') AS Attr
                                  FROM Parking AS p
                                  LEFT JOIN ParkingAttributes AS pa ON p.ParkingId=pa.ParkingId
                                  LEFT JOIN Attribute AS a ON pa.AttributeId=a.AttributeId
                                  GROUP BY Block, Face, Stall, Time
                                  ORDER BY Block, Face, Stall";
        $result = \DB::query($query)->execute();

        return $result->as_array();
    }

    public static function delete_parking($id) {
      $result = \DB::query("DELETE FROM Parking WHERE ParkingId = :id LIMIT 1")->parameters(array("id" => $id))->execute();
      return $result;
    }

    public static function get_usageByDay($date = false) {
      $times = array(8,9,10,11,12,13,14,15,16,17);

      if ($date == false) {
        $date = date('Y-m-d');
      }


      $query = \DB::query("SELECT Plate, CONCAT_WS(':', Block, Face, Stall) AS StallStr, GROUP_CONCAT(a.Abbreviation SEPARATOR ',') AS Attr, HOUR(Time) AS Hour
                                FROM Parking AS p
                                LEFT JOIN ParkingAttributes AS pa ON p.ParkingId=pa.ParkingId
                                LEFT JOIN Attribute AS a ON pa.AttributeId=a.AttributeId
                                WHERE DATE(Time) = :date
                                GROUP BY Block, Face, Stall, Hour
                                ORDER BY Block, Face, Stall");
      $query->bind('date', $date);
      $results = $query->execute();
      $stalls = $results->as_array();

      $data = array();

      foreach ($stalls as $stall) {
        if (!array_key_exists($stall['StallStr'], $data)) {
          $data[$stall['StallStr']] = array();
          $data[$stall['StallStr']]['StallStr'] = $stall['StallStr'];
        }

        $data[$stall['StallStr']][$stall['Hour']] = $stall;
      }

      return $data;
    }
}

?>
