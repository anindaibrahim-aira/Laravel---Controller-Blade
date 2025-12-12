<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta nama="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Detail Produk</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $product->nama }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">Kategori: {{ $product->category->nama ?? '-' }}</h6>
            <p class="card-text">{{ $product->description }}</p>
            <p class="card-text">Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
</body>
</html>