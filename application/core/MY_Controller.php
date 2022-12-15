<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        ini_set('display_errors', 'off');
    }

    function render_page_auth($content, $data = NULL)
    {
        $data['header']         = $this->load->view('pos/auth/header', $data, TRUE);
        $data['content']        = $this->load->view($content, $data, TRUE);
        $data['footer']         = $this->load->view('pos/auth/footer', $data, TRUE);

        $this->load->view('pos/auth/index', $data);
    }

    function render_page($content, $data = NULL)
    {
        $data['header']         = $this->load->view('main/header', $data, TRUE);
        // $data['sidebar']        = $this->load->view('main/sidebar', $data, TRUE);
        $data['navbar']         = $this->load->view('main/navbar', $data, TRUE);
        $data['content']        = $this->load->view($content, $data, TRUE);
        $data['modal']          = $this->load->view('main/modal', $data, TRUE);
        $data['footer']         = $this->load->view('main/footer', $data, TRUE);

        $this->load->view('main/index', $data);
    }
}
