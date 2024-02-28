<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\RoomType;
use App\Repositories\Interfaces\RoomTypeRepositoryInterface;
use RealRashid\SweetAlert\Facades\Alert;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $roomTypeRepository;
    public function __construct(RoomTypeRepositoryInterface $roomTypeRepository)
    {
        $this->roomTypeRepository = $roomTypeRepository;
        $this->middleware(function($request, $next) {
            if (session('success')) {
                Alert::success(session('success'));
            } 
            if (session('updated')) {
                Alert::success(session('updated'));
            }
            if (session('error')) {
                Alert::error(session('error'));
            }
            if (session('toggled')) {
                Alert::success(session('toggled'));
            }
            if (session('deleted')) {
                Alert::success(session('deleted'));
            }
            return $next($request);
        });
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
            'name' => 'required|unique:room_types,name',
        ]);
        // $this->roomTypeRepository->storeRoomType($data);
        // return redirect('admin/roomTypes')->with('success', 'Room Type Created Successfully');
        try {
            $this->roomTypeRepository->storeRoomType($data);
            session()->flash('success', 'Food Created Successfully');
        } catch (\Exception $e) {
            session()->flash('error', 'Error occurred while creating food: ' . $e->getMessage());
        }
        return redirect('admin/roomTypes');
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

        // $this->roomTypeRepository->updateRoomType($request->all(), $id);
        // return redirect('admin/roomTypes')->with('updated', 'Room Type Updated Successfully');

        try {
            $this->roomTypeRepository->updateRoomType($request->all(), $id);
            session()->flash('updated', 'Food Updated Successfully');
        } catch (\Exception $e) {
            session()->flash('error', 'Error occurred while creating food: ' . $e->getMessage());
        }
        return redirect('admin/roomTypes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->roomTypeRepository->destroyRoomType($id);
        // return redirect('admin/roomTypes')->with('deleted', 'Room Type Deleted Successfully');
        session()->flash('deleted', 'Room Type Successfully Deleted!');
        return back();
    }

    public function change_status(Request $request)
    {
        $roomType = RoomType::findOrFail($request->id);

        $newStatus = !$roomType->status;
        $roomType->update(['status' => $newStatus]);
        // return back()->with('toggled', 'Status Successfully Toggled!');
        session()->flash('toggled', 'Status Successfully Toggled!');
        return back();
    }

    public function search(Request $request, RoomTypeRepositoryInterface $roomTypeRepository)
    {
        $searchData = '%' . $request->search . '%';
        $roomTypes = $roomTypeRepository->searchRoomType($searchData);
        return view('admin.roomtype.index', compact('roomTypes'));
    }
}
