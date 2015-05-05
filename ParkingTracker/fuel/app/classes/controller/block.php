<?php

use \Model\Block;

class Controller_Block extends Controller_Template
{
	public function action_index()
	{
		$data = array();
    $data['blocks'] = Block::get_blocks();

		$this->template->title = "Blockfaces";
		$this->template->content = View::forge('block/index', $data);
	}

	public function action_404()
	{
		return new Response(Presenter::forge('welcome/404'), 404);
	}
}

?>
