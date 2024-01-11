<?php
namespace App\Repositories;
use App\Repositories\Interfaces\RoomRepositoryInterface;
use App\Models\admin\Room;

class RoomRepository implements RoomRepositoryInterface
{
    public function allRooms()
    {
        return Room::orderBy('id', 'desc')->paginate(10);
    }

    public function storeRoom($data)
    {
        return Room::create($data);
    }

    public function findRoom($id)
    {
        return Room::findOrFail($id);
    }

    public function updateRoom($data, $id)
    {
        $room = Room::where('id', $id)->first();

        if(isset($data['picture'])) {
            $room->picture = $data['picture'];
        }

        if(isset($data['name'])) {
            $room->name = $data['name'];
        }

        if(isset($data['room_type_id'])) {
            $room->room_type_id = $data['room_type_id'];
        }

        if(isset($data['person'])) {
            $room->person = $data['person'];
        }

        if(isset($data['price'])) {
            $room->price = $data['price'];
        }

        if(isset($data['code'])) {
            $room->code = $data['code'];
        }

        if(isset($data['status'])) {
            $room->status = $data['status'];
        }

        $room->save();
    }

    public function destroyRoom($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();
    }

    public function searchRoom($searchData)
    {
        return Room::where('name', 'ilike', $searchData)->orWhere('person', 'like', $searchData)->orWhere('price', 'like', $searchData)->orWhere('code', 'like', $searchData)->orWhere('status', 'like', $searchData)->orWherehas('roomType', function($roomType) use($searchData) {
            $roomType->where('name', 'like', $searchData);
        })->get();
    }
}

?>
