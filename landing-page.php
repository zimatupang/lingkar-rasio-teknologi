<?php



include('connection.php');

if(isset($_GET['id_buku'])){
    $id_buku_utama = $_GET['id_buku'];
    $mysql_tampil_utama = mysqli_query($host, "SELECT * FROM landing_page WHERE id_buku=$id_buku_utama") or die(mysqli_error($host));
}else {
    $id_buku_utama = 1;
    $mysql_tampil_utama = mysqli_query($host, "SELECT * FROM landing_page WHERE id_buku=$id_buku_utama") or die(mysqli_error($host));
}




// 
// if(!isset($_SESSION))
// $nomor_sesi = 1;
// $_SESSION['product_id'] = $nomor_sesi;

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Get Book YOU ARE YOUR ONLY LIMIT</title>
        <style type="text/css">
            #photo {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width:60%;
            }
            #desc {
                text-align: center;
            }
            #desc h1 {
                font-size: 22pt;
            }
            #btn-buy {
                background-color: teal;
                color: white;
                border-radius: 5px;
                border-style: none;
                width: 60%;
                height: 40px;
                font-size: 24pt;
                margin-top: 10px;
                margin-left: auto;
                margin-right: auto;
                display: block;
            }

            .td-class{
                width:180px;
                padding:10px;
                
                background-color: rgba(255, 255, 255, 0.6);
            }

            #td_produk{
                
                
                object-fit: cover;
                margin-top:0;
                text-align:center;
            }
            
            #td_produk img {
                width:180px;
                object-fit: cover;


                margin-top:0;
                
        </style>
    </head>

    <body style="background-image: url(background-1.jpg); background-size: 100%; display: grid;">
    
        <div style="width: 100%;">
            <div id="desc" style="width: 35%; float: left; background-color: rgba(255, 255, 255, 0.6);margin-top: 10%; margin-left: 10%;">
                <h3>DAPATKAN SEKARANG!</h3>

                <?php $data_produk_utama = mysqli_fetch_assoc($mysql_tampil_utama); ?>

                <h1><?php echo $data_produk_utama['judul_buku'];?></h1>
                <p>Bacaan Harian Anda</p> 
                <p>Kembangkan diri Anda!</p>
            </div>    
            <div style="float: right; margin-right: 10%; margin-top: 10%; width: 35%; height: 100%; " > 
                <div><img id="photo" src="<?php echo $data_produk_utama['foto_buku'] ?>"></div>
                <div>
                    <button id="btn-buy" onclick="location.href='form-pembelian.php?id_buku=<?php echo $data_produk_utama['id_buku']?>'">Beli</button>
                </div>                    
            </div>
        </div>
        
        <div style=" display: block; margin-left: auto; margin-right: auto;">
            <div>
                <p style="text-align:center; font-size:24pt;">Produk Lainnya</p>
            </div>
            <div>
                <table>
                    
                    <?php
                    $query_mysqli = mysqli_query($host, "SELECT * FROM landing_page") or die(mysqli_error());
                    $nomor = 1;
                    ?>
                    <tr>
                    <?php while($data = mysqli_fetch_array($query_mysqli)){
                            ?>
                        
                        <td class="td-class">
                            <a  style="text-decoration: none; color:black; " href="landing-page.php?id_buku=<?php echo $data['id_buku'];?>"><div id="td_produk">
                                <img src="<?php echo $data['foto_buku']; ?>">
                                <p><?php echo $data['judul_buku']; ?></p>
                            </div>
                            </a>
                        </td>
                        <? $nomor++;?>
                        <?php } ?>
                    </tr>
                
                </table>
            </div>
        </div>
    </body>
</html>