<!-- Begin Page Content -->

<?php
// Mengambil konfigurasi koneksi ke database dari file database.php di folder config CodeIgniter
include(APPPATH . 'config/database.php');

$host = $db['default']['hostname'];
$dbname   = $db['default']['database'];
$username = $db['default']['username'];
$password = $db['default']['password'];

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Koneksi ke database gagal: " . $e->getMessage());
}
// Query SQL untuk mengambil data dari tabel
$query = "SELECT * FROM app_data";
$stmt = $pdo->query($query);
// Fetch data baris per baris
while ($row = $stmt->fetch()) {
    // Ambil nilai kolom yang diinginkan
    $color = $row['color2'];
    // Lakukan sesuatu dengan nilai yang diambil
    // ...
}
// Menutup koneksi ke database
$pdo = null;
?>


<div style="padding:10px;" class="container-fluid">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('Dashboard'); ?>" style="color: black;">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Konseling</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header">
            <a href="<?= base_url('Dashboard'); ?>" class="btn bg-secondary"><i class="fas fa-fw  fa-arrow-left" style="color: #ffffff;"></i><span style="color: #ffffff; padding-left: 10px;">Kembali</span></a>
        </div>

        <div class="card-body">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-striped table-hover tabza dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                            <thead>
                                <tr class="" style="color:white; background-color: <?= $color ?>;" role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending" style="width: 21.3281px;">No</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Username: activate to sort column ascending">NIK</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Nama Sekolah</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Password: activate to sort column ascending">Nama Desa</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Mengambil konfigurasi koneksi ke database dari file database.php di folder config CodeIgniter
                                include(APPPATH . 'config/database.php');

                                $host = $db['default']['hostname'];
                                $dbname   = $db['default']['database'];
                                $username = $db['default']['username'];
                                $password = $db['default']['password'];

                                $koneksi = mysqli_connect($host, $username, $password, $dbname);

                                if (mysqli_connect_errno()) {
                                    die("Koneksi ke database gagal: " . mysqli_connect_error());
                                }

                                $no = 1;
                                $ambildata = mysqli_query($koneksi, "SELECT * FROM konselingremaja ORDER BY id ASC");

                                while ($tampil = mysqli_fetch_array($ambildata)) {
                                    echo "
    <tr role='row' class='odd'>
    <td>$no</td>
    <td><p style='color: black; font-family:'Poppins', sans-serif;'>$tampil[nik]</p></td>
    <td><p style='color: black; font-family:'Poppins', sans-serif;'>$tampil[nama_sekolah]</p></td>
    <td><p style='color: black; font-family:'Poppins', sans-serif;'>$tampil[nama_desa]</p></td>
    <td><p style='color: black; font-family:'Poppins', sans-serif'>$tampil[tanggal]-$tampil[bulan]-$tampil[tahun]</p></td>
    </tr>
    ";

                                    $no++;
                                }

                                // Tutup koneksi
                                mysqli_close($koneksi);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>