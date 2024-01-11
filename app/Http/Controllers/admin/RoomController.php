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
        try {
            DB::beginTransaction();

            $data = $request->validate([
                'picture' => 'nullable|image|mimes:jpeg,jpg,png,gif',
                'name' => 'required',
                'room_type_id' => 'required',
                'person' => 'required',
                'price' => 'required',
            ]);

            // generate a random code
            $data['code'] = rand(1000, 9999);

            // check if a file is uploaded
            if ($request->hasFile('picture')) {
                // handle image upload
                $imageName = time() . '.' . $request->picture->extension();
                $request->picture->move(public_path('rooms'), $imageName);

                // add image path to the data array
                $data['picture'] = $imageName;
            } else {
                // If no file is uploaded, you might want to set a default image or handle it based on your requirements.
                // For example, set a default image path.
                $data['picture'] = 'No Image Available';
            }

            // pass data to the repository
            $this->roomRepository->storeRoom($data);

            DB::commit();

            return redirect('admin/rooms')->with('success', 'Room Created Successfully!');
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
        $roomTypes = RoomType::all();
        $room = $this->roomRepository->findRoom($id);
        return view('admin.room.form', compact('roomTypes', 'room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();

            $data = $request->validate([
                'picture' => 'required|image|mimes:jpeg,jpg,png,gif',
                'name' => 'required',
                'room_type_id' => 'required',
                'person' => 'required',
                'price' => 'required',
            ]);

            // check if a file is uploaded
            if ($request->hasFile('picture')) {
                // handle image upload
                $imageName = time() . '.' . $request->picture->extension();
                $request->picture->move(public_path('rooms'), $imageName);

                // add image path to the data array
                $data['picture'] = $imageName;
            } else {
                // If no file is uploaded, you can set $data['picture'] to a default image path or keep it as null.
                // For example, set it to null if you don't want to display any image.
                $data['picture'] = null;
            }
            $this->roomRepository->updateRoom($id, $data);

            DB::commit();

            return redirect('admin/rooms')->with('updated', 'Room Updated Successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Error Occurred:' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->roomRepository->destroyRoom($id);
        return back()->with('deleted', 'Room Deleted Successfully');
    }

    public function change_status(Request $request)
    {
        $room = Room::findOrFail($request->id);

        $newStatus = !$room->status;
        $room->update(['status' => $newStatus]);
        return back()->with('toggled', 'Status Successfully Toggled!');
    }

    public function search(Request $request, RoomRepositoryInterface $roomRepository)
    {
        $searchData = '%' . $request->search . '%';
        $search = $request->search;
        $rooms = $roomRepository->searchRoom($searchData);
        return view('admin.room.index', compact('search', 'rooms'));
    }
}
