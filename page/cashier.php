<?php
// Koneksi API untuk mengambil daftar produk
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://kasir.efrosine.my.id/api/products',
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
$products = json_decode($response, true);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Kasir - OrderApp</title>
    <!-- Link ke Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 800px;
        }

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

        <h1 class="mb-4">Halaman Kasir</h1>

        <!-- Form Transaksi -->
        <form method="POST" action="process_transaction.php">
            <div class="mb-3">
                <label for="customer_id" class="form-label">ID Pelanggan:</label>
                <input type="text" class="form-control" id="customer_id" name="customer_id" required>
            </div>

            <div class="mb-3">
                <label for="products" class="form-label">Pilih Produk:</label>
                <select class="form-select" name="products[]" id="products" multiple required>
                    <?php foreach ($products as $product): ?>
                        <option value="<?= $product['product_id']; ?>">
                            <?= $product['name']; ?> - Rp. <?= number_format($product['price'], 0, ',', '.'); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="payment_method" class="form-label">Metode Pembayaran:</label>
                <select class="form-select" name="payment_method" required>
                    <option value="Cash">Tunai</option>
                    <option value="Credit Card">Kartu Kredit</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Proses Transaksi</button>
        </form>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Kasir Web Application</p>
    </footer>

    <!-- Link ke JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>