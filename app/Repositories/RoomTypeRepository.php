<?php
namespace App\Repositories;
use App\Repositories\Interfaces\RoomTypeRepositoryInterface;
use App\Models\admin\RoomType;

class RoomTypeRepository implements RoomTypeRepositoryInterface
{
    public function allRoomTypes()
    {
        return RoomType::orderBy('id', 'asc')->paginate(10);
    }

    public function storeRoomType($data)
    {
        return RoomType::create($data);
    }

    public function findRoomType($id)
    {
        return RoomType::findOrFail($id);
    }

    public function updateRoomType($data, $id)
    {
        $roomType = RoomType::where('id', $id)->first();
        if(isset($data['name'])) {
            $roomType->name = $data['name'];
        }

        if(isset($data['status'])) {
            $roomType->status = $data['status'];
        }

        $roomType->save();
    }

    public function destroyRoomType($id)
    {
        $roomType = RoomType::findOrFail($id);
        $roomType->delete();
    }

    public function searchRoomType($searchData)
    {
        return RoomType::where('name','ilike',$searchData)->orWhere('status','like', $searchData)->paginate(10);
    }
}