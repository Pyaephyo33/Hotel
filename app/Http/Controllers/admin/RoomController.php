<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\{Room, RoomType};
use App\Repositories\Interfaces\RoomRepositoryInterface;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $roomRepository;
    public function __construct(RoomRepositoryInterface $roomRepository)
    {
        $this->roomRepository= $roomRepository;
    }


    public function index()
    {
        $rooms = $this->roomRepository->allRooms();
        return view('admin.room.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $room = new Room();
        $roomTypes = RoomType::all();
        return view('admin.room.form', compact('room', 'roomTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();

            $data = $request->validate([
                'name' => 'required',
                'room_type_id' => 'required',
                'person' => 'required',
                'price' => 'required',
                'picture' => 'required|image|mimes:jpeg,jpg,png,gif',
            ]);

            // generate a random code
            $data['code'] = rand(1000, 9999);

            // handle image upload
            $imageName = time().'.'.$request->picture->extension();
            $request->picture->move(public_path('rooms'), $imageName);

            // add image path to the data array
            $data['picture'] = $imageName;

            // pass data to the repository
            $this->roomRepository->storeRoom($data);

            DB::commit();

            return redirect('admin/rooms')->with('success', 'Room Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
