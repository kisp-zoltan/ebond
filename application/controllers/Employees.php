<?php

class Employees extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('work/employees_model');
        $this->load->helper('url_helper');
    }

    /*
     * Kezdooldal, dolgozok listazasa
     */
    public function index()
    {
        $data['title'] = 'Dolgozók';
        $data['employees'] = $this->employees_model->get_employees();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu');
        $this->load->view('work/employees/index', $data);
        $this->load->view('templates/footer');
    }

    /*
     * Kivalasztott dolgozo reszletes adatai
     */
    public function details($id = NULL)
    {
        $data['employees'] = $this->employees_model->get_employees($id);
        $data['title'] = $data['employees']['nev'] . ' részletes adatai';
        $data['hours'] = $this->employees_model->get_work_hours($id);
        $data['jobs'] = $this->employees_model->get_job_amount($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu');
        $this->load->view('work/employees/details', $data);
        $this->load->view('templates/footer');
    }

    /*
     * Uj dolgozo hozzadasa
     */
    public function create()
    {
        $this->load->helper('form');
        $this->load->helper('url_helper');
        $this->load->library('form_validation');

        $data['title'] = 'Új dolgozó hozzádása';

        /*
         * CI beepitett validalasi szabalyai
         */
        $this->form_validation->set_rules('nev', 'Név', 'required');
        $this->form_validation->set_rules('beosztas', 'Beosztás', 'required');
        $this->form_validation->set_rules('email', 'E-mail', 'required');
        $this->form_validation->set_rules('telefon', 'Telefon', 'required');

        /*
         * Csak ervenyes form legyen bekuldve
         */
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu');
            $this->load->view('work/employees/create');
            $this->load->view('templates/footer');
        } else {
            $this->employees_model->set_employees();
            redirect('employees');
        }
    }

    /*
     * Meglevo dolgozo adatainak frissitese
     */
    public function update($id)
    {
        $this->load->helper('form');
        $this->load->helper('url_helper');
        $this->load->library('form_validation');

        $data['title'] = 'Dolgozó adatainak módosítása';
        $data['employees'] = $this->employees_model->get_employees($id);

        /*
         * CI beepitett validalasi szabalyai
         */
        $this->form_validation->set_rules('nev', 'Név', 'required');
        $this->form_validation->set_rules('beosztas', 'Beosztás', 'required');
        $this->form_validation->set_rules('email', 'E-mail', 'required');
        $this->form_validation->set_rules('telefon', 'Telefon', 'required');

        /*
         * Csak ervenyes form legyen bekuldve
         */
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu');
            $this->load->view('work/employees/update');
            $this->load->view('templates/footer');
        } else {
            $this->employees_model->update_employees($id);
            redirect('employees');
        }
    }
}