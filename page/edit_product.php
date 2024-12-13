<?php
// Mendapatkan ID produk dari URL
$product_id = $_GET['id'];

// Mengambil data produk dari API
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://kasir.efrosine.my.id/api/products/{$product_id}",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Accept: application/json',
        'Content-Type: application/json'
    ),
));

$response = curl_exec($curl);
curl_close($curl);
$product = json_decode($response, true);

if (!$product) {
    echo "Produk tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <!-- Link ke Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        footer {
            background-color: #f8f9fa;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <header class="mb-4">
            <nav>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="cashier.php">Halaman Kasir</a></li>
                    <li class="nav-item"><a class="nav-link" href="products.php">Manajemen Produk</a></li>
                </ul>
            </nav>
        </header>

        <h1 class="mb-4">Edit Produk</h1>

        <form method="POST" action="update_product.php">
            <input type="hidden" name="product_id" value="<?= $product['product_id']; ?>">

            <div class="mb-3">
                <label for="name" class="form-label">Nama Produk:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $product['name']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi Produk:</label>
                <textarea class="form-control" id="description" name="description"
                    required><?= $product['description']; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Harga Produk:</label>
                <input type="number" class="form-control" id="price" name="price" value="<?= $product['price']; ?>"
                    required>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stok Produk:</label>
                <input type="number" class="form-control" id="stock" name="stock" value="<?= $product['stock']; ?>"
                    required>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Kategori:</label>
                <input type="number" class="form-control" id="category_id" name="category_id"
                    value="<?= $product['category_id']; ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Kasir Web Application</p>
    </footer>

    <!-- Link ke JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>