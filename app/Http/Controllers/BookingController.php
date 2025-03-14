<?php

namespace App\Http\Controllers;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Booking;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function showBookingForm()
    {
        return view('booking.form');
    }

    public function processBooking(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'service_type' => 'required|in:PS4,PS5',
            'booking_date' => 'required|date',
        ]);

        // Hitung total harga
        $basePrice = ($request->service_type == 'PS4') ? 30000 : 40000;
        $isWeekend = in_array(date('N', strtotime($request->booking_date)), [6, 7]);
        $weekendSurcharge = $isWeekend ? 50000 : 0;
        $totalPrice = $basePrice + $weekendSurcharge;

        // Simpan booking ke database
        $booking = Booking::create([
            'customer_name' => $request->customer_name,
            'service_type' => $request->service_type,
            'booking_date' => $request->booking_date,
            'total_price' => $totalPrice,
        ]);

        // Setup Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Buat transaksi Midtrans
        $transactionDetails = [
            'order_id' => $booking->id,
            'gross_amount' => $totalPrice,
        ];

        $customerDetails = [
            'first_name' => $request->customer_name,
        ];

        $midtransParams = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
            'callbacks' => [
                'finish' => route('booking.success'), // Redirect setelah pembayaran selesai
            ],
        ];

        $paymentUrl = Snap::createTransaction($midtransParams)->redirect_url;

        // Redirect ke halaman pembayaran Midtrans
        return redirect($paymentUrl);
    }

    public function handleCallback(Request $request)
    {
        $payload = $request->all();

        // Verifikasi signature key (opsional, tetapi direkomendasikan)
        $hashed = hash('sha512', $payload['order_id'] . $payload['status_code'] . $payload['gross_amount'] . config('midtrans.server_key'));
        if ($hashed != $payload['signature_key']) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // Cari booking berdasarkan order_id
        $booking = Booking::find($payload['order_id']);
        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        // Update status pembayaran
        if ($payload['transaction_status'] == 'settlement') {
            $booking->payment_status = 'success';
        } elseif ($payload['transaction_status'] == 'pending') {
            $booking->payment_status = 'pending';
        } elseif ($payload['transaction_status'] == 'expire') {
            $booking->payment_status = 'failed';
        }

        // Simpan midtrans_transaction_id
        $booking->midtrans_transaction_id = $payload['transaction_id'];
        $booking->save();

        return response()->json(['message' => 'Callback handled']);
    }

    public function bookingSuccess(Request $request)
    {
        $orderId = $request->order_id;
        $booking = Booking::find($orderId);

        if (!$booking) {
            return redirect()->route('booking.form')->with('error', 'Booking tidak ditemukan.');
        }

        return view('booking.success', compact('booking'));
    }
}
