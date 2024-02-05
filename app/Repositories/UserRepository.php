<?php 
namespace App\Repositories;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function allUsers()
    {
        return User::orderBy('id', 'desc')->paginate(10);
    }

    public function storeUser($data)
    {
        return User::create($data);
    }

    public function findUser($id)
    {
        return User::findOrFail($id);
    }

    public function updateUser($data, $id)
    {
        $user = User::where('id', $id)->first();

        if(isset($data['name'])) {
            $user->name = $data['name'];
        }

        if(isset($data['email'])) {
            $user->email = $data['email'];
        }

        if(isset($data['password'])) {
            $user->password = $data['password'];
        }

        $user->save();
    }

    public function destoryUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }

    public function searchUser($searchData)
    {
        return User::where('name', 'ilike', $searchData)->get();
    }
}
?>