<?php

class Controller
{
	protected $_model;
	protected $_controller;
	protected $_action;
	protected $_template;
	protected $_modelBaseName;

	public function __construct( $model, $action )
	{
		$this->_controller = ucwords( __CLASS__ );
		$this->_action = $action;
		$this->_modelBaseName = $model;

		$this->_setTemplate( $action );
	}

	protected function _setModel( $modelName )
	{
		$modelName .= 'Model';
		$this->_model = new $modelName();
	}

	protected function _setTemplate( $viewName )
	{
		$this->_template = new Template(
			APP . DS . 'views' . DS . strtolower( $this->_modelBaseName ) . DS . $viewName . '.view.php'
		);
	}

	public function __destruct()
	{

		// TODO add if statement checking for a (new) variable that determines if this goes to AJAX
			// Then use this if not
//		try {
//			$this->_template->output();
//		} catch ( Exception $e ) {
//			die( "Application Error: " . $e->getMessage() );
//		}
	}
}