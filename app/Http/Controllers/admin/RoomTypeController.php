<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\RoomType;
use App\Repositories\Interfaces\RoomTypeRepositoryInterface;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $roomTypeRepository;
    public function __construct(RoomTypeRepositoryInterface $roomTypeRepository)
    {
        $this->roomTypeRepository = $roomTypeRepository;
    }


    public function index()
    {
        $roomTypes = $this->roomTypeRepository->allRoomTypes();
        return view('admin.roomtype.index', compact('roomTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roomType = new RoomType();
        return view('admin.roomtype.form', compact('roomType'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:room_types,',
        ]);
        $this->roomTypeRepository->storeRoomType($data);
        return redirect('admin/roomTypes')->with('success', 'Room Type Created Successfully');
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
        $roomType = $this->roomTypeRepository->findRoomType($id);
        return view('admin.roomtype.form', compact('roomType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'nullable',
        ]);

        if(!$request->has('status')) {
            $roomTypeData['status'] = 'active';
        }

        $this->roomTypeRepository->updateRoomType($request->all(), $id);
        return redirect('admin/roomTypes')->with('updated', 'Room Type Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->roomTypeRepository->destroyRoomType($id);
        return back()->with('deleted', 'Room Type Deleted Successfully');
    }

    public function change_status(Request $request)
    {
        $roomType = RoomType::findOrFail($request->id);

        $newStatus = !$roomType->status;
        $roomType->update(['status' => $newStatus]);
        return back()->with('toggled', 'Status Successfully Toggled!');
    }

    public function search(Request $request, RoomTypeRepositoryInterface $roomTypeRepository)
    {
        $searchData = '%' . $request->search . '%';
        $roomTypes = $roomTypeRepository->searchRoomType($searchData);
        return view('admin.roomtype.index', compact('roomTypes'));
    }
}
