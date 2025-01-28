<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Halaman Pemesanan</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Detail Produk</h6>
            </div>
            <div class="card-body">
            <div class="row">
             <?php foreach ($detail as $dat) : ?>
                <div class="col-4">
                  <img src="<?= base_url('uploads/'). $dat['gambar']; ?> ?>" class="card-img-top">
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
                  </table>
                </div>
            <?php endforeach; ?> 

            <style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fc;
    margin: 0;
    padding: 0;
  }

  .container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
  }

  .form-card {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 30px;
    max-width: 500px;
    width: 100%;
  }

  .form-card h3 {
    text-align: center;
    color: #4e73df;
    font-weight: bold;
    margin-bottom: 20px;
  }

  .form-group label {
    font-weight: bold;
    margin-bottom: 5px;
    display: block;
    color: #333;
  }

  .form-group input,
  .form-group textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
  }

  .form-group textarea {
    resize: none;
  }

  .form-group input[type="submit"] {
    background-color: #4e73df;
    color: white;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .form-group input[type="submit"]:hover {
    background-color: #2e59d9;
  }

  @media (max-width: 576px) {
    .form-card {
      padding: 20px;
    }
  }
</style>

<div class="container">
  <div class="form-card">
    <h3>Form Pemesanan</h3>
    <form role="form" action="<?= base_url('produk/produk/prosespesan') ?>" method="POST">
      <div class="form-group" hidden>
        <label>id produk</label>
        <input type="text" class="form-control" name="id_produk" value="<?= $dat['id_produk']; ?>">
      </div>
      <div class="form-group" hidden>
        <label>kategori</label>
        <input type="text" class="form-control" name="kategori" value="<?= $dat['kategori']; ?>">
      </div>
      <div class="form-group" hidden>
        <label>id user</label>
        <input type="text" class="form-control" name="id_user" value="<?= $this->session->userdata('id_user'); ?>">
      </div>
      <div class="form-group">
        <label>Nama Pemesan (Beserta Alamat)</label>
        <input type="text" class="form-control" name="nama_pemesan" value="<?= $this->session->userdata('nama_lengkap'); ?>">
      </div>
      <div class="form-group">
        <label>No Handphone</label>
        <input type="text" class="form-control" name="no_hp">
      </div>
      <div class="form-group">
        <label>Permintaan Pesanan</label>
        <textarea class="form-control" name="alamat" placeholder="Tuliskan permintaan Anda..."></textarea>
      </div>
      <div class="form-group">
        <label>Tanggal Pesan</label>
        <input type="date" class="form-control" name="tgl_pesan" id="tgl_pesan">
      </div>
      <script>
        // Mendapatkan tanggal hari ini dalam format YYYY-MM-DD
        const today = new Date().toISOString().split('T')[0];
        // Menetapkan nilai atribut "min" pada input tanggal
        document.getElementById('tgl_pesan').setAttribute('min', today);
      </script>
      <div class="form-group">
        <input type="submit" name="pesan" class="btn btn-primary" value="Pesan">
      </div>
    </form>
  </div>
</div>


