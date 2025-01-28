<div class="container-fluid">
  <center><h3>Katalog Produk</h3></center>
  <div class="row">
    <?php foreach ($katalog as $dat) : ?>
      <div class="col-sm-6 col-md-4 mb-4">
        <div class="card" style="width: 100%;">
          <a href="<?= base_url('produk/produk/detail/') . $dat['id_produk']; ?>">
            <img src="<?= base_url('uploads/') . $dat['gambar']; ?>" class="card-img-top" alt="<?= $dat['nama_produk']; ?>">
          </a>
          <div class="card-body">
            <h5 class="card-title"><?= $dat['nama_produk']; ?></h5>
            <p class="card-text">Rp. <?= number_format($dat['harga'], 0, ',', '.'); ?></p>
            <a href="<?= base_url('produk/produk/pesan/') . $dat['id_produk']; ?>" class="btn btn-primary">Pesan</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
