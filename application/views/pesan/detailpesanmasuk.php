<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800 print-hide">Detail Pesanan Jasa</h1>

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Detail Pesanan Jasa</h6>
			<button id="printButton" class="btn btn-secondary" style="float: right;">Cetak</button>
		</div>
		<div class="card-body">
			<div class="row">
				<?php foreach ($detailpesanmasuk as $dat) : ?>
					<div class="col-4">
						<img src="<?= base_url('uploads/') . $dat['gambar']; ?>" class="card-img-top">
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
								<td>Jasa Yang Ditawarkan</td>
								<td>:</td>
								<td><?= $dat['deskripsi']; ?></td>
							</tr>
						</table><br>
					</div>

					<!-- Data Pemesanan Section -->
					<div class="card mb-4" id="data-pemesanan">
						<div class="card-header py-3 bg-primary text-white">
							<h6 class="m-0 font-weight-bold">Data Pemesanan</h6>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered">
									<tr>
										<th class="bg-light" style="width: 30%;">Nama Pemesan (Beserta Alamat)</th>
										<td><?= $dat['nama_pemesan']; ?></td>
									</tr>
									<tr>
										<th class="bg-light">No Handphone</th>
										<td><?= $dat['no_hp']; ?></td>
									</tr>
									<tr>
										<th class="bg-light">Permintaan Pesanan</th>
										<td><?= $dat['alamat']; ?></td>
									</tr>
									<tr>
										<th class="bg-light">Tanggal Pesan</th>
										<td><?= $dat['tgl_pesan']; ?></td>
									</tr>
									<tr>
										<th class="bg-light">Status Pesanan</th>
										<td><?= $dat['status_pesanan']; ?></td>
									</tr>
								</table>
							</div>
							<!-- Konfirmasi Button -->
							<?php if ($dat['status_pesanan'] != 'Pembayaran Selesai' && $this->session->userdata('level') == 'admin') : ?>
								<a href="<?= base_url('produk/pesan/konfirmasipembayaran/' . $dat['id_pesan']); ?>" class="btn btn-success">Konfirmasi</a>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>

</div>

<style>
/* Print styles */
@media print {
	body * {
		visibility: hidden;
	}
	#data-pemesanan, #data-pemesanan * {
		visibility: visible;
	}
	#data-pemesanan {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
	}
	/* Hide print button, action buttons, and the page heading in print view */
	#printButton, .action-button, .print-hide {
		display: none;
	}
}
</style>

<script>
document.getElementById("printButton").onclick = function() {
		window.print();
}
</script>
