<?php

namespace Model;

class Block extends \Model {
    public static function get_blocks() {
        $query = "SELECT Block, Face, numStalls FROM Block";
        $result = \DB::query($query)->execute();

        return $result->as_array();
    }
}

?>
