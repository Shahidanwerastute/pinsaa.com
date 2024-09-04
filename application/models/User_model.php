<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends MY_Model
{
	public function __construct()
	{
		$this->table = 'users';
		$this->primary_key = 'id';
        $this->has_many['addresses'] = array('foreign_model'=>'Address_model','foreign_table'=>'addresses','foreign_key'=>'user_id','local_key'=>'id');
        parent::__construct();
	}
}
