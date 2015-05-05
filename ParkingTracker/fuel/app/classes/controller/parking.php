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

	public function action_delete($id) {
		$result = Parking::delete_parking($id);

		Response::redirect('parking/');
	}

	public function action_daily() {
		$data = array();

		$data['stalls'] = Parking::get_usageByDay();
		$data['times'] = array(8,9,10,11,12,13,14,15,16,17);

		$this->template->title = "Daily Usage";
		$this->template->content = View::forge('parking/daily', $data);

	}
}

?>
