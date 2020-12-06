<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test_model extends CI_Model{
	public $table;
	public $closure_table = 'closures';
	public function __construct($table_name = NULL, $closure_table = NULL){
		parent::__construct();
		$this->table = $table_name;
		echo $this->table."<br>";
		$this->closure_table = $closure_table;
		echo $this->closure_table;		
	}
		
}
