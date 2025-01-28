<?php
$id_kategori = $this->uri->segment(4);
$query = $this->db->get_where('tb_kategori', array('id_kategori' => $id_kategori));

if ($query->num_rows() > 0) {
    $kategori = $query->row(); // Mengambil data kategori tunggal
?>
    <div class="container-fluid">
        <center><h3><?php echo $kategori->kategori; ?></h3></center>
        <div class="row g-4"> <!-- Tambahkan class g-4 untuk memberikan jarak antar elemen -->
            <?php
            // Query untuk mengambil semua produk berdasarkan kategori
            $produk_query = $this->db->get_where('tb_produk', array('id_kategori' => $id_kategori));
            if ($produk_query->num_rows() > 0) {
                foreach ($produk_query->result() as $produk) { // Iterasi untuk menampilkan semua produk
            ?>
                    <div class="col-md-3"> <!-- Menentukan kolom untuk ukuran layar medium ke atas -->
                        <div class="card h-100" style="width: 100%;"> <!-- Tambahkan h-100 untuk kartu dengan tinggi seragam -->
                            <a href="<?= base_url('produk/produk/detail/') . $produk->id_produk; ?>">
                                <img src="<?= base_url('uploads/') . $produk->gambar; ?>" class="card-img-top" alt="<?= $produk->nama_produk; ?>" style="height: 200px; object-fit: cover;">
                            </a>
                            <div class="card-body d-flex flex-column"> <!-- Flex column untuk pengaturan konten -->
                                <h5 class="card-title"><?= $produk->nama_produk; ?></h5>
                                <p class="card-text">Rp. <?= number_format($produk->harga, 0, ',', '.'); ?></p>
                                <?php if ($this->session->userdata('level') == 'customer') { ?>
                                    <a href="<?= base_url('produk/produk/pesan/') . $produk->id_produk; ?>" class="btn btn-primary mt-auto">Pesan</a> <!-- Tombol berada di bawah -->
                                <?php } ?>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
            ?>
                <center><h3>Belum Ada Produk</h3></center>
            <?php
            }
            ?>
        </div>
    </div>
<?php
} else {
?>
    <center><h3>Kategori Tidak Ditemukan</h3></center>
<?php
}
?>
