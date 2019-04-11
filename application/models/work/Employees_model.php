<?php

class Employees_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    /*
     * Dolgozok kinyerese adatbazisbol
     */
    public function get_employees($id = FALSE)
    {
        if ($id == FALSE) {
            $query = $this->db->get('dolgozo');
            return $query->result_array();
        }

        $query = $this->db->get_where('dolgozo', array('id' => $id));
        return $query->row_array();
    }

    /*
     * Dolgozohoz kapcsolodo oraszam kinyerese
     */
    public function get_work_hours($id)
    {
        $this->db->select_sum('oraszam');
        $query = $this->db->get_where('elvegzett', array('dolgozo' => $id));
        return $query->row_array();
    }

    /*
     * Dolgozo altal elvegzett feladatok szamanak kinyerese
     */
    public function get_job_amount($id)
    {
        $this->db->count_all_results('elvegzett');
        $this->db->where('dolgozo', $id);
        $this->db->from('elvegzett');
        $query = $this->db->count_all_results();
        return $query;
    }

    /*
     * Dolgozo felvitele adatbazisba
     */
    public function set_employees()
    {
        $this->load->helper('url');

        $data = array(
            'nev' => $this->input->post('nev'),
            'beosztas' => $this->input->post('beosztas'),
            'email' => $this->input->post('email'),
            'telefon' => $this->input->post('telefon'),
        );

        return $this->db->insert('dolgozo', $data);
    }

    /*
     * Dolgoz adatainak modositasa adatbazisban
     */
    public function update_employees($id)
    {
        $this->load->helper('url');

        $data = array(
            'nev' => $this->input->post('nev'),
            'beosztas' => $this->input->post('beosztas'),
            'email' => $this->input->post('email'),
            'telefon' => $this->input->post('telefon'),
        );

        $this->db->where('id', $id);
        return $this->db->update('dolgozo', $data);
    }
}