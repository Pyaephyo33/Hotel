<?php
namespace App\Repositories\Interfaces;

interface UserRepositoryInterface {
    public function allUsers();
    public function storeUser($data);
    public function findUser($id);
    public function updateUser($data, $id);
    public function destoryUser($id);
    public function searchUser($searchData);
}
