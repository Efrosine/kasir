<?php
// Ambil daftar produk
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
    <title>Manajemen Produk - OrderApp</title>
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
                    <li class="nav-item"><a class="nav-link active" href="products.php">Manajemen Produk</a></li>
                </ul>
            </nav>
        </header>

        <h1 class="mb-4">Manajemen Produk</h1>

        <h2 class="mb-3">Tambah Produk Baru</h2>
        <form method="POST" action="add_product.php">
            <div class="mb-3">
                <label for="name" class="form-label">Nama Produk:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi Produk:</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Harga Produk:</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stok Produk:</label>
                <input type="number" class="form-control" id="stock" name="stock" required>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Kategori:</label>
                <input type="number" class="form-control" id="category_id" name="category_id" required>
            </div>

            <button type="submit" class="btn btn-primary">Tambah Produk</button>
        </form>

        <h2 class="mt-5 mb-3">Daftar Produk</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= $product['product_id']; ?></td>
                        <td><?= $product['name']; ?></td>
                        <td>Rp. <?= number_format($product['price'], 0, ',', '.'); ?></td>
                        <td><?= $product['stock']; ?></td>
                        <td>
                            <a href="edit_product.php?id=<?= $product['product_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_product.php?id=<?= $product['product_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Kasir Web Application</p>
    </footer>

    <!-- Link ke JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
