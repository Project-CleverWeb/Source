<?php
/**
 * MySQLi extended class
 */
 
class extended_mysqli extends mysqli {
	
	public $the_queue;
	protected $start_time;
	protected $end_time;
	protected $resource;
	
	/**
	 * 
	 * @param resource $resource The pre defined recource for mysqli
	 * @return array The keys of all the added queries
	 */
	function __construct($resource){
		$this->resource = $resource;
	}
	
	function add_to_queue($query){
		$key = microtime();
		$queries = explode(';',$query); // break into seperate queries
		$keys = array();
		foreach ($queries as $query) {
			if(isset($this->the_queue[$key])){
				// should never happen... but just in case
				$this->add_to_error_array(array(
					'message'  => 'Key "'.$key.'" alread exists! nothing added.',
					'type'     => 'failure',
					'method'   => __METHOD__,
					'line'     => __LINE__,
					'filepath' => __DIR__.'/'.__FILE__
				));
			}
			if(!is_array($this->the_queue)){
				$this->the_queue = array();
			}
			$this->the_queue[$key] = (string) $query;
			$keys[] = $key++;
		}
		return $keys;
	}
	
	function del_from_queue($key){
		if(isset($this->the_queue[$key])){
			unset($this->the_queue[$key]);
		}
		else{
			$this->add_to_error_array(array(
				'message'  => 'Key "'.$key.'" was not found in queue, nothing removed.',
				'type'     => 'notice',
				'method'   => __METHOD__,
				'line'     => __LINE__,
				'filepath' => __DIR__.'/'.__FILE__
			));
			return FALSE;
		}
		return TRUE;
	}
	
	function update_in_queue($key,$query){
		if(isset($this->the_queue[$key])){
			$this->the_queue[$key] = (string) $query;
		}
		else{
			$this->add_to_error_array(array(
				'message'  => 'Key "'.$key.'" was not found in queue, nothing updated.',
				'type'     => 'notice',
				'method'   => __METHOD__,
				'line'     => __LINE__,
				'filepath' => __DIR__.'/'.__FILE__
			));
			return FALSE;
		}
		return TRUE;
	}
	
	function clear_queue(){
		$this->the_queue = array();
		return TRUE;
	}
	
	function execute(&$output,$noclear=FALSE){
		$this->start_time = microtime(TRUE);
		if(empty($this->the_queue[0])){
			$this->add_to_error_array(array(
				'message'  => 'The queue was empty, nothing changed/executed.',
				'type'     => 'notice',
				'method'   => __METHOD__,
				'line'     => __LINE__,
				'filepath' => __DIR__.'/'.__FILE__
			));
		}
		
		// query prep
		$queries = $this->the_queue;
		$the_query = '';
		$the_keys =  array();
		foreach ($queries as $key => $value) {
			$the_query .= $value.';'; // one big query string
			$the_keys[] = $key; // store the keys for later
		}
		
		// gather the info from the database
		$the_result = array();
		$i = 0;
		if($this->resource->multi_query($the_query)){
			do{
				if($result = $this->resource->store_result()){
					while($row = $result->fetch_row()){
						$the_result[$i][] = $row; // store all the results into an organized array
					}
					$result->free();
				}
				if($this->resource->more_results()){
					$i++;
				}
			}
			while ($this->resource->next_result()); 
		}
		
		
		// give each result back its own query key
		$return = array();
		$tempcount = count($the_result);
		$f_num = 0;
		foreach ($the_result as $key => $value) {
			if(isset($the_keys[$key])){
				$return[$the_keys[$key]] = $value;
			}
			else{
				$f_num++; // count the failures,
				if($tempcount==($key+1)){
					$this->add_to_error_array(array(
						'message'  => sprintf('Failed to add keys to %1$s queries!',$f_num),
						'type'     => 'failure',
						'method'   => __METHOD__,
						'line'     => __LINE__,
						'filepath' => __DIR__.'/'.__FILE__
					));
				}
				$return[] = $value;
			}
		}
		
		if(!$noclear){
			$this->clear_queue();
		}
		$this->end_time = microtime(TRUE);
		
		$this->the_results = $return; // set $the_results to an array of results for each query by key
		return $return; // return array of results for each query by key
	}
	
	/**
	 * Simple Query Maker
	 * 
	 * Adds common queries to the queue
	 * 
	 * @param $type (string) The type of query to make
	 * 
	 * @param $auto_add (bool) [optional] Add the query to the queue, or if set to FALSE return the query without adding it to the queue 
	 * @return (mixed) It may return either the key for the added query as an array (success),
	 * 	The actual query, (success with $auto_add set to FALSE), or FALSE on failure.
	 */
	function simple_query($type,$args,$auto_add=TRUE){
		// add
		// remove
		// update
		// search
		
		if($auto_add){
			return $this->add_to_queue($query);
		}
		else{
			return $query;
		}
	}
	
	function error_array(){
		$return = array(); // ensure this always returns an array
	}
	
	function stats_array(){
		$return = array(); // ensure this always returns an array
	}
	
	protected function add_to_error_array(){
		
	}
	
	function __destruct(){
		//clean up left overs
	}
	
}
 
 
 
 
 
 
 
 
 
 
 
 
 