<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Address extends MY_Controller
{

    protected $user_id;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Address_model', 'Address_url_model']);
        $this->user_id = $this->session->userdata('user')->id;
    }

    public function manage()
    {
        $this->data['addresses'] = $this->Address_model->get_all(['user_id' => $this->user_id]);
        $this->data['view'] = 'address/manage';
        $this->load->view('layouts/template', $this->data);
    }

    public function add()
    {
        $this->data['user'] = $this->session->userdata('user');
        $address = $this->Address_model->where('user_id', $this->user_id)->get();
        $this->data['view'] = ($address || isset($_GET['q']) ? 'address/add-address' : 'address/no-address');
        $this->load->view('layouts/template', $this->data);
    }

    public function save()
    {
        $posted_data = $this->request;
        unset($posted_data['address_for']);
        $posted_data['user_id'] = $this->user_id;
        if (!$posted_data['building_type']) {
            $this->error_response(trans('validation_building_type'));
        }
        if ($posted_data['building_type'] == '1') { // for villa
            $file_uploaded = upload_file('villa_picture');
            if ($file_uploaded['status'] == false) {
                $this->error_response($file_uploaded['message']);
            } else {
                $posted_data['villa_picture'] = $file_uploaded['file_name'];
            }
        }
        if ($posted_data['building_type'] == '2') { // for Building
            $file_uploaded = upload_file('building_picture');
            if ($file_uploaded['status'] == false) {
                $this->error_response($file_uploaded['message']);
            } else {
                $posted_data['building_picture'] = $file_uploaded['file_name'];
            }
            $file_uploaded = upload_file('apartment_picture');
            if ($file_uploaded['status'] == false) {
                $this->error_response($file_uploaded['message']);
            } else {
                $posted_data['apartment_picture'] = $file_uploaded['file_name'];
            }
        }
        if ($posted_data['building_type'] == '3') { // for office
            $file_uploaded = upload_file('office_picture');
            if ($file_uploaded['status'] == false) {
                $this->error_response($file_uploaded['message']);
            } else {
                $posted_data['office_picture'] = $file_uploaded['file_name'];
            }
        }
        $id = $this->Address_model->insert($posted_data);
        if ($id > 0) {
            $this->success_response(trans('address_added_successfully'), ['redirect' => true, 'redirect_to' => base_url('address/manage')]);
        } else {
            $this->error_response(trans('something_went_wrong'));
        }
    }
    

    public function edit($id)
    {
        $address = $this->Address_model->get(['id' => $id, 'user_id' => $this->session->userdata('user')->id]);
        if ($address) {
            $this->data['address'] = $address;
            $this->data['view'] = 'address/edit-address';
            $this->load->view('layouts/template', $this->data);
        } else {
            redirect(base_url('address/manage'));
        }
    }

    public function update()
    {
        $posted_data = $this->request;
        $id = $posted_data['id'];
        unset($posted_data['id']);
        if ($posted_data['building_type'] == '1') { // for villa
            $file_uploaded = upload_file('villa_picture');
            if ($file_uploaded['status'] == false) {
                $this->error_response($file_uploaded['message']);
            } else {
                $posted_data['villa_picture'] = $file_uploaded['file_name'];
            }
        }
        if ($posted_data['building_type'] == '2') { // for Building
            $file_uploaded = upload_file('building_picture');
            if ($file_uploaded['status'] == false) {
                $this->error_response($file_uploaded['message']);
            } else {
                $posted_data['building_picture'] = $file_uploaded['file_name'];
            }
            $file_uploaded = upload_file('apartment_picture');
            if ($file_uploaded['status'] == false) {
                $this->error_response($file_uploaded['message']);
            } else {
                $posted_data['apartment_picture'] = $file_uploaded['file_name'];
            }
        }
        if ($posted_data['building_type'] == '3') { // for office
            $file_uploaded = upload_file('office_picture');
            if ($file_uploaded['status'] == false) {
                $this->error_response($file_uploaded['message']);
            } else {
                $posted_data['office_picture'] = $file_uploaded['file_name'];
            }
        }
        $id = $this->Address_model->update($posted_data, ['id' => $id]);
        if ($id > 0) {
            $this->success_response(trans('address_updated_successfully'), ['redirect' => true, 'redirect_to' => base_url('address/manage')]);
        } else {
            $this->error_response(trans('something_went_wrong'));
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $deleted = $this->Address_model->delete(['id' => $id]);
        if ($deleted) {
            $this->Address_url_model->delete(['address_id' => $id]);
            $this->success_response(trans('address_deleted_successfully'));
        } else {
            $this->error_response(trans('something_went_wrong'));
        }
    }
}
