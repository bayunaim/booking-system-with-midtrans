<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/booking', [BookingController::class, 'showBookingForm'])->name('booking.form');
Route::post('/booking/process', [BookingController::class, 'processBooking'])->name('booking.process');
Route::get('/booking/success', [BookingController::class, 'bookingSuccess'])->name('booking.success');
Route::post('/booking/callback', [BookingController::class, 'handleCallback'])->name('booking.callback');
