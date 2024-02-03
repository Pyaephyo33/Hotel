<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Food;
use Illuminate\Http\Request;
use App\Models\admin\Guest;
use App\Repositories\Interfaces\GuestRepositoryInterface;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $guestRepository;
    public function __construct(GuestRepositoryInterface $guestRepository)
    {
        $this->guestRepository = $guestRepository;
    }

    public function index()
    {
        $guests = $this->guestRepository->allGuests();
        return view('admin.guest.index', compact('guests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $guest = new Guest();
        return view('admin.guest.form', compact('guest'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->validate([
                'name' => 'required|string',
                'identity_card' => 'required',
                'father_name' => 'required',
                'age' => 'required',
            ]);

            $this->guestRepository->storeGuest($data);

            DB::commit();

            return redirect('admin/guests')->with('success', 'Guest Created Successfully!');
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
        $guest = $this->guestRepository->findGuest($id);
        return view('admin.guest.form', compact('guest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();

            $data = $request->validate([
                'name' => 'required',
                'identity_card' => 'required',
                'father_name' => 'required',
                'age' => 'required',
            ]);

            $this->guestRepository->updateGuest($data, $id);

            DB::commit();

            return redirect('admin/guests')->with('updated', 'Guest Updated Successfully!');
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
        $this->guestRepository->destoryGuest($id);
        return back()->with('deleted', 'Guest Deleted Successfully');
    }

    public function search(Request $request, GuestRepositoryInterface $guestRepository)
    {
        $searchData = '%' . $request->search . '%';
        $search = $request->search;
        $guests = $guestRepository->searchGuest($searchData);
        return view('admin.guest.index', compact('search', 'guests'));
    }
}
