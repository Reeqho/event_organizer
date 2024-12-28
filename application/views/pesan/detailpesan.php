<head>
	<script type="text/javascript"
		src="https://app.sandbox.midtrans.com/snap/snap.js"
		data-client-key="SB-Mid-client-bPZnMFLg4RAAdnR2"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Detail Pesanan</h1>

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Detail Pesanan</h6>
		</div>
		<div class="card-body">
			<div class="row">
				<?php foreach ($detailpesan as $dat) : ?>
					<div class="col-4">
						<img src="<?= base_url('uploads/') . $dat['gambar']; ?> ?>" class="card-img-top">
					</div>

					<div class="col-8">
						<table class="table">
							<tr>
								<td>Kategori</td>
								<td>:</td>
								<td><?= $dat['kategori']; ?></td>
							</tr>
							<tr>
								<td>Nama Produk</td>
								<td>:</td>
								<td><?= $dat['nama_produk']; ?></td>
							</tr>
							<tr>
								<td>Harga</td>
								<td>:</td>
								<td><?= $dat['harga']; ?></td>
							</tr>
							<tr>
								<td>Deskripsi</td>
								<td>:</td>
								<td><?= $dat['deskripsi']; ?></td>
							</tr>
						</table><br>
					</div>

					<div class="card-header py-3">
						<h6 class="m-0 font-weight-bold text-primary">Data Pemesan</h6>
					</div>
					<div class="col-12">
						<table class="table">
							<tr>
								<td>Nama Pemesan</td>
								<td>:</td>
								<td><?= $dat['nama_pemesan']; ?></td>
							</tr>
							<tr>
								<td>No Handphone</td>
								<td>:</td>
								<td><?= $dat['no_hp']; ?></td>
							</tr>
							<tr>
								<td>Alamat</td>
								<td>:</td>
								<td><?= $dat['alamat']; ?></td>
							</tr>
							<tr>
								<td>Tgl Pesan</td>
								<td>:</td>
								<td><?= $dat['tgl_pesan']; ?></td>
							</tr>
							<tr>
								<td>Status Pesanan</td>
								<td>:</td>
								<td><?= $dat['status_pesanan']; ?></td>
							</tr>
							<tr>
								<td>Jumlah yg Harus dibayar</td>
								<td>:</td>
								<td>Rp. <?= $dat['harga']; ?></td>
							</tr>
						</table>
					</div>

					<div class="card-header py-3">
						<h6 class="m-0 font-weight-bold text-primary">Pembayaran</h6>
					</div>
				<?php endforeach; ?>
				<div class="card-header py-3">
					<p>jika sudah melakukan pemesanan maka klik tombol pay
					<form id="payment-form" method="post" action="<?= site_url() ?>/snap/finish">
						<div class="form-group" hidden>
							<input type="text" name="id_pesan" value="<?= $dat['id_pesan']; ?>">
						</div>
						<div class="form-group" hidden>
							<input type="text" name="id_user" value="<?= $this->session->userdata('id_user'); ?>">
						</div>
						<div class="form-group" hidden>
							<input type="text" name="id_produk" value="<?= $dat['id_produk']; ?>">
						</div>
						<div class="form-group" hidden>
							<input type="hidden" name="result_type" id="result-type" value="">
						</div>
						<div class="form-group" hidden>
							<input type="hidden" name="result_data" id="result-data" value="">
						</div>
						<div class="form-group" hidden>
							<input type="hidden" name="harga" id="harga" value="<?= $dat['harga']; ?>">
							<input type="hidden" name="nama_pemesan" id="nama_pemesan" value="<?= $dat['nama_pemesan']; ?>">
							<input type="hidden" name="nama_produk" id="nama_produk" value="<?= $dat['nama_produk']; ?>">
							<input type="hidden" name="no_hp" id="no_hp" value="<?= $dat['no_hp']; ?>">
							<input type="hidden" name="alamat" id="alamat" value="<?= $dat['alamat']; ?>">
						</div>
						<div class="form-group" hidden>
							<input type="text" name="id_pesan" value="<?= $dat['id_pesan']; ?>">
							<input type="text" name="id_user" value="<?= $this->session->userdata('id_user'); ?>">
							<input type="text" name="id_produk" value="<?= $dat['id_produk']; ?>">
						</div>
						<button id="pay-button" class="btn btn-primary btn-lg">Pay!</button>
					</form>
				</div>
				</p>
			</div>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
	$('#pay-button').click(function(event) {
		event.preventDefault();
		$(this).attr("disabled", "disabled");

		var harga = $('#harga').val();
		var nama_pemesan = $('#nama_pemesan').val();
		var nama_produk = $('#nama_produk').val();
		var no_hp = $('#no_hp').val();
		var alamat = $('#alamat').val();

		$.ajax({
			type: 'POST',
			url: '<?= site_url() ?>/snap/token',
			data: {
				harga: harga,
				nama_pemesan: nama_pemesan,
				nama_produk: nama_produk,
				no_hp: no_hp,
				alamat: alamat
			},
			cache: false,
			success: function(data) {
				console.log('token = ' + data);

				var resultType = document.getElementById('result-type');
				var resultData = document.getElementById('result-data');

				function changeResult(type, data) {
					$("#result-type").val(type);
					$("#result-data").val(JSON.stringify(data));
				}

				snap.pay(data, {
					onSuccess: function(result) {
						changeResult('success', result);
						console.log(result.status_message);
						$("#payment-form").submit();
					},
					onPending: function(result) {
						changeResult('pending', result);
						console.log(result.status_message);
						$("#payment-form").submit();
					},
					onError: function(result) {
						changeResult('error', result);
						console.log(result.status_message);
						$("#payment-form").submit();
					}
				});
			},
			error: function(xhr, status, error) {
				console.error('Error fetching token: ' + error);
				alert('Failed to initialize payment. Please try again.');
				$('#pay-button').removeAttr("disabled");
			}
		});
	});
</script>
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= base_url('produk/pesan/formbayar') ?>" method="POST" enctype="multipart/form-data">
					<div class="form-group" hidden>
						<input type="text" name="id_pesan" value="<?= $dat['id_pesan']; ?>">
					</div>
					<div class="form-group" hidden>
						<input type="text" name="id_user" value="<?= $this->session->userdata('id_user'); ?>">
					</div>
					<div class="form-group" hidden>
						<input type="text" name="id_produk" value="<?= $dat['id_produk']; ?>">
					</div>
					<div class="form-group">
						<label>upload bukti pembayaran</label>
						<input type="file" name="gambar" required>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
				<button type="submit" class="btn btn-sm btn-primary">Tambah</button>
			</div>
			</form>
		</div>
	</div>
</div>
</div> -->
