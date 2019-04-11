<?php

class Partners extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('work/partners_model');
        $this->load->helper('url_helper');
    }

    /*
     * Partnerek listazasa
     */
    public function index()
    {
        $data['title'] = 'Partnerek';
        $data['partners'] = $this->partners_model->get_partners();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu');
        $this->load->view('work/partners/index', $data);
        $this->load->view('templates/footer');
    }

    /*
     * Kivalasztott partner reszletes adatai
     */
    public function details($id = NULL)
    {
        $data['partners'] = $this->partners_model->get_partners($id);
        $data['title'] = $data['partners']['nev'] . ' részletes adatai';
        $data['hours'] = $this->partners_model->get_work_hours($id);

        /*
         * Partnerhez kapcsolodo, kulonbozo allapotu feladatok szamlalasat segito fuggvenyek
         */
        $data['jobs_active'] = $this->partners_model->get_job_amount_active($id);
        $data['jobs_all'] = $this->partners_model->get_job_amount_all($id);
        $data['jobs_inactive'] = $this->partners_model->get_job_amount_inactive($id);
        $data['jobs_finished'] = $this->partners_model->get_job_amount_finished($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu');
        $this->load->view('work/partners/details', $data);
        $this->load->view('templates/footer');
    }

    /*
     * Uj partner letrehozasa
     */
    public function create()
    {
        $this->load->helper('form');
        $this->load->helper('url_helper');
        $this->load->library('form_validation');

        $data['title'] = 'Új partner hozzádása';

        /*
         * CI beepitett validalasahoz szabalyok
         */
        $this->form_validation->set_rules('nev', 'Név', 'required');
        $this->form_validation->set_rules('cim', 'Cím', 'required');
        $this->form_validation->set_rules('email', 'E-mail', 'required');
        $this->form_validation->set_rules('telefon', 'Telefon', 'required');

        /*
         * Csak ervenyes adatok keruljenek be
         */
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu');
            $this->load->view('work/partners/create');
            $this->load->view('templates/footer');
        } else {
            $this->partners_model->set_partners();
            redirect('partners');
        }
    }

    /*
     * Meglevo partner adatainak modositasa
     */
    public function update($id)
    {
        $this->load->helper('form');
        $this->load->helper('url_helper');
        $this->load->library('form_validation');

        $data['title'] = 'Partner adatainak módosítása';
        $data['partners'] = $this->partners_model->get_partners($id);

        /*
         * CI beepitett validalasahoz szabalyok
         */
        $this->form_validation->set_rules('nev', 'Név', 'required');
        $this->form_validation->set_rules('cim', 'Cím', 'required');
        $this->form_validation->set_rules('email', 'E-mail', 'required');
        $this->form_validation->set_rules('telefon', 'Telefon', 'required');

        /*
         * Csak ervenyes adatok keruljenek be
         */
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu');
            $this->load->view('work/partners/update');
            $this->load->view('templates/footer');
        } else {
            $this->partners_model->update_partners($id);
            redirect('partners');
        }
    }
}