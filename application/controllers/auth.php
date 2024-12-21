<?php

class auth extends CI_Controller
{
   public function index()
   {
      if (!$this->session->userdata('email')) {

         $data = [
            'title' => 'Login'
         ];
         $this->load->view('login_templates/header', $data);
         $this->load->view('auth/login');
         $this->load->view('login_templates/footer');
      } else {
         redirect('dashboard');
      }
   }

   public function login()
   {
      $email = $this->input->post('email');
      $password = $this->input->post('password');

      $user = $this->db->get_where('tb_user', ['email' => $email])->row_array();

      if ($user) {
         if ($user['password'] == $password) {
            // Cek apakah pengguna telah memverifikasi email
            if ($user['is_verified'] == 1) {
               $data = [
                  'id_user' => $user['id_user'],
                  'email' => $user['email'],
                  'nama_lengkap' => $user['nama_lengkap'],
                  'level' => $user['level']
               ];
               $this->session->set_userdata($data);
               redirect('dashboard');
            } else {
               // Jika belum terverifikasi, redirect dengan pesan
               $this->session->set_flashdata('message', 'Silakan verifikasi email Anda sebelum login.');
               redirect('auth');
            }
         } else {
            // Jika password salah
            $this->session->set_flashdata('message', 'Password salah, coba lagi.');
            redirect('auth');
         }
      } else {
         // Jika email tidak ditemukan
         $this->session->set_flashdata('message', 'Email tidak ditemukan.');
         redirect('auth');
      }
   }


   public function logout()
   {
      $this->session->unset_userdata('email');
      $this->session->unset_userdata('password');

      redirect('auth');
   }
}
