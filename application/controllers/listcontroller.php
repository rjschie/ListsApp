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
			$this->_template->csrf_token = Utils::setCSRFToken($this->_modelName);
			$this->_template->List = $this->_model->getList();
		} catch(Exception $e) {
			$this->_template->errors[] = Utils::filtErrMsg( "Could not get the list.", $e );
		}
		$this->_template->output();
	}

	public function add()
	{

		// Check if ajax
		if( !$this->_isAjax( $this->_modelName ) )
			return false;

		try {
			// Set Variables
			$text = $_POST['add-new-item-text'];
			$newPos = $this->_model->getNumRows() + 1;

			// User input check
			if( $text == "" )
				$this->_template->errors[] = "You must input text.";

			// No errors?
			if( empty($this->_template->errors) ) {

				// Perform add
				$id = $this->_model->addListItem( array( "text"=>$text, "newPos"=>$newPos ) );

				// Set the values for jQuery Script to add item to DOM
			    $this->_template->json["id"] = $id;
				$this->_template->json["newPos"] = $newPos;
				$this->_template->json["text"] = Utils::cleanEcho( $text );
			}
		} catch(Exception $e) {
			$this->_template->errors[] = Utils::filtErrMsg( "Could not add list item.", $e );
		}

		// Use XHR output
		$this->_template->xhrOutput();
	}

	public function update( $query )
	{

		// Check if ajax
		if( !$this->_isAjax( $this->_modelName ) )
			return false;

		if($query[0] == "done") {
			try {
				if( !$this->_model->markDone( $_POST['id'] ) )
					$this->_template->errors[] = "Could not mark list item as done.";
			} catch(Exception $e) {
				$this->_template->errors[] = Utils::filtErrMsg( "Could not mark list item as done.", $e );
			}
		} elseif($query[0] == "order") {
			try {
				if( !$this->_model->updateOrder( $_POST['id'] ) )
					$this->_template->errors[] = "Could not update list positions.";
			} catch(Exception $e) {
				$this->_template->errors[] = Utils::filtErrMsg( "Could not update list positions.", $e );
			}
		} else {
			$this->_template->errors[] = "Invalid URL Query.";
		}
		$this->_template->xhrOutput();
	}

	public function delete()
	{

		// Check if ajax
		if( !$this->_isAjax( $this->_modelName ) )
			return false;

		try {
			if( !$this->_model->deleteListItem( $_POST['id'] ) )
				$this->_template->errors[] = "Could not delete list item.";
		} catch(Exception $e) {
			$this->_template->errors[] = Utils::filtErrMsg( "Could not delete list item.", $e );
		}
		$this->_template->xhrOutput();
	}
}