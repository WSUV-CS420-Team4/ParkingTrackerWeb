<?php
class Controller_Welcome extends Controller_Template
{
	public function action_index()
	{
		$data = array();
		$this->template->title = "Parking Usage";
		$this->template->content = View::forge('usage/index', $data);
	}

	public function action_404()
	{
		return new Response(Presenter::forge('welcome/404'), 404);
	}
}

?>
