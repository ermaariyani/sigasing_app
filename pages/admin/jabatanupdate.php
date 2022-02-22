<?php
if (isset($_GET['id'])) {

    $database = new Database();
    $db = $database->getConnection();

    if (isset($_POST['button_update'])) {

        $updateSql = "UPDATE jabatan SET nama_jabatan = ?, gapok_jabatan = ?, tunjangan_jabatan = ?, uang_makan_perhari = ? WHERE id = ?";
        $stmt = $db->prepare($updateSql);
        $stmt->bindParam(1, $_POST['nama_jabatan']);
        $stmt->bindParam(2, $_POST['gapok_jabatan']);
        $stmt->bindParam(3, $_POST['tunjangan_jabatan']);
        $stmt->bindParam(4, $_POST['uang_makan_perhari']);
        $stmt->bindParam(5, $_POST['id']);

        if ($stmt->execute()) {
            $_SESSION['hasil'] = true;
            $_SESSION['pesan'] = "Berhasil Update Data";
        } else {
            $_SESSION['hasil'] = false;
            $_SESSION['pesan'] = "Gagal Update Data";
        }
        echo "<meta http-equiv='refresh' content='0;url=?page=jabatanread'>";
    }

    $id = $_GET['id'];
    $findSql = "SELECT * FROM jabatan WHERE id = ?";
    $stmt = $db->prepare($findSql);
    $stmt->bindParam(1, $_GET['id']);
    $stmt->execute();
    $row = $stmt->fetch();
    if (isset($row['id'])) {
?>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Lokasi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                            <li class="breadcrumb-item"><a href="?page=jabatanread">Jabatan</a></li>
                            <li class="breadcrumb-item active">Ubah Data</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ubah Jabatan</h3>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label for="nama_lokasi">Nama Jabatan</label>
                            <input type="hidden" class="form-control" name="id" value="<?= $row['id'] ?>">
                            <input type="text" class="form-control" name="nama_jabatan" value="<?= $row['nama_jabatan'] ?>">
                        </div>

                        <div class="form-group">
                            <label for="gaji_pokok">Gaji Pokok</label>
                            <input type="number" name="gapok_jabatan" class="form-control" onkeypress="return (event.charCode > 47 && event.charCode < 58) || event.charCode == 46" min="1" value="<?= $row['gapok_jabatan'] ?>">
                        </div>

                        <div class="form-group">
                            <label for="tunjangan">Tunjangan</label>
                            <input type="number" name="tunjangan_jabatan" class="form-control" onkeypress="return (event.charCode > 47 && event.charCode < 58) || event.charCode == 46" min="1" value="<?= $row['tunjangan_jabatan'] ?>">
                        </div>

                        <div class="form-group">
                            <label for="gaji_pokok">Uang Makan Perhari</label>
                            <input type="number" name="uang_makan_perhari" class="form-control" onkeypress="return (event.charCode > 47 && event.charCode < 58) || event.charCode == 46" min="1" value="<?= $row['uang_makan_perhari'] ?>">
                        </div>

                        <a href="?page=jabatanread" class="btn btn-danger btn-sm float-right"><i class="fa fa-times"></i> Batal</a>
                        <button type="submit" name="button_update" class="btn btn-success btn-sm float-right"><i class="fa fa-save"></i> Simpan</button>

                    </form>
                </div>
            </div>
        </section>
<?php
    } else {
        $_SESSION['hasil_update'] = false;
        echo "<meta http-equiv='refresh' content='0;url=?page=lokasiread'>";
    }
} else {
    $_SESSION['hasil_update'] = false;
    echo "<meta http-equiv='refresh' content='0;url=?page=lokasiread'>";
}
include_once "partials/scripts.php"
?>