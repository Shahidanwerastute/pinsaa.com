<?php
require_once APPPATH . 'third_party/hybridauth/src/autoload.php';

use Hybridauth\Hybridauth;

function route($url = "", $params = array(), $query_str_params = array())
{
    $url = base_url($url);
    if (!empty($params)) {
        $url .= '/' . implode('/', $params);
    }
    if (!empty($query_str_params)) {
        $url .= '?' . http_build_query($query_str_params);
    }
    return $url;
}

function trans($key, $locale = false)
{
    $CI = &get_Instance();
    if ($locale) {
        $CI->lang->load('messages', ($CI->session->userdata('locale') == 'ar' ? 'arabic' : 'english'));
    }
    return $CI->lang->line($key);
}

function validation($key)
{
    $CI = &get_Instance();
    $CI->lang->load('form_validation', ($CI->session->userdata('locale') == 'ar' ? 'arabic' : 'english'));
    return $CI->lang->line($key);
}

function format_date($datetime, $has_time = false)
{
    if ($datetime == '' || $datetime == null || strpos($datetime, '0000-00-00') != false) {
        return 'N/A';
    } else {
        if ($has_time) {
            return date('d-M-Y h:i A', strtotime($datetime));
        } else {
            return date('d-M-Y', strtotime($datetime));
        }
    }
}

function check_user_login()
{
    $CI = &get_Instance();
    if (strtolower($CI->router->fetch_class()) == 'address' && !$CI->session->userdata('user')) {
        $CI->session->set_flashdata('error', trans('you_must_be_logged_in_to_continue', true));
        redirect(base_url());
    }
}

function send_mail($subject, $message, $to, $debug = false, $attachment = false)
{
    $CI = &get_instance();
    $to = rtrim(str_replace(' ', '', $to), ',');
    /*$config = [
        'protocol' => 'smtp',
        'smtp_host' => 'localhost',
        'smtp_crypto' => 'none', // none, ssl
        'smtp_port' => 25,
        'smtp_user' => 'info@pinsaa.ced.sa',
        'smtp_pass' => 'y{?*t?qxg3ZA',
        'mailtype' => 'html',
        'charset' => 'utf-8',
    ];*/

    $config = [
        'protocol' => 'smtp',
        'smtp_host' => 'mail.smtp2go.com',
        'smtp_crypto' => 'tls', // none, ssl, tls
        'smtp_port' => 587 ,
        'smtp_user' => 'info@pinsaa.com',
        'smtp_pass' => "6C9Ttt030j2EqBvY",
        'mailtype' => 'html',
        'charset' => 'utf-8',
    ];
    $CI->load->library('email');
    $CI->email->initialize($config);
    $CI->email->set_newline("\r\n");
    $CI->email->from('info@pinsaa.com', 'PINSAA');
    $CI->email->subject($subject . ' | ' . trans('app_name'));
    $CI->email->message($message);
    $CI->email->to($to);
    if ($attachment) {
        $CI->email->attach($attachment);
    }
    $CI->email->send();
    if ($debug) {
        echo $CI->email->print_debugger();
        exit;
    }
}

function last_query()
{
    $ci = get_instance();
    echo $ci->db->last_query();
    exit();
}

function get_x_words($string, $wordsreturned = 10)
{
    $retval = $string;  //  Just in case of a problem
    $array = explode(" ", $string);
    /*  Already short enough, return the whole thing*/
    if (count($array) <= $wordsreturned) {
        $retval = $string;
    } /*  Need to chop of some words*/
    else {
        array_splice($array, $wordsreturned);
        $retval = implode(" ", $array) . " ...";
    }
    return $retval;
}

function v($rand = false)
{
    if ($rand) {
        return rand();
    }
    $CI = &get_Instance();
    return $CI->config->item('assets_version');
}

function get_balance()
{
    $client = new Client();
    $response = $client->Account->GetBalance();
    return $response;
}

function generate_random_string($strength = 16, $only_numbers = false)
{
    if ($only_numbers) {
        $permitted_chars = '123456789';
    } else {
        $permitted_chars = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    }
    $random_string = '';
    for ($i = 0; $i < $strength; $i++) {
        $random_character = $permitted_chars[mt_rand(0, strlen($permitted_chars) - 1)];
        $random_string .= $random_character;
    }

    return $random_string;
}

function status($status)
{

    if ($status == 0) {
        $status = 'In-Active';
    } else if ($status == 1) {
        $status = 'Active';
    }

    return $status;
}

function curl_get($url = '', $data = array())
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url . (!empty($data) ? '?' . http_build_query($data) : ''),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array(
            "accept: application/json",
            "content-type: application/x-www-form-urlencoded"
        ),
    ));

    $response = curl_exec($curl);
    if (curl_error($curl)) {
        return curl_error($curl);
    }
    curl_close($curl);
    $result = json_decode($response);
    return $result;
}

function curl_post($url = '', $data = array())
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_HTTPHEADER => array(
            "accept: application/json",
            "content-type: application/x-www-form-urlencoded"
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($response);
    return $result;
}

function dump_($data, $die = true)
{
    echo "<pre>";
    print_r($data);
    if ($die) die();
}

function echo_($str, $die = true)
{
    echo $str;
    if ($die) die();
}

function debug_($die = true)
{
    echo time();
    if ($die) die();
}

function address_to_copy($address)
{
    $str = trans('appreciated') . "\r\n" . "\r\n";
    $str .= trans('name') . $address->name . "\r\n" . trans('number') . $address->phone . "\r\n" . trans('email') . ': ' . $address->email . "\r\n" . "\r\n";
    if ($address->building_type == 1) {
        $str .= trans('villa_number') . ": " . $address->villa_number . ", " . trans('building_type') . ": " . building_types($address->building_type) . "\r\n" . "\r\n";
    }
    if ($address->building_type == 2) {
        $str .= trans('apartment_number') . ": " . $address->apartment_number . ", " . trans('building_number') . ": " . $address->building_number . ", " . trans('building_type') . ": " . building_types($address->building_type) . "\r\n" . "\r\n";
    }
    if ($address->building_type == 3) {
        $str .= trans('floor_number') . ": " . $address->floor_number . ", " . trans('office_number') . ": " . $address->office_number . ", " . trans('building_type') . ": " . building_types($address->building_type) . "\r\n" . "\r\n";
    }
    if ($address->building_type == 4) {
        $str .= trans('other') . ": " . $address->other . ", " . trans('building_type') . ": " . building_types($address->building_type) . "\r\n" . "\r\n";
    }

    $str .= $address->address . ", " . $address->district . ', ' . $address->city . ', ' . $address->region . ', ' . $address->country . "\r\n" . "\r\n";

    if (!empty($address->building_picture)) {
        $str .= trans('building_pic') . " : " . base_url($address->building_picture) . "\r\n" . "\r\n";
    }
    if (!empty($address->office_picture)) {
        $str .= trans('office_picture') . " : " . base_url($address->office_picture) . "\r\n" . "\r\n";
    }
    if (!empty($address->apartment_picture)) {
        $str .= trans('apartment_pic') . " : " . base_url($address->apartment_picture) . "\r\n" . "\r\n";
    }
    if (!empty($address->villa_picture)) {
        $str .= trans('villa_picture') . " : " . base_url($address->villa_picture) . "\r\n" . "\r\n";
    }
    if ($address->latitude && $address->longitude) {
        $str .= trans('map_link') . " : " . 'http://www.google.com/maps/place/' . $address->latitude . ',' . $address->longitude . "\r\n" . "\r\n";
    }
    if ($address->note) {
        $str .= trans('note') . " : " . $address->note . "\r\n";
    }
    // $str .= "\r\n" . 'https://pinsaa.ced.sa/assets/frontend/images/logo.png';
    return $str;
}

function social_logins()
{
    $CI = &get_Instance();
    $social_logins = [];
    $config = $CI->config->item('social_logins');
    $hybridauth = new Hybridauth($config);
    $adapters = $hybridauth->getConnectedAdapters();
    foreach ($hybridauth->getProviders() as $name) {
        if (!isset($adapters[$name])) {
            $social_logins[] = $name;
        }
    }
    return $social_logins;
}

function user_has_address()
{
    $CI = &get_Instance();
    if (!$CI->session->userdata('user')) {
        return 1;
    }
    $CI->load->model('Address_model');
    $address = $CI->Address_model->where('user_id', $CI->session->userdata('user')->id)->get();
    return ($address ? 1 : 0);
}

function upload_file($file)
{
    $upload_path = 'uploads';
    $CI = &get_Instance();
    $config['upload_path'] = $upload_path;
    $config['allowed_types'] = 'jpeg|jpg|png';
    $config['encrypt_name'] = TRUE;
    // $config['max_size'] = 100;
    // $config['max_width'] = 1024;
    // $config['max_height'] = 768;
    $CI->load->library('upload', $config);

    if (!$CI->upload->do_upload($file)) {
        // return ['status' => false, 'message' => strip_tags($CI->upload->display_errors()) . ' (' . ucfirst(str_replace('_', ' ', $file)) . ')', 'file_name' => ''];
        return ['status' => false, 'message' => strip_tags($CI->upload->display_errors()) . ' (' . ucfirst(str_replace('_', ' ', $file)) . ')', 'file_name' => ''];
    } else {
        return ['status' => true, 'message' => "", 'file_name' => $upload_path . '/' . $CI->upload->data('file_name')];
    }
}

function mark_address_urls_as_expired()
{
    $CI = &get_Instance();
    $CI->load->model('Address_url_model');
    $address_urls = $CI->Address_url_model->get_all(['status' => 1]);
    if ($address_urls) {
        foreach ($address_urls as $address_url) {
            if (strtotime(date('Y-m-d H:i:s')) > strtotime($address_url->expires_at)) {
                $CI->Address_url_model->update(['status' => 0], ['id' => $address_url->id]);
            }
        }
    }
}

function building_types($type = false)
{
    $building_types = [
        1 => trans('villa', true),
        2 => trans('building', true),
        3 => trans('office', true),
        4 => trans('other', true)
    ];

    if ($type) {
        return $building_types[$type];
    }

    return $building_types;
}

function share_address_on_whatsapp_message($url) {
    $message = "استخدم بنسا لمعلومات الموقع كاملة:";
    $message .= "\n";
    $message .= $url . '?locale=ar';
    $message .= "\n\n";
    $message .= "Use Pinsaa for the location information:";
    $message .= "\n";
    $message .= $url . '?locale=en';
    return urlencode($message);
}