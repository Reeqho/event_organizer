<div class="container">
<center><h3><b></b></h3></center>
<center><h3><b></b></h3></center>

  <div class="row">
  
  <div class="col-3">
    <div class="card shadow-sm" style="border-radius: 15px; overflow: hidden; background-color: #f8f9fa;">
        <div style="padding: 15px; background-color: #007bff;">
            <center>
                <img src="<?= base_url('assets/img/profil.png'); ?>" class="card-img-top" style="width: 80%; height: auto; border-radius: 10px;">
            </center>
        </div>
        <div class="card-body">
            <center>
                <a href="<?= base_url('user/user/profile/') . $this->session->userdata('id_user'); ?>" class="btn btn-primary btn-sm" style="border-radius: 20px; padding: 10px 20px; font-weight: bold;">PROFIL</a>
            </center>
        </div>
    </div>
</div>

     <div class="col-3">
    <div class="card shadow-sm" style="border-radius: 15px; overflow: hidden; background-color: #f8f9fa;">
        <div style="padding: 15px; background-color: #007bff;">
            <center>
                <img src="<?= base_url('assets/img/rak.png'); ?>" class="card-img-top" style="width: 80%; height: auto; border-radius: 10px;">
            </center>
        </div>
        <div class="card-body">
            <center>
                <a href="<?= base_url('produk/katalog'); ?>" class="btn btn-primary btn-sm" style="border-radius: 20px; padding: 10px 20px; font-weight: bold;">KATALOG</a>
            </center>
        </div>
    </div>
</div>

    <div class="col-3">
    <div class="card shadow-sm" style="border-radius: 15px; overflow: hidden; background-color: #f8f9fa;">
        <div style="padding: 15px; background-color: #007bff;">
            <center>
                <img src="<?= base_url('assets/img/pesanan.jpg'); ?>" class="card-img-top" style="width: 80%; height: auto; border-radius: 10px;">
            </center>
        </div>
        <div class="card-body">
            <center>
                <a href="<?= base_url('produk/pesan'); ?>" class="btn btn-primary btn-sm" style="border-radius: 20px; padding: 10px 20px; font-weight: bold;">PESANAN</a>
            </center>
        </div>
    </div>
</div>

  </div>
</div>
