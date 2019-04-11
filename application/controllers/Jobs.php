<?php

class Jobs extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('work/jobs_model');
        $this->load->helper('url_helper');
    }

    /*
     * Osszes feladat listazasa
     */
    public function index()
    {
        $data['title'] = 'Feladatok';
        $data['jobs'] = $this->jobs_model->get_jobs();
        $data['finished'] = $this->jobs_model->get_finished_jobs();

        /*
         * Segito fuggvenyek kulonbozo feladattipusok megszamlalasara a statisztikahoz
         */
        $data['jobs_active'] = $this->jobs_model->get_active_jobs_num();
        $data['jobs_all'] = $this->jobs_model->get_all_jobs_num();
        $data['jobs_finished'] = $this->jobs_model->get_finished_jobs_num();
        $data['jobs_inactive'] = $this->jobs_model->get_inactive_jobs_num();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu');
        $this->load->view('work/jobs/index', $data);
        $this->load->view('templates/footer');
    }

    /*
     * Elvegzett feladatok listazasa
     */
    public function finished()
    {
        $data['title'] = 'Elvégzett feladatok';
        $data['jobs'] = $this->jobs_model->get_finished_jobs();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu');
        $this->load->view('work/jobs/finished', $data);
        $this->load->view('templates/footer');
    }

    /*
     * Kivalasztott feladat reszletes adatai
     */
    public function details($id = NULL)
    {
        $data['jobs'] = $this->jobs_model->get_jobs($id);
        $data['title'] = '"' . $data['jobs']['megnevezes'] . '" feladat részletes adatai';
        $data['partners'] = $this->jobs_model->get_partner_names($data['jobs']['partner']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu');
        $this->load->view('work/jobs/details', $data);
        $this->load->view('templates/footer');
    }

    /*
     * Uj feladat letrehozasa
     */
    public function create()
    {
        $this->load->helper('form');
        $this->load->helper('url_helper');
        $this->load->library('form_validation');

        $data['title'] = 'Új feladat hozzádása';
        $data['partners'] = $this->jobs_model->get_partner_names();

        /*
         * CI beepitett validalasahoz szabalyok
         */
        $this->form_validation->set_rules('megnevezes', 'Megnevezés', 'required');
        $this->form_validation->set_rules('leiras', 'Leírás', 'required');
        $this->form_validation->set_rules('partner', 'Partner', 'required');
        $this->form_validation->set_rules('statusz', 'Státusz', 'required');

        /*
         * Csak ervenyes adatok keruljenek be
         */
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu');
            $this->load->view('work/jobs/create', $data);
            $this->load->view('templates/footer');
        } else {
            $this->jobs_model->set_jobs();
            redirect('jobs');
        }
    }

    /*
     * Meglevo, meg nem elvegzett feladat adatainak modositasa
     */
    public function update($id)
    {
        $this->load->helper('form');
        $this->load->helper('url_helper');
        $this->load->library('form_validation');

        $data['title'] = 'Feladat adatainak módosítása';
        $data['jobs'] = $this->jobs_model->get_jobs($id);
        $data['partners'] = $this->jobs_model->get_partner_names();

        /*
         * CI beepitett validalasahoz szabalyok
         */
        $this->form_validation->set_rules('megnevezes', 'Megnevezés', 'required');
        $this->form_validation->set_rules('leiras', 'Leírás', 'required');
        $this->form_validation->set_rules('partner', 'Partner', 'required');
        $this->form_validation->set_rules('statusz', 'Státusz', 'required');

        /*
         * Csak ervenyes adatok keruljenek be
         */
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu');
            $this->load->view('work/jobs/update');
            $this->load->view('templates/footer');

        } else {
            $this->jobs_model->update_jobs($id);
            redirect('jobs');
        }
    }

    /*
     * Meglevo, befejezett feladat adatainak modositasa
     */
    public function update_finished($id)
    {
        $this->load->helper('form');
        $this->load->helper('url_helper');
        $this->load->library('form_validation');

        $data['title'] = 'Elvégzett munka adatainak módosítása';
        $data['jobs'] = $this->jobs_model->get_finished_jobs($id);
        $data['employees'] = $this->jobs_model->get_employee_names();

        /*
         * CI beepitett validalasahoz szabalyok
         */
        $this->form_validation->set_rules('dolgozo', 'Dolgozó', 'required');
        $this->form_validation->set_rules('oraszam', 'Óraszám', 'required');

        /*
         * Csak ervenyes adatok keruljenek be
         */
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu');
            $this->load->view('work/jobs/update_finished', $data);
            $this->load->view('templates/footer');
        } else {
            $this->jobs_model->update_finished_jobs($id);
            redirect('jobs/finished');
        }
    }

    /*
     * Meglevo, meg nem befejezett feladat elvegzettnek jelolese
     */
    public function finalize($id)
    {
        $this->load->helper('form');
        $this->load->helper('url_helper');
        $this->load->library('form_validation');

        $data['title'] = 'Munka elvégzettnek jelölése';
        $data['jobs'] = $this->jobs_model->get_jobs($id);
        $data['employees'] = $this->jobs_model->get_employee_names();

        /*
         * CI beepitett validalasahoz szabalyok
         */
        $this->form_validation->set_rules('dolgozo', 'Dolgozó', 'required');
        $this->form_validation->set_rules('oraszam', 'Óraszám', 'required');

        /*
         * Csak ervenyes adatok keruljenek be
         */
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu');
            $this->load->view('work/jobs/finalize');
            $this->load->view('templates/footer');
        } else {
            $this->jobs_model->finalize_jobs($id);
            redirect('jobs');
        }
    }
}