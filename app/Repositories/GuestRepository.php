<?php
namespace App\Repositories;
use App\Repositories\Interfaces\GuestRepositoryInterface;
use App\Models\admin\Guest;

class GuestRepository implements GuestRepositoryInterface
{
    public function allGuests()
    {
        return Guest::orderBy('id', 'desc')->paginate(10);
    }

    public function storeGuest($data)
    {
        return Guest::create($data);
    }

    public function findGuest($id)
    {
        return Guest::findOrFail($id);
    }

    public function updateGuest($data, $id)
    {
        $guest = Guest::where('id', $id)->first();

        if(isset($data['name'])) {
            $guest->name = $data['name'];
        }

        if(isset($data['identity_card'])) {
            $guest->identity_card = $data['identity_card'];
        }

        if(isset($data['father_name'])) {
            $guest->father_name = $data['father_name'];
        }

        if(isset($data['age'])) {
            $guest->age = $data['age'];
        }

        $guest->save();
    }

    public function destoryGuest($id)
    {
        $guest = Guest::findOrFail($id);
        $guest->delete();
    }

    public function searchGuest($searchData)
    {
        return Guest::where('name', 'ilike', $searchData)->orWhere('identity_card', 'like', $searchData)->orWhere('father_name', 'like', $searchData)->orWhere('age', 'like', $searchData)->get();
    }
}

?>
