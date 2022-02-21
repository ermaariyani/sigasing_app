<?php
if (isset($_GET['id'])) {

    $database = new Database();
    $db = $database->getConnection();

    $deleteSQL = "DELETE FROM lokasi WHERE id=?";
    $stmt = $db->prepare($deleteSQL);
    $stmt->bindParam(1, $_GET['id']);
    $stmt->execute();
    if ($stmt->execute()) {
        $_SESSION['hasil'] = true;
        $_SESSION['pesan'] = "Hapus Berhasil";
    } else {
        $_SESSION['hasil'] = false;
        $_SESSION['pesan'] = "Hapus Gagal";
    }
}
echo "<meta http-equiv='refresh' content='0;url=?page=lokasiread'";
