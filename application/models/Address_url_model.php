<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');
class Address_url_model extends MY_Model
{
    public function __construct()
    {
        $this->table = 'address_urls';
        $this->primary_key = 'id';
        $this->timestamps = FALSE;
        parent::__construct();
    }
}
