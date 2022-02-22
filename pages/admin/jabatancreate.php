<?php
if (isset($_POST['button_create'])) {

    $database = new Database;
    $db = $database->getConnection();

    // ini untuk validasi input
    $validasi = "SELECT * FROM jabatan WHERE nama_jabatan = ?";
    $stmt = $db->prepare($validasi);
    $stmt->bindParam(1, $_POST['nama_jabatan']);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
?>
        <div class="alert alert-danger alert-dismissible">
            <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
            <h5><i class="icon fas fa-check"></i> Gagal </h5>
            Nama Jabatan Sama atau sudah ada.
        </div>

<?php
    } else {

        $insertSQL = "INSERT INTO jabatan SET nama_jabatan = ?, gapok_jabatan = ?, tunjangan_jabatan = ?, uang_makan_perhari = ?";
        $stmt = $db->prepare($insertSQL);
        $stmt->bindParam(1, $_POST['nama_jabatan']);
        $stmt->bindParam(2, $_POST['gapok_jabatan']);
        $stmt->bindParam(3, $_POST['tunjangan_jabatan']);
        $stmt->bindParam(4, $_POST['uang_makan_perhari']);

        if ($stmt->execute()) {
            $_SESSION['hasil'] = true;
            $_SESSION['pesan'] = "Berhasil Simpan Data";
        } else {
            $_SESSION['hasil'] = false;
            $_SESSION['pesan'] = "Gagal Simpan Data";
        }
        echo "<meta http-equip='refresh' content='0;url=?page=jabatanread'";
    }
}
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Jabatan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?page=home"> Home </a></li>
                    <li class="breadcrumb-item"><a href="?page=jabatanread">Jabatan</a></li>
                    <li class="breadcrumb-item active">Tambah Data</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Jabatan</h3>
            <a href="?page=lokasiread" class="btn btn-danger btn-sm float-right">
                Kembali
            </a>
        </div>

        <div class="card-body">
            <form action="" method="post">

                <div class="form-group">
                    <label for="nama_jabatan">Nama Jabatan</label>
                    <input type="text" name="nama_jabatan" class="form-control">
                </div>

                <div class="form-group">
                    <label for="gaji_pokok">Gaji Pokok</label>
                    <input type="number" name="gapok_jabatan" class="form-control" onkeypress="return (event.charCode > 47 && event.charCode < 58) || event.charCode == 46" min="1">
                </div>

                <div class="form-group">
                    <label for="tunjangan_jabatan">Tunjangan</label>
                    <input type="number" name="tunjangan_jabatan" class="form-control" onkeypress="return (event.charCode > 47 && event.charCode < 58) || event.charCode == 46" min="1">
                </div>

                <div class="form-group">
                    <label for="gaji_pokok">Uang Makan Perhari</label>
                    <input type="number" name="uang_makan_perhari" class="form-control" onkeypress="return (event.charCode > 47 && event.charCode < 58) || event.charCode == 46" min="1">
                </div>

                <a href="?page=jabatanread" class="btn btn-danger btn-sm float-right">
                    <i class="fa fa-times"></i> Batal
                </a>
                <button type="submit" name="button_create" class="btn btn-success btn-sm float-right">
                    <i class="fa fa-save"></i> Simpan
                </button>
            </form>
        </div>
    </div>
</div>
<!-- /.content -->
<?php include_once "partials/scripts.php" ?>