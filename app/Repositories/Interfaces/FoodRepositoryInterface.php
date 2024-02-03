<?php
namespace App\Repositories\Interfaces;

interface FoodRepositoryInterface {
    public function allFoods();
    public function storeFood($data);
    public function findFood($id);
    public function updateFood($data, $id);
    public function destoryFood($id);
    public function searchFood($searchData);
}