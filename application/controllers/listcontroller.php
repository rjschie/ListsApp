<?php

class ListController extends Controller
{
	public function __construct( $model, $action )
	{
		parent::__construct( $model, $action );
		$this->_setModel( $model );
	}

	public function index()
	{
		try {
			$this->_template->title = "";
			$this->_template->List = $this->_model->getList();

			$this->_template->output();
		} catch(Exception $e) {
			echo "Application Error: " . $e->getMessage();
		}
	}

	public function add()
	{
		try {

			// TODO Add Checks here for correct $_POST variables

			$listItemArr = array(
				"text"      => $_POST['new-list-item-text'],
				"newPos"    => $_POST['new-list-item-pos']
			);
			$return = $this->_model->addListItem( $listItemArr );
			$this->_template->output($return);
		} catch(Exception $e) {
			echo "Application Error: " . $e->getMessage();
		}
	}

	public function edit()
	{
		try {
			$this->_template->vars = $_POST;
		} catch(Exception $e) {
			echo "Application Error: " . $e->getMessage();
		}
	}

	public function delete()
	{
		try {
			$this->_model->deleteListItem( $_POST['id'] );
		} catch(Exception $e) {
			echo "Application Error: " . $e->getMessage();
		}
	}
}