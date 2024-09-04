<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');
class Building_type_model extends MY_Model
{
    public function __construct()
    {
        $this->table = 'building_types';
        $this->primary_key = 'id';
        $this->timestamps = FALSE;
        parent::__construct();
    }
}
