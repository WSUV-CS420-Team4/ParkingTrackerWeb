<?php

use \Model\Parking;

class Controller_Parking extends Controller_Template
{
	public function action_index()
	{
		$data = array();
    $data['parking'] = Parking::get_parking();

		$this->template->title = "Parking";
		$this->template->content = View::forge('parking/index', $data);
	}

	public function action_404()
	{
		return new Response(Presenter::forge('welcome/404'), 404);
	}
}

?>
