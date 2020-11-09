<?php
require_once dirname(__FILE__) . '/midtrans-php-master/Midtrans.php';

// Set your Merchant Server Key
\Midtrans\Config::$serverKey = 'SB-Mid-server-5yaCQm58QoiCswEGndCwE2sV';
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = false;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = true;

$params = array(
    'transaction_details' => array(
        'order_id' => rand(),
        'gross_amount' => 10000,
    )
);

$snapToken = \Midtrans\Snap::getSnapToken($params);


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
    <button id="pay-button">Pay!</button>
    <pre><div id="result-json">JSON result will appear here after payment:<br></div></pre> 

<!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<Set your ClientKey here>"></script>
    <script type="text/javascript">
      document.getElementById('pay-button').onclick = function(){
        // SnapToken acquired from previous step
        snap.pay('<?=$snapToken?>', {
          // Optional
          onSuccess: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          },
          // Optional
          onPending: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          },
          // Optional
          onError: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          }
        });
      };
    </script>
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
                <p style="text-align:center;">Produk Lainnya</p>
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
                            <a href="landing-page.php?id_buku=<?php echo $data['id_buku'];?>"><div id="td_produk">
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