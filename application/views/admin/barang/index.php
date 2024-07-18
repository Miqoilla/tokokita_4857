<!-- application/views/admin/barang/index.php -->

<div class="content-wrapper">
  <div class="content-header">
    <!-- Content Header content can go here -->
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
            <h3 class="card-title" style="font-weight: bold; color: #333;">Barang</h3>
            </div>
            <div class="card-body">
              <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success">
                  <?php echo $this->session->flashdata('success'); ?>
                </div>
              <?php } ?>
              <?php if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger">
                  <?php echo $this->session->flashdata('error'); ?>
                </div>
              <?php } ?>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($barang as $index => $val) { ?>
                    <tr>
                      <td><?php echo $index + 1; ?></td>
                      <td><?php echo $val->nama_barang; ?></td>
                      <td><?php echo $val->deskripsi; ?></td>
                      <td><?php echo number_format($val->harga, 2, ',', '.'); ?></td>
                      <td><?php echo $val->stok; ?></td>
                      <td>
                        <?php if (!empty($val->gambar)) { ?>
                          <img src="<?php echo base_url('uploads/' . $val->gambar); ?>" alt="Gambar Barang" width="100">
                        <?php } else { ?>
                          <span>Tidak ada gambar</span>
                        <?php } ?>
                      </td>
                      <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <a href="<?php echo site_url('barang/edit/' . $val->id); ?>" class="btn btn-sm btn-warning" title="Edit">
                            <i class="fas fa-edit"></i>
                          </a>
                          <a href="<?php echo site_url('barang/delete/' . $val->id); ?>" class="btn btn-sm btn-danger ml-2" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                            <i class="fas fa-trash-alt"></i>
                          </a>
                        </div>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <div class="card-footer clearfix">
              <a href="<?php echo site_url('barang/add'); ?>" class="btn btn-sm btn-primary float-left">Tambah Barang</a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
</div>