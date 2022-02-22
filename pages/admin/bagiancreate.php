<section class="content-header">
    <div class="form-group"></div>
    <?php
    if (isset($_POST['button_create'])) {

        if ($stmt->rowCount() > 0) {
    ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h5><i class="fas fa-ban"></i>Gagal</h5>
                Nama bagian sama sudah ada
            </div>
    <?php
        } else {

            if ($stmt->execute()) {
                $_SESSION['hasil'] = true;
                $_SESSION['pesan'] = "Berhasil Simpan Data";
            } else {
                $_SESSION['hasil'] = false;
                $_SESSION['pesan'] = "Gagal Simpan Data";
            }


            echo "<meta http-equiv='refresh' content='0;url=?page=bagianread'";
        }
    }
    ?>
    <div class="container-fluid">
        <div class="row mb2">
            <div class="col-sm-6">
                <h1>Bagian</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?page=home"> Home </a></li>
                    <li class="breadcrumb-item"><a href="?page=lokasiread">Bagian</a></li>
                    <li class="breadcrumb-item active">Tambah Data</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Bagian</h3>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label for="nama_lokasi">Nama Bagian</label>
                    <input type="text" class="form-control" name="nama_bagian" required>
                    <label for="karyawan_id">Kepala Bagian</label>
                    <select class="form-control" name="karyawan_id">
                        <option value="">-- Pilih Kepala Bagian --</option>
                        <?php
                        $database = new Database();
                        $db = $database->getConnection();

                        $selectSQL = "SELECT * FROM karyawan";
                        $stmt_karyawan = $db->prepare($selectSQL);
                        $stmt_karyawan->execute();

                        while ($row_karyawan = $stmt_karyawan->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value=\"" . $row_karyawan["id"] . "\">" . $row_karyawan["nama_lengkap"] . "</option>";
                        }
                        ?>
                    </select>


                    <label for="lokasi_id">Lokasi</label>
                    <select class="form-control" name="lokasi_id">
                        <option value="">-- Pilih Lokasi --</option>
                        <?php
                        $database = new Database();
                        $db = $database->getConnection();

                        $selectSQL = "SELECT * FROM karyawan";
                        $stmt_karyawan = $db->prepare($selectSQL);
                        $stmt_karyawan->execute();

                        while ($row_karyawan = $stmt_karyawan->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value=\"" . $row_karyawan["id"] . "\">" . $row_karyawan["nama_lengkap"] . "</option>";
                        }
                        ?>
                    </select>
                </div>


                <a href="?page=lokasiread" class="btn btn-danger btn-sm float-right">
                    <i class="fa fa-times"></i> Batal
                </a>
                <button type="submit" name="button_create" class="btn btn-success btn-sm float-right">
                    <i class="fa fa-save"></i> Simpan
                </button>
            </form>
        </div>
    </div>
</section>

<?php
include "partials/script.php";
?>