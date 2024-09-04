<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');
class City_model extends MY_Model
{
    public function __construct()
    {
        $this->table = 'cities';
        $this->primary_key = 'id';
        $this->timestamps = FALSE;
        parent::__construct();
    }
}
