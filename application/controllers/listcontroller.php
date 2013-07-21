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

			// TODO User Input Checks: Add Checks here for correct $_POST variables

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

	public function update( $query )
	{
		if($query[0] == "done") {
			try {
				$this->_model->markDone( $_POST['id'] );
			} catch(Exception $e) {
				echo "Application Error: " . $e->getMessage();
			}
		} elseif($query[0] == "order") {
			try {
				$this->_model->updateOrder( $_POST['id'] );
			} catch(Exception $e) {
				echo "Application Error: " . $e->getMessage();
			}
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