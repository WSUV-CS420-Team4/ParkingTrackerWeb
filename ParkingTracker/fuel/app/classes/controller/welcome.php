<?php
class Controller_Welcome extends Controller_Template
{
	public function action_index()
	{
		$data = array();
		$this->template->title = "Parking Tracker";
		$this->template->content = View::forge('welcome/index', $data);
	}

	public function action_404()
	{
		return new Response(Presenter::forge('welcome/404'), 404);
	}
}

?>
