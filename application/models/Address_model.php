<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');
class Address_model extends MY_Model
{
    public function __construct()
    {
        $this->table = 'addresses';
        $this->primary_key = 'id';
        $this->has_many['urls'] = array('foreign_model'=>'Address_url_model','foreign_table'=>'address_urls','foreign_key'=>'address_id','local_key'=>'id');
        parent::__construct();
    }
}
