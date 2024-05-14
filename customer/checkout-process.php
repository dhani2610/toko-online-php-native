<?php

require_once '../vendor/autoload.php';
require "connector.php";
// session_start();

// if (!isset($_SESSION['users'])) {
//         header('Location:login.php');
//         exit();
// }
// jika sudah login, alihkan ke halaman dasbor

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Set Your server key
Midtrans\Config::$serverKey = $_ENV['MIDTRANS_SERVER_KEY'];
$clientKey = $_ENV['MIDTRANS_CLIENT_KEY'];

// Uncomment for production environment
// Midtrans\Config::$isProduction = true;

// Enable sanitization
Midtrans\Config::$isSanitized = true;

// Enable 3D-Secure
Midtrans\Config::$is3ds = true;

// Extract GET parameters
$id_produk = $_GET['id_produk'];
$qty = $_GET['qty'];
$grand_total = $_GET['grand_total'];
$nama = $_GET['nama'];
$no_tlp = $_GET['no_tlp'];
$alamat = $_GET['alamat'];

// Fetch product details
$queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$id_produk'");
$produk = mysqli_fetch_array($queryProduk);

// Required
$transaction_details = array(
    'order_id' => rand(),
    'gross_amount' => $grand_total, // no decimal allowed for credit card
);

// Item details
$item_details = array(
    'id' => $produk['id_produk'],
    'price' => $produk['harga'],
    'quantity' => $qty,
    'name' => $produk['nama']
);

// Billing and shipping address
$address = array(
    'first_name'    => $nama,
    'last_name'     => "",
    'address'       => $alamat,
    'city'          => "",
    'postal_code'   => "",
    'phone'         => $no_tlp,
    'country_code'  => 'IDN'
);

// Customer details
$customer_details = array(
    'first_name'    => $nama,
    'last_name'     => "",
    'email'         => "customer@gmail.com",
    'phone'         => $no_tlp,
    'billing_address'  => $address,
    'shipping_address' => $address
);

// Fill transaction details
$transaction = array(
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => array($item_details),
);

$snapToken = Midtrans\Snap::getSnapToken($transaction);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Payment</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php require "navbar.php"; ?>
    <div class="container-fluid banner d-flex align-items-center">
        <div class="container text-center text-white">
            <h1>Fashion and Styles</h1>
            <h3>Complete Your Payment</h3>
        </div>
    </div>
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Payment Order</h3>
            <div class="row mt-5">
                <button id="pay-button" class="btn btn-primary">Pay!</button>
                <!-- <pre><div id="result-json">JSON result will appear here after payment:<br></div></pre> -->
            </div>
        </div>
    </div>
    <?php require "footer.php"; ?>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo $clientKey; ?>"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function(){
            snap.pay('<?php echo $snapToken?>', {
                onSuccess: function(result){
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    saveOrder(result);
                },
                onPending: function(result){
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                onError: function(result){
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        };

        function saveOrder() {
        const url = 'save_order.php?' + new URLSearchParams({
            order_id: '<?php echo $transaction_details["order_id"]; ?>',
            id_produk: '<?php echo $id_produk; ?>',
            qty: '<?php echo $qty; ?>',
            nama: '<?php echo $nama; ?>',
            no_tlp: '<?php echo $no_tlp; ?>',
            alamat: '<?php echo $alamat; ?>',
            grand_total: '<?php echo $grand_total; ?>',
            status: 'sedang di packing'
        });

        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Order has been saved successfully!');
                } else {
                    alert('Failed to save the order: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    }
    </script>
</body>
</html>
