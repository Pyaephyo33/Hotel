<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Guest;
use App\Repositories\Interfaces\GuestRepositoryInterface;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $guestRepository;
    public function __construct(GuestRepositoryInterface $guestRepository)
    {
        $this->guestRepository = $guestRepository;
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
        $data = $request->validate([
            'name' => 'required|string',
            'identity_card' => 'required',
            'father_name' => 'required',
            'age' => 'required',
        ]);

        // $this->guestRepository->storeGuest($data);
        // return redirect('admin/guests')->with('success', 'Guest Created Successfully!');
        try {
            $this->guestRepository->storeGuest($data);
            session()->flash('success', 'Food Created Successfully');
        } catch (\Exception $e) {
            session()->flash('error', 'Error occurred while creating food: ' . $e->getMessage());
        }
        return redirect('admin/guests');
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
            // return redirect('admin/guests')->with('updated', 'Guest Updated Successfully!');
            session()->flash('updated', 'Guest Updated Successfully!');
        } catch (\Exception $e) {
            // DB::rollBack();
            session()->flash('error', 'Error occurred while creating food: ' . $e->getMessage());
        }
        return redirect('admin/guests');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->guestRepository->destoryGuest($id);
        // return back()->with('deleted', 'Guest Deleted Successfully');
        session()->flash('deleted', 'Room Type Successfully Deleted!');
        return back();
    }

    public function search(Request $request, GuestRepositoryInterface $guestRepository)
    {
        $searchData = '%' . $request->search . '%';
        $search = $request->search;
        $guests = $guestRepository->searchGuest($searchData);
        return view('admin.guest.index', compact('search', 'guests'));
    }
}
