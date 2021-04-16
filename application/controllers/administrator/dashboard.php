<?php

class Dashboard extends CI_Controller
{
    function _template($data)
    {
        $this->load->view('template/main', $data);
    }

    public function index()
    {

        $ajax = $this->input->get_post("ajax");
        if ($ajax == "yes") {
            echo    $this->load->view("administrator/dashboard");
        } else {
            $data['konten'] = "administrator/dashboard";
            $this->_template($data);
        }
    }
    public function tes()
    {

        $ajax = $this->input->get_post("ajax");
        if ($ajax == "yes") {
            echo    $this->load->view("administrator/tes");
        } else {
            $data['konten'] = "administrator/tes";
            $this->_template($data);
        }
    }
}
