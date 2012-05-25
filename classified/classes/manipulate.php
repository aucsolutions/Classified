<?php

	require_once ( "database.php" ) ;
	
	class DataManipulator extends Database
	{
		
		var $tableName = "" ;
		var $dataWhere = NULL ;
		var $dataSend = NULL ;
		var $errorString = "" ;
		var $numberOfRecords = 0 ;
		var $like_array = NULL ;
		var $greater_array = NULL ;
		var $smaller_array = NULL ;
		
		
		function get_num_records ( )
		{
			return $this->numberOfRecords ;
		}
		
		function set_greater ( $val_array )
		{
			if ( is_array ( $val_array ) )
				$this->greater_array = $val_array ;
		}
		function set_smaller ( $val_array )
		{
			if ( is_array ( $val_array ) )
				$this->smaller_array = $val_array ;
		}
		
		function set_like ( $val_array )
		{
			if ( is_array ( $val_array ) )
				$this->like_array = $val_array ;
		}
		
		function get_error ( )
		{
			return $this->errorString ;
		}
		
		function count_record ( $table , $where = NULL )
		{
			if ( $table == "" )
			{
				$this->errorString = "Table not found." ;
				return NULL ;
			}
			
			$connection = Database::connect ( ) ;
			$query = "select count(*) from $table where 1 " ;
			if ( is_array ( $where ) && $where != NULL )
			{
				if ( ! empty ( $where ) )
				{
					foreach ( $where as $key=>$val )
					{
						if ( $val == NULL )
							$query .= " and $key is null " ;
						else
							$query .= " and $key='$val' " ;
					}
				}
			}
			if ( ! empty ( $this->like_array ) )
			{
				foreach ( $this->like_array as $key => $val )
					$query .= " and $key like '%".$val."%'" ;
			}
			$this->like_array = NULL ;
			
			if ( ! empty ( $this->greater_array ) )
			{
				foreach ( $this->greater_array as $key => $val )
					$query .= " and $key <= $val" ;
			}
			$this->greater_array = NULL ;
			
			if ( ! empty ( $this->smaller_array ) )
			{
				foreach ( $this->smaller_array as $key => $val )
					$query .= " and $key >= $val" ;
			}
			$this->smaller_array = NULL ;
			
			$records = Database::get_record_set ( $query ) ;
			$rec_array = Database::records_to_array ( $records ) ;
			$this->numberOfRecords = $rec_array[0][0] ;
			return intval ( $this->numberOfRecords ) ;
		}
		
		function select ( $table , $selectWhat = "*" , $where = NULL , $start = -1 , $limit = 15 , $orderBy = "" )
		{
			if ( $table == "" )
			{
				$this->errorString = "Table not found." ;
				return NULL ;
			}
			if ( $orderBy != "" )
			{
				$orderBy = " order by " . $orderBy ;
			}
			
			$connection = Database::connect ( ) ;
			$query = "select $selectWhat from $table where 1 " ;
			if ( is_array ( $where ) && $where != NULL )
			{
				if ( ! empty ( $where ) )
				{
					foreach ( $where as $key=>$val )
					{
						if ( $val == NULL )
							$query .= " and $key is null " ;
						else
							$query .= " and $key='$val' " ;
					}
				}
			}
			if ( ! empty ( $this->like_array ) )
			{
				foreach ( $this->like_array as $key => $val )
					$query .= " and $key like '%".$val."%'" ;
			}
			$this->like_array = NULL ;
			
			if ( ! empty ( $this->greater_array ) )
			{
				foreach ( $this->greater_array as $key => $val )
					$query .= " and $key <= $val" ;
			}
			$this->greater_array = NULL ;
			
			if ( ! empty ( $this->smaller_array ) )
			{
				foreach ( $this->smaller_array as $key => $val )
					$query .= " and $key >= $val" ;
			}
			$this->smaller_array = NULL ;
			
			
			$query .= $orderBy ;
			$records = Database::get_record_set ( $query ) ;
			$this->numberOfRecords = Database::get_total_records ( ) ;
			if ( $start > -1 )
			{
				$records = Database::get_record_set ( $query." limit $start, $limit" ) ;
			}
			else
			{
				$records = Database::get_record_set ( $query ) ;
			}
			
			return Database::records_to_array ( $records ) ;
		}
		
		function update ( $table , $values , $where )
		{
			if ( $table != "" )
			{
				$qry = "update $table set " ;
				if ( ! empty ( $values ) && is_array ( $values ) )
				{
					foreach ( $values as $field => $newVal )
					{
						if ( $newVal == NULL )
							$qry .= "$field=null," ;
						else
							$qry .= "$field='$newVal'," ;
					}
					$qry = substr ( $qry , 0 , -1 ) ;
				}
				elseif ( is_string ( $values ) )
				{
					$qry .= $values ;
				}
				
				$qry .= " where 1 " ;
				if ( ! empty ( $where ) )
					foreach ( $where as $key => $val )
						$qry .= " and $key='$val'" ;
				
				Database::operation_query ( $qry ) ;
			}
		}
		
		function insert ( $table , $values )
		{
			if ( $table != "" )
			{
				$qry = "insert into $table set" ;
				if ( ! empty ( $values ) )
					foreach ( $values as $tableField => $valueToInsert )
						$qry .= " $tableField='$valueToInsert' ," ;
				
				$qry = substr ( $qry , 0 , -1 ) ;
				Database::operation_query ( $qry ) ;
				return Database::get_last_id ( ) ;
			}
			
		}
		
		function delete ( $table , $where , $limit = 1 )
		{
			if ( $table != "" )
			{
				$qry = "delete from $table where 1" ;
				
				if ( ! empty ( $where ) )
				{
					foreach ( $where as $key => $val )
						if ( $val == NULL )
							$qry .= " and $key is null " ;
						else
							$qry .= " and $key='$val' " ;
					Database::operation_query ( $qry." limit $limit" ) ;
				}
			}
		}
		
	}
	
?>