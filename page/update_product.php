<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category_id = $_POST['category_id'];

    $product_data = array(
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'stock' => $stock,
        'category_id' => $category_id
    );

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://kasir.efrosine.my.id/api/products/{$product_id}",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => json_encode($product_data),
        CURLOPT_HTTPHEADER => array(
            'Accept: application/json',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $product = json_decode($response, true);

    if (isset($product['product_id'])) {
        // Redirect ke halaman produk jika sukses
        header('Location: products.php');
        exit;
    } else {
        echo "Terjadi kesalahan saat mengupdate produk.";
    }
}
?>