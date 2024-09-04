<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Address_url extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Address_model', 'Address_url_model']);
        mark_address_urls_as_expired();
    }

    public function index()
    {
        $posted_data = $this->request;
        echo $this->get_addresses_html($posted_data['address_id']);
    }

    public function generate()
    {
        $posted_data = $this->request;
        $posted_data['url_slug'] = $this->generate_address_url_slug();
        $posted_data['created_at'] = date('Y-m-d H:i:s');
        $posted_data['expires_at'] = date('Y-m-d H:i:s', strtotime("+ 2 days"));
        $posted_data['status'] = 1;
        $this->Address_url_model->insert($posted_data);
        echo $this->get_addresses_html($posted_data['address_id']);
    }

    private function get_addresses_html($address_id)
    {
        $address_urls = $this->Address_url_model->get_all(['address_id' => $address_id, 'status' => 1]);
        $html = '<table class="table table-striped">';
        if ($address_urls) {
            $html .= '<thead><th>#</th><th>' . trans('address_url') . '</th><th>' . trans('expires_at') . '</th><th>' . trans('actions') . '</th></thead>';
            $i = 1;
            foreach ($address_urls as $address_url) {
                $html .= '<tr>
                            <td>' . $i . '</td>
                            <td style="word-break: break-all;"><a target="_blank" style="color: inherit;" href="' . route('share', [$address_url->url_slug]) . '">' . route('share', [$address_url->url_slug]) . '</a></td>
                            <td class="has_datetime">' . format_date($address_url->expires_at, true) . '</td>
                            <td>
                                <a href="https://api.whatsapp.com/send?text=' . route('share', [$address_url->url_slug]) . '" title="'.trans('share_address_urls').'" data-action="share/whatsapp/share" target="_blank"><img class="me-3" src="' . base_url('assets/frontend/images/link.svg') . '" alt=""></a>
                                <a href="javascript:void(0);" title="'.trans('copy_address').'"><img class="me-3 copy" data-content="' . route('share', [$address_url->url_slug]) . '" src="' . base_url('assets/frontend/images/copy.svg') . '" alt=""></a>
                                <a href="javascript:void(0);" title="'.trans('delete_address').'" class="delete_address_url" data-id="'.$address_url->id.'"><img class="me-3" src="' . base_url('assets/frontend/images/delete.png') . '" alt=""></a>
                            </td>
                          </tr>';
                $i++;
            }
            $html .= '<tr><td colspan="4" style="text-align: center;"><button class="signin-button btn btn-primary w-50 generate_address_url" data-id="' . $address_id . '">' . trans('generate_another_address') . '</button></td></tr>';
        } else {
            $html .= '<tr><td colspan="4" style="text-align: center;">' . trans('no_address_generated_yet') . '<br><br><button class="signin-button btn btn-primary w-50 generate_address_url" data-id="' . $address_id . '">' . trans('generate_now') . '</button></td></tr>';
        }
        $html .= '</table>';
        return $html;
    }

    public function share_bk($url_slug)
    {
        $address_url = $this->Address_url_model->get(['url_slug' => $url_slug, 'status' => 1]);
        if ($address_url) {
            $this->data['address'] = $this->Address_model->get(['id' => $address_url->address_id]);
            $this->load->view('address/address-detail', $this->data);
        } else {
            show_404();
        }
    }

    public function share($id)
    {
        $id = base64_decode($id);
        $this->data['address'] = $this->Address_model->get(['id' => $id]);
        if ($this->data['address']) {
            $this->load->view('address/address-detail', $this->data);
        } else {
            show_404();
        }
    }

    private function generate_address_url_slug()
    {
        $slug = generate_random_string(8);
        $address_url = $this->Address_url_model->get(['url_slug' => $slug]);
        if ($address_url) {
            $this->generate_address_url_slug();
        }
        return $slug;
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $updated = $this->Address_url_model->update(['status' => 0], ['id' => $id]);
        if ($updated) {
            $this->success_response(trans('address_url_deleted_successfully'));
        } else {
            $this->error_response(trans('something_went_wrong'));
        }
    }

    public function change_language()
    {
        $locale = $this->input->get('locale');
        $uri_string = $this->input->get('uri_string');
        $this->session->set_userdata('locale', $locale);
        $this->session->set_flashdata('success', trans('language_updated_successfully', $locale));
        redirect(base_url($uri_string));
    }
}
