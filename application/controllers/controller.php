<?php

class Controller
{
	protected $_model;
	protected $_template;
	protected $_modelName;
	protected $_controllerName;
	protected $_action;

	public function __construct( $model, $action )
	{
		$this->_controllerName = ucwords( __CLASS__ );
		$this->_action = $action;
		$this->_modelName = $model;

		$this->_setTemplate( $action );
	}

	protected function _setModel( $modelName )
	{
		$modelName .= 'Model';
		$this->_model = new $modelName();
	}

	protected function _setTemplate( $action )
	{
		$this->_template = new Template(
			APP . '/views/' . strtolower( $this->_modelName ) . '/' . $action . '.v.php'
		);
	}

	protected function _isAjax( $action )
	{
		$headers = apache_request_headers();


		// $this->_template->errors[] = "Your session has expired.";
		$this->_template->errors[] = var_dump($_SESSION);
		$this->_template->xhrOutput();
		// $this->_template->output();

		return;
		if(
		   !isset($headers['X-Csrf-Token'])
		|| empty($headers['X-Csrf-Token'])
		|| !Utils::verifyCSRFToken( $headers['X-Csrf-Token'], $action )
		) {

			if(isset($headers['X-Requested-With']) && $headers['X-Requested-With'] == 'XMLHttpRequest') {
				// $this->_template->errors[] = "Your session has expired.";
				$this->_template->errors[] = var_dump($_SESSION);
				$this->_template->xhrOutput();
				// $this->_template->output();
			} else {
				header( "Location: " . PUBLIC_HTML . "list" );
			}
			return false;
		}

		return true;
	}
}