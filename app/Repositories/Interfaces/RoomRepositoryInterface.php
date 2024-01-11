<?php
namespace App\Repositories\Interfaces;

interface RoomRepositoryInterface {
    public function allRooms();
    public function storeRoom($data);
    public function findRoom($id);
    public function updateRoom($data, $id);
    public function destroyRoom($id);
    public function searchRoom($searchData);
}

?>
