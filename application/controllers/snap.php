<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
class Snap extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
	{
		parent::__construct();
		$params = array('server_key' => 'SB-Mid-server-hRix638KwSTSn-2cwtBPzkio', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('checkout_snap');
	}

	public function token()
	{
		$harga = $this->input->post('harga');
		$nama_pemesan = $this->input->post('nama_pemesan');
		$nama_produk = $this->input->post('nama_produk');
		$no_hp = $this->input->post('no_hp');
		$alamat = $this->input->post('alamat');
		// Required
		$transaction_details = array(
			'order_id' => rand(),
			'gross_amount' => $harga, // no decimal allowed for creditcard
		);

		// Optional
		$item1_details = array(
			'id' => 'a1',
			'price' => $harga,
			'quantity' => 1,
			'name' => $nama_produk
		);

		// Optional
		$item_details = array($item1_details);

		// // Optional
		// $billing_address = array(
		//   'first_name'    => "Andri",
		//   'last_name'     => "Litani",
		//   'address'       => "Mangga 20",
		//   'city'          => "Jakarta",
		//   'postal_code'   => "16602",
		//   'phone'         => "081122334455",
		//   'country_code'  => 'IDN'
		// );

		// // Optional
		$shipping_address = array(
			'first_name'    => $nama_pemesan,
			'phone'         => $no_hp,
			'address'       => $alamat,
			'country_code'  => 'IDN'

		);

		// Optional
		$customer_details = array(
			'first_name'    => $nama_pemesan,
			'phone'         => $no_hp,
			'shipping_address' => $shipping_address
		);

		// Data yang akan dikirim untuk request redirect_url.
		$credit_card['secure'] = true;
		//ser save_card true to enable oneclick or 2click
		//$credit_card['save_card'] = true;

		$time = time();
		$custom_expiry = array(
			'start_time' => date("Y-m-d H:i:s O", $time),
			'unit' => 'minute',
			'duration'  => 10
		);

		$transaction_data = array(
			'transaction_details' => $transaction_details,
			'item_details'       => $item_details,
			'customer_details'   => $customer_details,
			'credit_card'        => $credit_card,
			'expiry'             => $custom_expiry
		);

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
	}

	public function finish()
	{
		$id_pesan = $this->input->post('id_pesan');
		$id_user = $this->input->post('id_user');
		$id_produk = $this->input->post('id_produk');

		$result = json_decode($this->input->post('result_data'), true);
		$data = [
			'id_pesan' => $id_pesan,
			'id_user' => $id_user,
			'id_produk' => $id_produk,
			'order_id' => $result['order_id'],
			'gross_amount' => $result['gross_amount'],
			'payment_type' => $result['payment_type'],
			'transaction_time' => $result['transaction_time'],
			'bank' => $result['va_numbers'][0]['bank'],
			'va_number' => $result['va_numbers'][0]['va_number'],
			'pdf_url' => $result['pdf_url'],
			'status_code' => $result['status_code'],
		];

		$data2 = [
			'status_pesanan' => 'konfirmasi pembayaran'
		];

		try {
			// Insert data ke tb_bayar
			$this->db->insert('tb_bayar', $data);

			// Update status_pesanan menjadi Menunggu Konfirmasi
			$this->db->update('tb_pesan', $data2, ['id_pesan' => $id_pesan]);

			// Ambil informasi nomor telepon pengguna
			$this->db->select('tb_pesan.no_hp, tb_pesan.nama_pemesan');
			$this->db->from('tb_pesan');
			$this->db->where('id_pesan', $id_pesan);
			$query = $this->db->get();
			$user = $query->row();

			if ($user) {
				$nomor = $user->no_hp;
				$nama = $user->nama_pemesan;
				$order_id = $result['order_id'];
				$this->db->select('nama_produk');
				$this->db->from('tb_produk');
				$this->db->where('id_produk', $id_produk);
				$query = $this->db->get();
				$produk = $query->row();
				$nama_pesanan = $produk ? $produk->nama_produk : 'Produk tidak ditemukan';

				// Pesan WhatsApp yang dikirim
				$pesan = "Halo $nama, pesanan Anda $nama_pesanan dengan Order ID $order_id sedang menunggu konfirmasi pembayaran dari Admin";

				// Kirim pesan WhatsApp
				$this->kirimPesan($nomor, $pesan);
			}

			// Redirect ke halaman detailpesan
			redirect('produk/pesan');
		} catch (Exception $e) {
			// Tampilkan error jika ada
			show_error($e->getMessage());
		}
	}

	private function kirimPesan($nomor, $pesan)
	{
		$apiKey = 'guZUgIeZTy9IMCNzaPqGPhwGOzbob6uissjCEIkPPO3TuYzBRGph7bhzTzGvWDXq.aTlUhOJy'; // Ganti dengan API Key Anda
		$url = 'https://bdg.wablas.com/api/send-message';
		$data = [
			'phone' => $nomor, // Nomor tujuan
			'message' => $pesan, // Pesan yang dikirim
		];

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Authorization: ' . $apiKey,
			'Content-Type: application/json',
		]);

		$response = curl_exec($ch);
		curl_close($ch);

		return $response; // Mengembalikan respon dari Wablas
	}
}
