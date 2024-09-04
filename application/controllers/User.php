<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'third_party/hybridauth/src/autoload.php';

use Hybridauth\Hybridauth;

class User extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['User_model', 'Address_model']);
    }

    public function index()
    {
        if ($this->session->userdata('user')) {
            $address = $this->Address_model->where('user_id', $this->session->userdata('user')->id)->get();
            $this->session->set_flashdata('success', trans('you_are_already_logged_in'));
            redirect(($address ? base_url('address/manage') : base_url('address/add')));
        }

        $this->data['view'] = 'login';
        $this->load->view('layouts/template', $this->data);
    }

    public function sign_up()
    {
        $posted_data = $this->request;

        $this->form_validation->set_rules('first_name', trans('first_name'), 'required');
        $this->form_validation->set_rules('last_name', trans('last_name'), 'required');
        $this->form_validation->set_rules('email', trans('email'), 'trim|required|valid_email|callback_check_email_unique');
        $this->form_validation->set_rules('mobile', trans('mobile'), 'trim|required|numeric');
        $this->form_validation->set_rules('password', trans('password'), 'trim|required');
        $this->form_validation->set_rules('confirm_password', trans('reenter_password'), 'trim|required|matches[password]');
        if ($this->form_validation->run() == false) {
            $this->error_response(validation_errors());
        }

        unset($posted_data['confirm_password']);
        $posted_data['password'] = md5($posted_data['password']);

        $posted_data['status'] = 0; // as initially, the account will be inactive

        $id = $this->User_model->insert($posted_data);
        if ($id > 0) {

            // Sending account activation email to user
            $message = 'Dear ' . $posted_data['first_name'] . ' ' . $posted_data['last_name'] . ',<br>';
            $message .= 'Your account has been created with us. Please click the below link to activate your account.<br>';
            $message .= '<a href="' . base_url('user/activate/' . base64_encode($id)) . '">Activate Your Account</a>';
            send_mail('Account Confirmation', $message, $posted_data['email']);

            $this->session->set_flashdata('is_manual_signup', 1); // show account activation message at thank you page

            //$this->success_response(trans('account_activation_email_sent'), ['redirect' => true, 'redirect_to' => base_url('thank-you')]);
            $this->success_response(trans('account_activation_email_sent'));
        } else {
            $this->error_response(trans('something_went_wrong'));
        }
    }

    public function login()
    {
        $posted_data = $this->request;

        $this->form_validation->set_rules('email', trans('email'), 'trim|required|valid_email');
        $this->form_validation->set_rules('password', trans('password'), 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->error_response(validation_errors());
        }

        $user = $this->User_model->where('email', $posted_data['email'])->where('password', md5($posted_data['password']))->where('status', 1)->get();
        if ($user) {
            $this->session->set_userdata('user', $user);
            $address = $this->Address_model->where('user_id', $user->id)->get();
            $this->success_response(trans('logged_in_successfully'), ['redirect' => true, 'redirect_to' => ($address ? base_url('address/manage') : base_url('address/add'))]);
        } else {
            $this->error_response(trans('incorrect_username_or_password'));
        }
    }

    public function forget_password()
    {
        $posted_data = $this->request;

        $this->form_validation->set_rules('email', trans('email'), 'trim|required|valid_email');
        if ($this->form_validation->run() == false) {
            $this->error_response(validation_errors());
        }

        $user = $this->User_model->get(['email' => $posted_data['email']]);
        if ($user) {

            // Sending account activation email to user
            $message = 'Dear ' . $user->first_name . ' ' . $user->last_name . ',<br>';
            $message .= 'A password change request is initiated for your account. Please click the below link to change your account password.<br>';
            $message .= '<a href="' . base_url('user/change_password/' . base64_encode($user->id)) . '">Change Password</a>';
            send_mail('Forget Password', $message, $posted_data['email']);

            $this->success_response(trans('forget_password_email_sent'));
        } else {
            $this->error_response(trans('no_account_exists_with_this_email'));
        }
    }

    public function change_password($user_id)
    {
        $user_id = base64_decode($user_id);
        $user = $this->User_model->get(['id' => $user_id]);
        if ($user) {
            $this->data['user_id'] = base64_encode($user_id);
            $this->data['view'] = 'change-password';
            $this->load->view('layouts/template', $this->data);
        } else {
            $this->session->set_flashdata('error', trans('something_went_wrong'));
            redirect(base_url());
        }
    }

    public function update_password()
    {
        $posted_data = $this->request;

        $this->form_validation->set_rules('password', trans('password'), 'trim|required');
        $this->form_validation->set_rules('confirm_password', trans('reenter_password'), 'trim|required|matches[password]');
        if ($this->form_validation->run() == false) {
            $this->error_response(validation_errors());
        }

        $user_id = base64_decode($posted_data['user_id']);

        unset($posted_data['confirm_password'], $posted_data['user_id']);

        $posted_data['password'] = md5($posted_data['password']);

        $this->User_model->update($posted_data, ['id' => $user_id]);
        $this->session->set_flashdata('success', trans('account_password_updated_successfully'));
        $this->success_response(trans('account_password_updated_successfully'), ['redirect' => true, 'redirect_to' => base_url()]);
    }

    public function activate($id)
    {
        $id = base64_decode($id);
        $user = $this->User_model->get($id);
        if ($user) {
            if ($user->status == 0) {
                $this->User_model->update(['status' => 1], ['id' => $id]);
                $this->session->set_flashdata('success', trans('account_activated_successfully'));
                redirect(base_url());
            } elseif ($user->status == 1) {
                $this->session->set_flashdata('error', trans('account_already_active'));
                redirect(base_url());
            }
        } else {
            $this->session->set_flashdata('error', trans('something_went_wrong'));
            redirect(base_url());
        }
    }

    public function logout()
    {
        $config = $this->config->item('social_logins');
        $hybridauth = new Hybridauth($config);
        $hybridauth->disconnectAllAdapters();

        $this->session->unset_userdata('user');
        $this->session->set_flashdata('success', trans('logged_out_successfully'));
        redirect(base_url());
    }

    public function update_profile()
    {
        $posted_data = $this->request;

        $user = $this->User_model->get($posted_data['id']);

        $this->form_validation->set_rules('first_name', trans('first_name'), 'required');
        $this->form_validation->set_rules('last_name', trans('last_name'), 'required');

        if ($posted_data['email'] != $user->email) {
            $is_email_unique = '|callback_check_email_unique';
        } else {
            $is_email_unique = '';
        }

        $this->form_validation->set_rules('email', trans('email'), 'trim|required|valid_email' . $is_email_unique);
        $this->form_validation->set_rules('mobile', trans('mobile'), 'trim|required|numeric');

        // if current password is coming, then validating new password and confirm new password fields
        if ($posted_data['current_password']) {
            $this->form_validation->set_rules('current_password', trans('current_password'), 'callback_current_password_check['.$posted_data['id'].']');
            $this->form_validation->set_rules('new_password', trans('new_password'), 'trim|required');
            $this->form_validation->set_rules('confirm_password', trans('reenter_new_password'), 'trim|required|matches[new_password]');
        }

        if ($this->form_validation->run() == false) {
            $this->error_response(validation_errors());
        }

        // if new password is coming then updating it
        if ($posted_data['new_password']) {
            $posted_data['password'] = md5($posted_data['new_password']);
        }

        $id = $posted_data['id'];
        unset($posted_data['id'], $posted_data['current_password'], $posted_data['new_password'], $posted_data['confirm_password']);

        $this->User_model->update($posted_data, ['id' => $id]);

        $user = $this->User_model->where('id', $id)->get();
        $this->session->set_userdata('user', $user);

        $this->success_response(trans('profile_updated_successfully'), ['redirect' => true]);
    }

    public function current_password_check($submitted_current_password, $user_id) {
        $user = $this->User_model->get($user_id);
        if ($user->password != md5($submitted_current_password))
        {
            $this->form_validation->set_message('current_password_check', 'The Current Password you provided does not match your existing password.');
            return false;
        }

        return true;
    }

    public function check_email_unique($submitted_email) {
        $user = $this->User_model->get(['email' => $submitted_email]);
        if ($user)
        {
            $this->form_validation->set_message('check_email_unique', trans('email_already_exists'));
            return false;
        }

        return true;
    }

    public function thank_you(){
        $this->load->view('thank-you', $this->data);
    }
}
