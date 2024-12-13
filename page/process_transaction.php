<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_POST['customer_id'];
    $payment_method = $_POST['payment_method'];
    $products = $_POST['products'];

    $transaction_data = array(
        'customer_id' => $customer_id,
        'payment_method' => $payment_method,
        'products' => array_map(function ($product_id) {
            return ['product_id' => $product_id, 'quantity' => 1]; // Asumsi quantity 1
        }, $products)
    );

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://kasir.efrosine.my.id/api/transactions',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($transaction_data),
        CURLOPT_HTTPHEADER => array(
            'Accept: application/json',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $transaction = json_decode($response, true);

    // Redirect atau tampilkan hasil transaksi

    header('Location: cashier.php');

}
?>