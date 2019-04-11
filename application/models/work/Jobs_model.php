<?php

class Jobs_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    /*
     * Feladatok kinyerese adatbazisbol
     */
    public function get_jobs($id = FALSE)
    {
        if ($id == FALSE) {
            $query = $this->db->get('feladat');

            return $query->result_array();
        }

        $query = $this->db->get_where('feladat', array('id' => $id));

        return $query->row_array();
    }

    /*
     * Feladatok felvitele adatbazisba
     */
    public function set_jobs()
    {
        $this->load->helper('url');

        $data = array(
            'megnevezes' => $this->input->post('megnevezes'),
            'leiras' => $this->input->post('leiras'),
            'partner' => $this->input->post('partner'),
            'statusz' => $this->input->post('statusz'),
        );

        return $this->db->insert('feladat', $data);
    }

    /*
     * Formokhoz szukseges partner id-k es nevek kinyerese adatbazisbol
     */
    public function get_partner_names($id = FALSE)
    {
        if ($id == FALSE) {
            $this->db->select('id, nev');
            $query = $this->db->get('partner');

            return $query->result_array();
        }

        $this->db->select('id, nev');
        $query = $this->db->get_where('partner', array('id' => $id));

        return $query->row_array();
    }

    /*
     * Formokhoz szukseges dolgozonevek kinyerese adatbazisbol
     */
    public function get_employee_names($id = FALSE)
    {
        if ($id == FALSE) {
            $this->db->select('id, nev');
            $query = $this->db->get('dolgozo');

            return $query->result_array();
        }

        $this->db->select('nev');
        $query = $this->db->get_where('dolgozo', array('id' => $id));

        return $query->row_array();
    }

    /*
     * Nem elvegzett feladatok modositasa adatbazisban
     */
    public function update_jobs($id)
    {
        $this->load->helper('url');

        $data = array(
            'megnevezes' => $this->input->post('megnevezes'),
            'leiras' => $this->input->post('leiras'),
            'partner' => $this->input->post('partner'),
            'statusz' => $this->input->post('statusz'),
        );

        $this->db->where('id', $id);

        return $this->db->update('feladat', $data);
    }

    /*
     * Elvegzett feladatok modositasa adatbazisban
     */
    public function update_finished_jobs_num($id)
    {
        $this->load->helper('url');

        $data = array(
            'dolgozo' => $this->input->post('dolgozo'),
            'oraszam' => $this->input->post('oraszam')
        );

        $this->db->where('id', $id);

        return $this->db->update('elvegzett', $data);
    }

    /*
     * Elvegzett feladatok kinyerese adatbazisbol, a szukseges adatokkal egyutt
     */
    public function get_finished_jobs($id = FALSE)
    {
        if ($id == FALSE) {
            $this->db->get_where('feladat', array('statusz' => 'kész'));
            $this->db->from('feladat');
            $this->db->join('elvegzett', 'feladat.id = elvegzett.feladat');
            $this->db->join('dolgozo', 'elvegzett.dolgozo = dolgozo.id');

            $query = $this->db->get();

            return $query->result_array();
        }

        $query = $this->db->get_where('elvegzett', array('dolgozo' => $id));

        return $query->row_array();
    }

    /*
     * Statisztikahoz feladatok szamolasa - inaktiv
     */
    public function get_inactive_jobs_num()
    {
        $this->db->count_all_results('feladat');
        $this->db->where('statusz', 'inaktív');
        $this->db->from('feladat');
        $query = $this->db->count_all_results();

        return $query;
    }

    /*
     * Statisztikahoz feladatok szamolasa - aktiv
     */
    public function get_active_jobs_num()
    {
        $this->db->count_all_results('feladat');
        $this->db->where('statusz', 'folyamatban');
        $this->db->from('feladat');
        $query = $this->db->count_all_results();

        return $query;
    }

    /*
     * Statisztikahoz feladatok szamolasa - kesz
     */
    public function get_finished_jobs_num()
    {
        $this->db->count_all_results('feladat');
        $this->db->where('statusz', 'kész');
        $this->db->from('feladat');
        $query = $this->db->count_all_results();

        return $query;
    }

    /*
     * Statisztikahoz feladatok szamolasa - osszes
     */
    public function get_all_jobs_num()
    {
        $this->db->count_all_results('feladat');
        $this->db->from('feladat');
        $query = $this->db->count_all_results();

        return $query;
    }

    /*
     * Feladat elvegzettnek jelolese adatbazisban
     */
    public function finalize_jobs($id = FALSE)
    {
        $this->load->helper('url');

        $data = array(
            'feladat' => $this->input->post('feladat'),
            'dolgozo' => $this->input->post('dolgozo'),
            'oraszam' => $this->input->post('oraszam')
        );

        return $this->db->insert('elvegzett', $data);
    }
}