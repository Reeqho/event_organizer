<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800 print-hide">Detail Pesanan Masuk</h1>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Detail Pesanan Masuk</h6>
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
            </table>
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
  .container-fluid, .container-fluid * {
    visibility: visible;
  }
  .container-fluid {
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
