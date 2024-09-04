<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');
class District_model extends MY_Model
{
    public function __construct()
    {
        $this->table = 'districts';
        $this->primary_key = 'id';
        $this->timestamps = FALSE;
        parent::__construct();
    }
}
