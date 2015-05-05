<?php

namespace Model;

class Block extends \Model {
    public static function get_blocks() {
        $query = "SELECT Block, Face, numStalls FROM Block";
        $result = \DB::query($query)->execute();

        return $result->as_array();
    }

    public static function get_block($block, $face) {
        $query = "SELECT Block, Face, numStalls FROM Block WHERE Block=:Block AND Face=:Face LIMIT 1";
        $result = \DB::query($query)->parameters(array("Block" => $block, "Face" => $face))->execute();

        return $result->as_array()[0];
    }

    public static function create_blockface($block, $face, $numStalls) {
      list($insert_id, $rows_affected) = \DB::insert("Block")->set(array('Block' => $block, 'Face' => $face, 'numStalls' => $numStalls))->execute();
      return $insert_id;
    }

    public static function update_blockface($block, $face, $numStalls) {
      \DB::query("UPDATE Block SET numStalls=:numStalls WHERE Block=:Block AND Face=:Face")->parameters(array('Block' => $block, 'Face' => $face, 'numStalls' => $numStalls))->execute();
    }

    public static function delete_blockface($block, $face) {
      $result = \DB::query("DELETE FROM Block WHERE Block=:Block AND Face=:Face LIMIT 1")->parameters(array("Block" => $block, "Face" => $face))->execute();
      return $result;
    }
}

?>
