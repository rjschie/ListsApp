<?php

class ListModel extends Model
{
	public function getList()
	{
		$this->_sql = "
					SELECT id, text, done, pos
					FROM listitems
					ORDER BY pos ASC
					";
		$List = $this->getAll();
		if( empty($List) )
			return false;
		return $List;
	}

	public function addListItem( $listItemArr )
	{
		$this->_sql = "INSERT INTO listitems (list_id, text, done, pos)
					   VALUES (1, :text, 0, :newPos)";

		$sth = $this->_db->prepare( $this->_sql );
		$sth->execute( $listItemArr );
		return $this->_db->lastInsertId();
	}

	public function editListItem( $id, $text )
	{
		//
	}

	public function deleteListItem( $id )
	{
		$this->_sql = "DELETE FROM listitems
					   WHERE id = ?";
		$sth = $this->_db->prepare( $this->_sql );
		$sth->execute( array( $id ) );
	}

}