<?php 
namespace App\Repositories\Interfaces;

interface RoomTypeRepositoryInterface {
    public function allRoomTypes();
    public function storeRoomType($data);
    public function findRoomType($id);
    public function updateRoomType($data, $id);
    public function destroyRoomType($id);
    public function searchRoomType($searchData);
}

?>