<?php

class Controller_Export extends Controller_Template
{
	public function action_index()
	{
    if ($date = Input::post('date', false)) {
      $date = date('Y-m-d', strtotime($date));
      Response::redirect("/export.php?date={$date}");
    } else {
      $this->template->title = "Export Usage";
      $this->template->content = View::forge('export/index');
    }
	}

}

?>
