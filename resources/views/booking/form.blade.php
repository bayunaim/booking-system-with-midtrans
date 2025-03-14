<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title text-center">Form Booking</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('booking.process') }}" method="POST">
                            @csrf
                            <!-- Nama -->
                            <div class="mb-3">
                                <label for="customer_name" class="form-label">Nama:</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                            </div>

                            <!-- Layanan -->
                            <div class="mb-3">
                                <label for="service_type" class="form-label">Layanan:</label>
                                <select class="form-select" id="service_type" name="service_type" required>
                                    <option value="PS4">Rental PS4 (Rp 30.000)</option>
                                    <option value="PS5">Rental PS5 (Rp 40.000)</option>
                                </select>
                            </div>

                            <!-- Tanggal Booking -->
                            <div class="mb-3">
                                <label for="booking_date" class="form-label">Tanggal Booking:</label>
                                <input type="date" class="form-control" id="booking_date" name="booking_date" required>
                            </div>

                            <!-- Tombol Submit -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Booking</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Opsional, hanya jika Anda membutuhkan komponen JS Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
