<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Data Pesanan</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Pesanan</h6>
            </div>
            <div class="card-body">
             
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tgl Pesan</th>
                      <th>Nama Pemesan (Beserta Alamat)</th>
                      <th>No HP</th>
                      <th>Permintaan Pesanan</th>
                      <th>Status Pesanan</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($pesan as $dat) : ?>
                    <tr>
                      <td><?= $dat['tgl_pesan']; ?></td>
                      <td><?= $dat['nama_pemesan']; ?></td>
                      <td><?= $dat['no_hp']; ?></td>
                      <td><?= $dat['alamat']; ?></td>
                      <td><?= $dat['status_pesanan']; ?></td>
                      <td> 
                          <a href="<?= base_url('produk/pesan/detailpesan/') . $dat['id_pesan']; ?>" class="btn btn-primary">Detail</a>
                      </td>
                    </tr>
                  <?php endforeach; ?> 
                  </tbody>
                </table>
              </div>
            </div>
          </div>

</div>

