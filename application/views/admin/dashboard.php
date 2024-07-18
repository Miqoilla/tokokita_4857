<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Tambahkan Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Tambahkan Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        .card-header {
            background-color: #007bff;
            color: #fff;
        }

        .card-title {
            margin-bottom: 0;
        }

        .table img {
            width: 80px;
            /* Ubah ukuran gambar sesuai kebutuhan */
            height: auto;
            /* Biarkan tinggi otomatis untuk menjaga proporsi */
            object-fit: cover;
        }

        body {
            font-family: 'Lucida Bright';
            /* Contoh penggunaan font Roboto */
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header" style="margin-top: 0px;">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <!-- Hapus <h1>Dashboard</h1> -->
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- Barang Masuk -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Daftar Barang</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Gambar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($barang as $index => $val) { ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo $val->nama_barang; ?></td>
                        <td style="max-width: 600px; word-wrap: break-word;"><?php echo $val->deskripsi; ?></td>
                        <td><?php echo number_format($val->harga, 2, ',', '.'); ?></td>
                        <td><?php echo $val->stok; ?></td>
                        <td>
                            <?php if (!empty($val->gambar)) { ?>
                                <img src="<?php echo base_url('uploads/' . $val->gambar); ?>" alt="Gambar Barang" style="width: 100px;">
                            <?php } else { ?>
                                <span>Tidak ada gambar</span>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <!-- Tambahkan Bootstrap dan jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>