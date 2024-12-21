<?php

class user extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->load->model('Model_user');
   }

   public function index()
   {
      $data = [
         'title' => 'Data User'
      ];
      $data['user'] = $this->Model_user->getAlluser();
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar');
      $this->load->view('user/user', $data);
      $this->load->view('templates/footer');
   }

   public function tambahuser()
   {
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $nama_lengkap = $this->input->post('nama_lengkap');
      $level = $this->input->post('level');
      $data = [
         'email' => $email,
         'nama_lengkap' => $nama_lengkap,
         'password' => $password,
         'level' => $level
      ];
      $this->Model_user->insert($data, 'tb_user');
      redirect('user/user');
   }

   public function hapususer($id)
   {
      $this->Model_user->delete($id);
      redirect('user/user');
   }

   public function edituser($id_user)
   {
      $data['title'] = 'Edit';
      $data['user'] = $this->Model_user->getuserById($id_user);
      $this->form_validation->set_rules('id_user', 'id_user', 'required');
      $this->form_validation->set_rules('email', 'email', 'required');
      if ($this->form_validation->run() == false) {
         $this->load->view('templates/header', $data);
         $this->load->view('templates/sidebar');
         $this->load->view('user/edit_user', $data);
         $this->load->view('templates/footer');
      } else {
         $this->Model_user->updateuser();
         redirect('user/user');
      }
   }

   public function register()
   {
      $data = [
         'title' => 'Register'
      ];
      $this->load->view('login_templates/header', $data);
      $this->load->view('user/register', $data);
      $this->load->view('login_templates/footer');
   }

   public function proses_register()
   {
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $nama_lengkap = $this->input->post('nama_lengkap');
      $level = 'customer';

      $data = [
         'email' => $email,
         'nama_lengkap' => $nama_lengkap,
         'password' => $password,
         'level' => $level,
         'is_verified' => 0 // Belum terverifikasi
      ];

      $this->Model_user->insert_register($data, 'tb_user');

      // Kirim email konfirmasi
      $this->send_verification_email($email);
      $this->session->set_flashdata('message', 'Silakan verifikasi email Anda sebelum login.');
      redirect('auth');
   }

   private function send_verification_email($email)
   {
      // Generate token
      $token = bin2hex(random_bytes(32));
      $verification_link = base_url('user/user/verify_email/' . $token);

      // Simpan token ke database atau session
      $this->db->insert('email_verification', [
         'email' => $email,
         'token' => $token,
         'created_at' => date('Y-m-d H:i:s')
      ]);

      // Konfigurasi email
      $this->load->library('email');
      $this->email->from('SevenOrganizer@gmail.com', 'Seven Organizer');
      $this->email->to($email);
      $this->email->subject('Email Verification');
      $this->email->message("Please click this link to verify your email: " . $verification_link);

      if (!$this->email->send()) {
         // Handle error
         log_message('error', 'Email not sent: ' . $this->email->print_debugger());
      }
   }

   public function forget()
   {
      $data = [
         'title' => 'forget'
      ];
      $this->load->view('login_templates/header', $data);
      $this->load->view('user/forget', $data);
      $this->load->view('login_templates/footer');
   }

   public function forget_pass()
   {

      $email = $this->input->post('email');
      $password = $this->input->post('password');

      $query = $this->db->get_where('tb_user', array('email' => $email));

      foreach ($query->result() as $row) {
         $dbemail = $row->email;
      }

      if ($dbemail == $email) {
         $data = [
            'password' => $password
         ];
         $this->db->update('tb_user', $data, ['email' => $email]);
         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          Reset Password Berhasil!
        </div>');
         redirect('auth');
      } else {
         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
          Email Yang Anda Massukkan Tidak Sesuai!
        </div>');
         redirect('user/user/forget');
      }
   }

   public function profile($id)
   {
      $data = [
         'title' => 'Profile'
      ];
      $data['profile'] = $this->Model_user->getprofile($id);
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar');
      $this->load->view('user/profile', $data);
      $this->load->view('templates/footer');
   }

   public function update_profile()
   {
      $id_user = $this->input->post('id_user');
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $nama_lengkap = $this->input->post('nama_lengkap');
      $data = [
         'email' => $email,
         'nama_lengkap' => $nama_lengkap,
         'password' => $password
      ];
      $this->db->update('tb_user', $data, ['id_user' => $id_user]);
      redirect('user/user/profile/' . $id_user);
   }

   public function verify_email($token)
   {
      // Cek token di database
      $this->db->where('token', $token);
      $verification = $this->db->get('email_verification')->row();

      if ($verification) {
         // Update status user
         $this->db->set('is_verified', 1);
         $this->db->where('email', $verification->email);
         $this->db->update('tb_user');

         // Hapus token setelah berhasil verifikasi
         $this->db->delete('email_verification', ['token' => $token]);

         // Berikan pesan sukses
         $this->session->set_flashdata('message', 'Email Anda telah terverifikasi! Silakan login.');
         redirect('auth');
      } else {
         // Token tidak valid
         $this->session->set_flashdata('message', 'Token verifikasi tidak valid atau telah digunakan.');
         redirect('auth');
      }
   }

   public function request_reset_password_form()
   {
      $this->load->view('reset_password/request_reset_password_form');
   }

   public function request_reset_password()
   {
      $email = $this->input->post('email');

      // Cek apakah email ada di database
      $user = $this->Model_user->get_user_by_email($email);
      if ($user) {
         // Pastikan Anda mendapatkan ID yang benar
         $user_id = $user->id_user; // atau kolom yang sesuai

         // Generate token dan simpan ke database
         $token = bin2hex(random_bytes(50));
         $this->Model_user->save_password_reset_token($user_id, $token);

         // Kirim email
         $reset_link = base_url("user/user/reset_password/$token");
         $this->send_email($email, 'Reset Password', "Klik link ini untuk mereset password Anda: $reset_link");

         echo "Link untuk reset password telah dikirim ke email Anda.";
      } else {
         echo "Email tidak terdaftar.";
      }
   }


   public function reset_password($token)
   {
      // Cek token di database
      $user = $this->Model_user->get_user_by_token($token);
      if (!$user) {
         echo "Token tidak valid atau telah kedaluwarsa.";
         return;
      }

      // Jika token valid, tampilkan form untuk ganti password
      $this->load->view('reset_password/reset_password_form', ['token' => $token]);
   }

   public function update_password()
   {
      $token = $this->input->post('token');
      $new_password = $this->input->post('new_password');

      // Update password di database
      $user = $this->Model_user->get_user_by_token($token);
      if ($user) {
         $this->Model_user->update_password($user->id_user, $new_password);
         $this->session->set_flashdata('message', 'Password berhasil diubah.');
         redirect('auth');
      } else {
         echo "Token tidak valid atau telah kedaluwarsa.";
      }
   }

   private function send_email($to, $subject, $message)
{
    $this->load->library('email');
    $this->email->from('sevenOrganizer@gmail.com', 'Lmfao');
    $this->email->to($to);
    $this->email->subject($subject);
    $this->email->message($message);

    if (!$this->email->send()) {
        // Handle email sending error
        log_message('error', 'Email not sent: ' . $this->email->print_debugger());
    }
}
}
