<?php

class MY_Controller extends CI_Controller
{
    protected $locale;
    protected $request = array();
    protected $response = array();
    protected $data = array();

    public function __construct()
    {
        parent::__construct();

        check_user_login();

        $this->load->library('form_validation');

        if (isset($_GET['locale']) && in_array($_GET['locale'], ['en', 'ar'])) {
            $this->session->set_userdata('locale', $_GET['locale']);
        } else {
            // setting default language as EN
            if (!$this->session->userdata('locale')) {
                $this->session->set_userdata('locale', 'en');
            }
        }

        $this->data['locale'] = $this->locale = $this->session->userdata('locale');
        $this->config->set_item('language', ($this->locale == 'ar' ? 'arabic' : 'english'));
        $this->lang->load('messages', ($this->locale == 'ar' ? 'arabic' : 'english'));

        $this->request = array_merge($this->input->post(), $this->input->get());
        unset($this->request['locale']);
    }

    public function change_language()
    {
        $locale = $this->input->get('locale');
        $uri_string = $this->input->get('uri_string');
        $this->session->set_userdata('locale', $locale);
        $this->session->set_flashdata('success', trans('language_updated_successfully', $locale));
        redirect(base_url($uri_string));
    }

    public function success_response($message = "", $data = array())
    {
        $this->response['status'] = true;
        $this->response['message'] = $message;
        $this->response['data'] = $data;
        echo json_encode($this->response, JSON_UNESCAPED_UNICODE);
        die;
    }

    public function error_response($message = "", $data = array())
    {
        $this->response['status'] = false;
        $this->response['message'] = $message;
        $this->response['data'] = $data;
        echo json_encode($this->response, JSON_UNESCAPED_UNICODE);
        die;
    }
}
