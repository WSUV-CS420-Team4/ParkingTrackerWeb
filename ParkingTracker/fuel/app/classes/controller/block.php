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

	public function action_create() {
		$data = array();

		$val = Validation::forge("blockCreateValidation");
		$val->add_field('block', 'Block Number', 'required|is_numeric|numeric_min[0]');
		$val->add_field('face', 'Block Face', 'required|exact_length[1]|valid_string[alpha]');
		$val->add_field('numStalls', 'Number of Stalls', 'required|is_numeric|numeric_min[0]');

		if ($val->run()) {
			$vars = $val->validated();

			Block::create_blockface($vars['block'], $vars['face'], $vars['numStalls']);
			Response::redirect('block/');
		} else {
			Session::set_flash('error', $val->error());

			$this->template->title = "Create Blockface";
			$this->template->content = View::forge('block/create', $data);
		}
	}

	public function action_edit($block, $face) {
		$data = array();

		$val = Validation::forge("blockEditValidation");
		$val->add_field('block', 'Block Number', 'required|is_numeric|numeric_min[0]');
		$val->add_field('face', 'Block Face', 'required|exact_length[1]|valid_string[alpha]');
		$val->add_field('numStalls', 'Number of Stalls', 'required|is_numeric|numeric_min[0]');

		if ($val->run()) {
			$vars = $val->validated();

			Block::update_blockface($vars['block'], $vars['face'], $vars['numStalls']);
			Response::redirect('block/');
		} else {
			Session::set_flash('error', $val->error());
			$blockData = Block::get_Block($block, $face);

			$data['Block'] = $blockData['Block'];
			$data['Face'] = $blockData['Face'];
			$data['numStalls'] = $blockData['numStalls'];

			$this->template->title = "Edit Blockface";
			$this->template->content = View::forge('block/edit', $data);
		}
	}


	public function action_delete($block, $face) {
		$result = Block::delete_blockface($block, $face);

		Response::redirect('block/');
	}
}

?>
