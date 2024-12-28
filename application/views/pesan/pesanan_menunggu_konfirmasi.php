<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800 print-hide"><?= $title; ?></h1>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
      <button id="printButton" class="btn btn-secondary" style="float: right;">Cetak</button>
    </div>
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID Pesanan</th>
            <th>Order Id</th>
            <th>Nama Pemesan</th>
            <th>Produk</th>
            <th>Harga</th>
            <th>Tanggal Pesan</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pesanan as $pesan) : ?>
            <tr>
              <td><?= $pesan['id_pesan']; ?></td>
              <td><?= $pesan['order_id']; ?></td>
              <td><?= $pesan['nama_pemesan']; ?></td>
              <td><?= $pesan['nama_produk']; ?></td>
              <td><?= $pesan['harga']; ?></td>
              <td><?= $pesan['tgl_pesan']; ?></td>
              <td><?= $pesan['status_pesanan']; ?></td>
              <td>
                <a href="<?= base_url('produk/pesan/konfirmasiPesanan/' . $pesan['id_pesan']); ?>" class="btn btn-success">Konfirmasi</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
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
