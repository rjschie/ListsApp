<?php

class ListModel extends Model
{

	// TODO Error Check: use returns for PDO Execute for error checking

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

	public function updateOrder( $orderArr )
	{
		$this->_sql = "UPDATE listitems SET pos = CASE ";
		for($i = 0; $i < count($orderArr); $i++)
			$this->_sql .= "WHEN id=? THEN ".$i." ";
		$this->_sql .= " ELSE pos END;";

		$sth = $this->_db->prepare( $this->_sql );
		$sth->execute( $orderArr );
	}

	public function markDone( $id )
	{
		$this->_sql = "UPDATE listitems
					   SET done = NOT `done`
					   WHERE id=:id";

		$sth = $this->_db->prepare( $this->_sql );
		return $sth->execute( array( "id" => $id ) );
	}

	public function deleteListItem( $id )
	{
		$this->_sql = "DELETE FROM listitems
					   WHERE id = ?";
		$sth = $this->_db->prepare( $this->_sql );
		return $sth->execute( array( $id ) );
	}

}