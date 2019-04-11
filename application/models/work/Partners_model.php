<?php

class Partners_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    /*
     * Partnerek kinyerese adatbazisbol
     */
    public function get_partners($id = FALSE)
    {
        if ($id == FALSE) {
            $query = $this->db->get('partner');

            return $query->result_array();
        }

        $query = $this->db->get_where('partner', array('id' => $id));

        return $query->row_array();
    }

    /*
     * Partnerhez kapcsolodo elvegzett oraszamok kinyerese adatbazisbol
     */
    public function get_work_hours($id)
    {
        $this->db->select_sum('oraszam');
        $this->db->from('elvegzett');
        $this->db->join('feladat', 'feladat.id = elvegzett.feladat');
        $this->db->where('partner', $id);
        $query = $this->db->get();

        return $query->row_array();
    }

    /*
     * Feladatok szama, osszesen es statusztol fuggoen, partnerenkent
     */
    public function get_job_amount_all($id)
    {
        $this->db->count_all_results('feladat');
        $this->db->from('feladat');
        $this->db->where('partner', $id);
        $query = $this->db->count_all_results();

        return $query;
    }

    public function get_job_amount_inactive($id)
    {
        $this->db->count_all_results('feladat');
        $this->db->from('feladat');
        $this->db->where('partner', $id);
        $this->db->where('statusz', "inaktív");
        $query = $this->db->count_all_results();

        return $query;
    }

    public function get_job_amount_active($id)
    {
        $this->db->count_all_results('feladat');
        $this->db->from('feladat');
        $this->db->where('partner', $id);
        $this->db->where('statusz', "folyamatban");
        $query = $this->db->count_all_results();

        return $query;
    }

    public function get_job_amount_finished($id)
    {
        $this->db->count_all_results('feladat');
        $this->db->from('feladat');
        $this->db->where('partner', $id);
        $this->db->where('statusz', "kész");
        $query = $this->db->count_all_results();

        return $query;
    }


    /*
     * Partner felvitele adatbazisba
     */
    public function set_partners()
    {
        $this->load->helper('url');

        $data = array(
            'nev' => $this->input->post('nev'),
            'cim' => $this->input->post('cim'),
            'email' => $this->input->post('email'),
            'telefon' => $this->input->post('telefon'),
        );

        return $this->db->insert('partner', $data);
    }

    /*
     * Partner adatainak modositasa adatbazisban
     */
    public function update_partners($id)
    {
        $this->load->helper('url');

        $data = array(
            'nev' => $this->input->post('nev'),
            'cim' => $this->input->post('cim'),
            'email' => $this->input->post('email'),
            'telefon' => $this->input->post('telefon'),
        );

        $this->db->where('id', $id);

        return $this->db->update('partner', $data);
    }
}