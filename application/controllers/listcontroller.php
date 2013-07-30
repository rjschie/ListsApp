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
			$this->_template->output();
		} catch(Exception $e) {
			// ERROR fix this part - make it display within the template
			echo Utils::filtErrMsg( "Could not get the list.", $e );
			$this->_template->output();
		}
	}

	public function add()
	{
		try {

			// AJAX Check   TODO move this to a function
			if(!$this->_isAjax( $this->_modelName )) {
				$headers = apache_request_headers();
				if(isset($headers['X-Requested-With']) && $headers['X-Requested-With'] == 'XMLHttpRequest')
					echo json_encode( array( "err" => 1, "message" => "Your session has expired." ) );
				else
					echo "Please return to the main page.";
				return false;
			}

			$text = $_POST['add-new-item-text'];
			$newPos = $this->_model->getNumRows();
			$newPos++;

			// User input check
			if( $text == "" )
				$err[] = "You must input text.";

			if(!empty($err)) {
				$totalMsg = "";
				foreach ( $err as $msg )
					$totalMsg .= $msg."<br />";
				$errArr = array( "err"=>1, "message"=>$totalMsg );
				echo json_encode( $errArr );
				return false;
			}

			// Perform add
			$id = $this->_model->addListItem( array( "text"=>$text, "newPos"=>$newPos ) );

			// Return the values to jQuery Script
			$returnArr = array(
				"err" => 0,
				"id" => $id,
				"newPos" => $newPos,
				"text" => Utils::cleanEcho($text)
			);
			echo json_encode($returnArr);
			return true;

		} catch(Exception $e) {
			$errArr = array( "err"=>1, "message"=>Utils::filtErrMsg( "Could not add list item.", $e ) );
			echo json_encode( $errArr );
		}
	}

	public function update( $query )
	{
		if($query[0] == "done") {
			try {
				if( !$this->_model->markDone( $_POST['id'] ) )
					echo "Could not mark list item as done.";
			} catch(Exception $e) {
				echo Utils::filtErrMsg( "Could not mark list item as done.", $e );
			}
		} elseif($query[0] == "order") {
			try {
				if( !$this->_model->updateOrder( $_POST['id'] ) )
					echo "Could not update list positions.";
			} catch(Exception $e) {
				echo Utils::filtErrMsg( "Could not update list positions.", $e );
			}
		} else {
			echo "Invalid Query.";
		}
	}

	public function edit()
	{
		try {
			$this->_template->vars = $_POST;
		} catch(Exception $e) {
			echo Utils::filtErrMsg( "Could not edit list item.", $e );
		}
	}

	public function delete()
	{
		try {
			if( !$this->_model->deleteListItem( $_POST['id'] ) )
				echo "Could not delete list item.";
		} catch(Exception $e) {
			echo Utils::filtErrMsg( "Could not delete list item.", $e );
		}
	}
}