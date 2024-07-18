<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Barang</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo site_url('barang/update'); ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $barang->id; ?>">
                                <input type="hidden" name="gambar_lama" value="<?php echo $barang->gambar; ?>">
                                <div class="form-group">
                                    <label for="nama_barang">Nama Barang</label>
                                    <input type="text" name="nama_barang" class="form-control" value="<?php echo $barang->nama_barang; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" required><?php echo $barang->deskripsi; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="text" name="harga" class="form-control" value="<?php echo $barang->harga; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="stok">Stok</label>
                                    <input type="text" name="stok" class="form-control" value="<?php echo $barang->stok; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="gambar">Gambar</label>

                                    <input type="file" name="gambar" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>