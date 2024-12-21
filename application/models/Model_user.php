<?php

class Model_user extends CI_Model
{
   public function getAlluser()
   {
      $query = "SELECT * from tb_user";
      return $this->db->query($query)->result_array();
   }

   public function insert($data, $table)
   {
      $this->db->insert($table, $data);
   }

   public function insert_register($data, $table)
   {
      $this->db->insert($table, $data);
   }

   public function delete($id)
   {
      $this->db->delete('tb_user', ['id_user' => $id]);
   }

   public function getuserById($id_user)
   {
      return $this->db->get_where('tb_user', ['id_user' => $id_user])->row_array();
   }

   public function updateuser()
   {
      $nama_lengkap = $this->input->post('nama_lengkap');
      $email = $this->input->post('email');
      $username = $this->input->post('username');
      $password = $this->input->post('password');
      $level = $this->input->post('level');

      $data = [
         'email' => $email,
         'nama_lengkap' => $nama_lengkap,
         'username' => $username,
         'password' => $password,
         'level' => $level
      ];

      $this->db->update('tb_user', $data, ['id_user' => $this->input->post('id_user')]);
   }

   public function getprofile($id)
   {
      return $this->db->get_where('tb_user', ['id_user' => $id])->row_array();
   }

   public function get_user_by_email($email)
   {
      return $this->db->get_where('tb_user', ['email' => $email])->row();
   }

   public function save_password_reset_token($user_id, $token)
   {
      $this->db->where('id_user', $user_id); // Pastikan kolom yang benar
      $this->db->update('tb_user', [
         'reset_token' => $token,
         'token_expiry' => date('Y-m-d H:i:s', strtotime('+1 hour')) // Contoh masa berlaku token 1 jam
      ]);
   }

   public function get_user_by_token($token)
   {
      return $this->db->get_where('tb_user', ['reset_token' => $token])->row();
   }

   public function update_password($user_id, $new_password)
   {
      $this->db->where('id_user', $user_id); // Pastikan kolom yang benar
      $this->db->update('tb_user', ['password' => $new_password]);
   }
}
