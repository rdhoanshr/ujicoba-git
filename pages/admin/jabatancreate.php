<?php
if (isset($_POST['button_create'])) {
    $database = new Database();
    $db = $database->getConnection();

    $valdateSql = "SELECT * FROM jabatan WHERE nama_jabatan = ?";
    $stmt = $db->prepare($valdateSql);
    $stmt->bindParam(1, $_POST['nama_jabatan']);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <h5><i class="icon fas fa-ban"></i> Gagal</h5>
            Nama Jabatan sama sudah ada
        </div>
<?php
    } else {

        $insertNama = "INSERT INTO jabatan values(?,?,?,?,?)";
        $stmt = $db->prepare($insertNama);
        $stmt->bindParam(1, $_POST[]);
        $stmt->bindParam(2, $_POST['nama_jabatan']);
        $stmt->bindParam(3, $_POST['gapok_jabatan']);
        $stmt->bindParam(4, $_POST['tunjangan_jabatan']);
        $stmt->bindParam(5, $_POST['uang_makan_perhari']);
        if ($stmt->execute()) {
            $_SESSION['hasil'] = true;
            $_SESSION['pesan'] = "Berhasil simpan data";
        } else {
            $_SESSION['hasil'] = false;
            $_SESSION['pesan'] = "Gagal simpan data";
        }
        echo "<meta http-equiv='refresh' content='0;url=?page=jabatanread'>";
    }
}
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb2">
            <div class="col-sm-6">
                <h1>Tambah Data Jabatan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                    <li class="breadcrumb-item"><a href="?page=lokasiread">Jabatan</a></li>
                    <li class="breadcrumb-item">Tambah Data</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Jabatan</h3>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="nama_jabatan">Nama Jabatan</label>
                    <input type="text" class="form-control" name="nama_jabatan">
                </div>
                <div class="form-group">
                    <label for="gapok_jabatan">Gaji Pokok</label>
                    <input type="number" class="form-control" name="gapok_jabatan" onkeypress='return (event.charCode > 47 && event.charCode < 58) || event.charCode == 46'>
                </div>
                <div class="form-group">
                    <label for="tunjangan_jabatan">Tunjangan</label>
                    <input type="number" class="form-control" name="tunjangan_jabatan" onkeypress='return (event.charCode > 47 && event.charCode < 58) || event.charCode == 46'>
                </div>
                <div class="form-group">
                    <label for="uang_makan_perhari">Uang Makan Perhari</label>
                    <input type="text" class="form-control" name="uang_makan_perhari" onkeypress='return (event.charCode > 47 && event.charCode < 58) || event.charCode == 46'>
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

<?php include_once "partials/scripts.php" ?>