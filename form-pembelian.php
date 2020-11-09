<?php
include('connection.php');

$id_buku = $_GET['id_buku'];
$mysql_tampil = mysqli_query($host, "SELECT * FROM landing_page WHERE id_buku=$id_buku") or die(mysqli_error($host));
?>
<html>
<head>

<meta name="viewport" content="width-device-width, initial-scale=1.0">

        <link rel="stylesheet" href="landing-page.css">
</head>

<body>
<section id="input-form">
            <?php $data_produk = mysqli_fetch_assoc($mysql_tampil); ?>

            <h1><?php echo $data_produk['judul_buku'];?></h1>
            <form method="get" action="landing-page.php">
                <div class="form">
                    <label>Nama</label>
                    <input type="text" name="name" placeholder="Masukkan nama disini">
                </div>
                <div class="form">
                    <label>Email</label>
                    <input type="email" name="email">
                </div>
                <div class="form">
                    <label>Alamat</label>
                    <input type="textarea" name="alamat">
                </div>
                <div class="form">
                    <label>Jumlah</label>
                    <input type="num" name="jumlah">
                </div>
                
                <div class="form">
                    <input type="submit" name="submit"
                    value="SUBMIT" class="bg-blue">
                </div>

            </form>
        </section>
</body>
</html>