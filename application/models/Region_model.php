<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');
class Region_model extends MY_Model
{
    public function __construct()
    {
        $this->table = 'regions';
        $this->primary_key = 'id';
        $this->timestamps = FALSE;
        parent::__construct();
    }
}
