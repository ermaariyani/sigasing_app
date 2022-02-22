<?php
if (isset($_GET['id'])) {

    $database = new Database();
    $db = $database->getConnection();

    if (isset($_POST['button_update'])) {

        $updateSql = "UPDATE bagian SET nama_bagian = ? WHERE id = ?";
        $stmt = $db->prepare($updateSql);
        $stmt->bindParam(1, $_POST['nama_bagian']);
        $stmt->bindParam(2, $_POST['id']);



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
    $findSql = "SELECT * FROM bagian WHERE id = ?";
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
                        <h1>Bagian</h1>
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
                                $selected = $row_karyawan["id"] == $row["karyawan_id"] ? "selcted" : "";
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

                            $selectSQL = "SELECT * FROM lokasi";
                            $stmt_lokasi = $db->prepare($selectSQL);
                            $stmt_lokasi->execute();

                            while ($row_lokasi = $stmt_lokasi->fetch(PDO::FETCH_ASSOC)) {
                                $selected = $row_lokasi["id"] == $row["lokasi_id"] ? "selcted" : "";
                                echo "<option value=\"" . $row_lokasi["id"] . "\">" . $row_lokasi["nama_lokasi"] . "</option>";
                            }
                            ?>
                        </select>

                        <a href="?page=jabatanread" class="btn btn-danger btn-sm float-right"><i class="fa fa-times"></i> Batal</a>
                        <button type="submit" name="button_update" class="btn btn-success btn-sm float-right"><i class="fa fa-save"></i> Simpan</button>

                    </form>
                </div>
            </div>
        </section>
<?php
    } else {
        $_SESSION['hasil_update'] = false;
        echo "<meta http-equiv='refresh' content='0;url=?page=bagianread'>";
    }
} else {
    $_SESSION['hasil_update'] = false;
    echo "<meta http-equiv='refresh' content='0;url=?page=bagianread'>";
}

include_once "partials/scripts.php"
?>