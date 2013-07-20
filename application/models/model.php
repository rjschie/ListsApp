<?php

class Model
{
	protected $_db;
	protected $_sql;

	public function __construct()
	{
		$this->_db = DB::init();
	}

	public function getRowCount( $data = null )
	{
		if( !$this->_sql ) {
			throw new Exception("No SQL Query.");
		}

		$sth = $this->_db->prepare( $this->_sql );
		$sth->execute( $data );
		return $sth->rowCount();
	}

	public function getAll( $data = null )
	{
		if( !$this->_sql ) {
			throw new Exception("No SQL Query.");
		}

		$sth = $this->_db->prepare( $this->_sql );
		$sth->execute( $data );
		return $sth->fetchAll();
	}

	public function getRow( $data = null )
	{
		if( !$this->_sql ) {
			throw new Exception("No SQL Query.");
		}

		$sth = $this->_db->prepare( $this->_sql );
		$sth->execute( $data );
		return $sth->fetch();
	}
}