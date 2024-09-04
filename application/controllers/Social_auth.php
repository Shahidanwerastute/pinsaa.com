<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/hybridauth/src/autoload.php';

use Hybridauth\Exception\Exception;
use Hybridauth\Hybridauth;
use Hybridauth\HttpClient;
use Hybridauth\Storage\Session;

class Social_auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['User_model', 'Address_model']);
    }

    public function index() {
        try {
            // used library
            // https://hybridauth.github.io/documentation.html

            $config = $this->config->item('social_logins');
            $hybridauth = new Hybridauth($config);
            $storage = new Session();
            $error = false;

            //
            // Event 1: User clicked SIGN-IN link
            //
            if (isset($_GET['provider'])) {
                // Validate provider exists in the $config
                if (in_array($_GET['provider'], $hybridauth->getProviders())) {
                    // Store the provider for the callback event
                    $storage->set('provider', $_GET['provider']);
                } else {
                    $error = $_GET['provider'];
                }
            }

            //
            // Event 2: User clicked LOGOUT link
            //
            if (isset($_GET['logout'])) {
                if (in_array($_GET['logout'], $hybridauth->getProviders())) {
                    // Disconnect the adapter
                    $adapter = $hybridauth->getAdapter($_GET['logout']);
                    $adapter->disconnect();
                } else {
                    $error = $_GET['logout'];
                }
            }

            //
            // Handle invalid provider errors
            //
            if ($error) {
                error_log('Hybridauth Error: Provider ' . json_encode($error) . ' not found or not enabled in $config');
                // Close the pop-up window
                echo "
            <script>
                if (window.opener.closeAuthWindow) {
                    window.opener.closeAuthWindow();
                }
            </script>";
                exit;
            }

            //
            // Event 3: Provider returns via CALLBACK
            //
            if ($provider = $storage->get('provider')) {

                $hybridauth->authenticate($provider);
                $storage->set('provider', null);

                // Retrieve the provider record
                $adapter = $hybridauth->getAdapter($provider);
                $userProfile = $adapter->getUserProfile();
                $accessToken = $adapter->getAccessToken();

                // check here if email exists then login and take to address page
                //if not already exists then do signup, mark status as active (without email confirmation), login and take to address page

                $user = $this->User_model->where('email', $userProfile->email)->get();
                if ($user) {
                    $this->User_model->update(['status' => 1], ['id' => $user->id]);
                    $this->session->set_userdata('user', $user);
                    $address = $this->Address_model->where('user_id', $user->id)->get();
                    $this->session->set_flashdata('success', trans('logged_in_successfully'));
                    //redirect($address ? base_url('address/manage') : base_url('address/add'));
                    $this->session->set_flashdata('redirect_url', ($address ? base_url('address/manage') : base_url('address/add')));
                } else {
                    $posted_data['first_name'] = $userProfile->firstName;
                    $posted_data['last_name'] = $userProfile->lastName;
                    $posted_data['email'] = $userProfile->email;
                    $posted_data['status'] = 1;
                    //$this->User_model->insert($posted_data);
                    //redirect(base_url('thank-you'));
                    $id = $this->User_model->insert($posted_data);
                    $user = $this->User_model->get($id);
                    $this->session->set_userdata('user', $user);
                    $address = $this->Address_model->where('user_id', $user->id)->get();
                    $this->session->set_flashdata('success', trans('logged_in_successfully'));
                    $this->session->set_flashdata('redirect_url', ($address ? base_url('address/manage') : base_url('address/add')));

                }
                $redirect_url = $this->session->flashdata('redirect_url');
                redirect($redirect_url);
            }

        } catch (Exception $e) {
            error_log($e->getMessage());
            echo $e->getMessage();
        }
    }
}
