<?php

class User_model extends CI_Model
{
    public function register()
    {
        $data = [
            'name' => $this->input->post('name', true),
            'email' => $this->input->post('email', true),
            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'is_active' => 1,
            'date_created' => time()
        ];
        $this->db->insert('users', $data);
    }

    public function getUserByEmail($email)
    {
        return $this->db->get_where('users', ['email' => $email])->row_array();
    }

    public function getAllUser()
    {
        return $this->db
            ->order_by('id_user', 'asc')
            ->get('users')
            ->result_array();
    }

    public function addUser($data)
    {
        $this->db->insert('users', $data);
    }

    public function editUser($data, $id)
    {
        $this->db->where('id_user', $id)->update('users', $data);
    }

    public function delUser($id)
    {
        return $this->db->delete('users', ['id_user' => $id]);
    }

    public function countAllUser()
    {
        return $this->db->from('users')->count_all_results();
    }
}
