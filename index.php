<?phP

$host   = "localhost";
$user   = "root";
$pass   = "";
$db     = "akademik";

$koneksi = mysqli_connect($host,$user,$pass,$db);
if (!$koneksi){ //cek koneksi
    die ("Tidak bisa terkoneksi ke database");

}
$nim        = "";
$nama       = "";
$alamat     = "";
$fakultas   = "";
$sukses     = "";
$error      = "";


if(isset($_POST["simpan"])){
    $nim = $_POST["nim"];
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $fakultas = $_POST["fakultas"];


    if($nim && $nama && $alamat && $fakultas) {
        $sql1  = "insert into mahasiswa (nim,nama,alamat,fakultas) values ('$nim','$nama','$alamat','$fakultas')";
        $q1    = mysqli_query($koneksi, $sql1);
        if($q1){
            $sukses = "Berhasil memasukkan data baru";

        }else{
            $error = "Gagal memasukkan data";
        }
    }else{
        $error = "Silahkan masukkan semua data";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/index.css">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    
</head>
<body>
    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                Create / Edit Data
            </div>
            <div class="card-body">
                <?php 
                if($error){
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>

                    </div>
                <?php
                }
              ?>
              <?php 
                if($sukses){
                    ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>

                    </div>
                <?php
                }
              ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="nim" name= "nim" value="<?php echo $nim ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">NAMA</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="nama" name= "nama" value="<?php echo $nama ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">ALAMAT</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="alamat" name= "alamat" value="<?php echo $alamat ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="fakultas" class="col-sm-2 col-form-label">FAKULTAS</label>
                        <div class="col-sm-10">
                            <select class="form-control" name ="fakultas" id="fakultas">
                                <option value="">-.Pilih Fakultas.-</option>
                                <option value="saintek" <?php if($fakultas == "saintek") echo "selected" ?>>Saintek</option>
                                <option value="soshum" <?php if($fakultas == "soshum") echo "selected" ?>>Soshum</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header">
                Data Mahasiswa
            </div>
            <div class="card-body">
            <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">NIM</th>
      <th scope="col">NAMA</th>
      <th scope="col">ALAMAT</th>
      <th scope="col">FAKULTAS</th>
      <th scope="col">AKSI</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql2   = "select * from mahasiswa order by id desc";
    $q2     = mysqli_connect($koneksi,$sql2);
    $urut   = 1;
    while ($r2 = mysqli_fetch_array($q2)){
        $id           = $r2['id'];
        $nim          = $r2['nim'];
        $nama         = $r2['nama'];
        $alamat       = $r2['alamat'];
        $fakultas     = $r2['fakultas'];
        
        ?>
        <tr>
            <th scope="row"><?php echo $urut++ ?></th>
            <td scope="row"><?php echo $nim ?></td>
            <td scope="row"><?php echo $nim ?></td>
            <td scope="row"><?php echo $nim ?></td>

            
        </tr>

        <?php



    }
    ?>
  </tbody>
</table>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>