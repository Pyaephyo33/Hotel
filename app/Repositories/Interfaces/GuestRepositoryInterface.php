<?php
namespace App\Repositories\Interfaces;

interface GuestRepositoryInterface {
    public function allGuests();
    public function storeGuest($data);
    public function findGuest($id);
    public function updateGuest($data, $id);
    public function destoryGuest($id);
    public function searchGuest($searchData);
}
