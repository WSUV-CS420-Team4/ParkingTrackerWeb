<?php

namespace Model;

class Parking extends \Model {
    public static function get_parking() {
        $query = "SELECT Plate, Block, Face, Stall, Time, GROUP_CONCAT(a.Abbreviation SEPARATOR ',') AS Attr
                                  FROM Parking AS p
                                  LEFT JOIN ParkingAttributes AS pa ON p.ParkingId=pa.ParkingId
                                  LEFT JOIN Attribute AS a ON pa.AttributeId=a.AttributeId
                                  GROUP BY Block, Face, Stall
                                  ORDER BY Block, Face, Stall";
        $result = \DB::query($query)->execute();

        return $result->as_array();
    }
}

?>
