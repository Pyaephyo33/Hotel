<?php
namespace App\Repositories\Interfaces;

interface BookingRepositoryInterface {
    public function allBookings();
    public function storeBooking($data);
    public function findBooking($id);
    public function updateBooking($data, $id);
    public function destoryBooking($id);
    public function searchBooking($searchData);
}
