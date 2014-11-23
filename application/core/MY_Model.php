<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Extending core model
 * @author Dijo David
 * 
 */

class MY_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	/**
	 * Insert record to table
	 */
	function add( $data )
	{
		if( $data )
		{
			return $this->db->insert($this->table, $data);
		}
		return FALSE;
	}
	
	/**
	 * Insert multiple records to table
	 */
	function add_batch( $data )
	{
		if( $data )
		{
			return $this->db->insert_batch($this->table, $data);
		}
		return FALSE;
	}
	
	/**
	 * Update a record based on ID passed
	 */
	function update($data = array())
	{
		if( $data )
		{
			//collect id and unset it from the array to update
			$id = $data['id'];
			unset( $data['id'] );
			
			return $this->db->update($this->table, $data, array("id"=>$id));
		}
		return FALSE;
	}
	
	/**
	 * Delete a record from table
	 */
	function delete( $id )
	{
		if( $id )
		{
			return $this->db->delete($this->table, array('id' => $id));
		}
		return FALSE;
	}
	
	/**
	 * Get all records from the table
	 */
	function get_all()
	{
		return $this->db->get($this->table);
	}
        
	/**
	 * Get a record by ID
	 */
	function get_by_id( $id )
	{
		return ($id) ? $this->db->get_where($this->table, array('id' => $id))->row() : FALSE;
	}
        
	/**
	 * Get result based on table columns
	 */
	function get_by_column( $cols = array(), $limit = 0, $start = 0 )
	{
		$this->db->order_by('id','desc');
		
		if($limit)
		{
			$this->db->limit($limit, $start);
		}
		if($cols)
		{
			$this->db->where($cols);
		}
		
		$query = $this->db->get($this->table);
		return $query;
	}
	
	/**
	 * Total record count
	 */
	function record_count() 
	{
    	return $this->db->count_all($this->table);
    }
	
	/**
	 * Get a result based on limit and start for pagination
	 * 
	 * @param $limit - result limit
	 * @param $start - start record
	 * @return object - query object
	 */
	function get_result_set($limit, $start) 
	{
        $this->db->limit($limit, $start);
		$this->db->order_by('id','desc');
        $query = $this->db->get($this->table);
 
        //return ($query->num_rows() > 0) ? $query : FALSE;
        return $query;
   	}
	
	/**
	 * create suggestion list for auto complete
	 */
	function create_suggestion_list($results = array())
	{
		$data = array();
		
		if($results )
		{
			foreach($results as $result)
			{
				$data[] = html_entity_decode($result->query, ENT_COMPAT, 'UTF-8');
			}
		}
		return $data;
	}
	
	/**
	 * Get the result count
	 * 
	 * @param $cols optional - where conditions
	 * @return count int
	 */
	function get_count($cols = array())
	{
		if($cols)
		{
			$this->db->where($cols);
		}
		return $this->db->count_all_results($this->table);
	}
}