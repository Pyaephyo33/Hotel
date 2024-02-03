<?php
namespace App\Repositories;
use App\Repositories\Interfaces\FoodRepositoryInterface;
use App\Models\admin\Food;

class FoodRepository implements FoodRepositoryInterface
{
    public function allFoods()
    {
        return Food::orderBy('id', 'desc')->paginate(10);
    }

    public function storeFood($data)
    {
        return Food::create($data);
    }

    public function findFood($id)
    {
        return Food::findOrFail($id);
    }

    public function updateFood($data, $id)
    {
        $food = Food::where('id', $id)->first();

        if(isset($data['name'])) {
            $food->name = $data['name'];
        }

        if(isset($data['price'])) {
            $food->price = $data['price'];
        }

        if(isset($data['status'])) {
            $food->status = $data['status'];
        }

        $food->save();
    }

    public function destoryFood($id)
    {
        $food = Food::findOrFail($id);
        $food->delete();
    }

    public function searchFood($searchData)
    {
        return Food::where('name', 'ilike', $searchData)
        ->orWhere('price', 'like', $searchData)
        ->orWhere('status', 'like', $searchData)->get();
    }
}

?>