<?php

class IndexController extends Controller
{

	public function __construct( $model, $action )
	{
		parent::__construct($model, $action);
	}

	public function index()
	{
		$this->_template->output();
	}
}