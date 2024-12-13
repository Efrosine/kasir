<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Kirim request untuk menghapus produk ke API
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://kasir.efrosine.my.id/api/products/{$product_id}",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
        CURLOPT_HTTPHEADER => array(
            'Accept: application/json',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    $result = json_decode($response, true);
    if (isset($result['message']) && $result['message'] == 'Product deleted successfully') {
        // Redirect ke halaman produk setelah penghapusan sukses
        header('Location: products.php');
        exit;
    } else {
        echo "Terjadi kesalahan saat menghapus produk.";
    }
}
?>