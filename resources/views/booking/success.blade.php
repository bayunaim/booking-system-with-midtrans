<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow text-center">
                    <div class="card-header bg-success text-white">
                        <h2 class="card-title">Pembayaran Berhasil!</h2>
                    </div>
                    <div class="card-body">
                        <!-- Icon Sukses (Opsional) -->
                        <div class="mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </svg>
                        </div>

                        <!-- Pesan Sukses -->
                        <p class="lead">Terima kasih telah melakukan booking.</p>

                        <!-- Detail Booking -->
                        <div class="mb-4">
                            <p><strong>ID Booking:</strong> {{ $booking->id }}</p>
                            <p><strong>Total Harga:</strong> Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                        </div>

                        <!-- Tombol Kembali -->
                        <a href="{{ route('booking.form') }}" class="btn btn-primary">
                            Kembali ke Halaman Booking
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Opsional, hanya jika Anda membutuhkan komponen JS Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
