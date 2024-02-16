<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\{BookingIn,Room};
use App\Repositories\Interfaces\BookingRepositoryInterface;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $bookingRepository;
    public function __construct(BookingRepositoryInterface $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }
    public function index()
    {
        $bookings = $this->bookingRepository->allBookings();
        // $bookings = BookingIn::all();
        return view('admin.booking.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $booking = new BookingIn();
        $rooms = Room::where('status', 1)->get();
        return view('admin.booking.form', compact('booking', 'rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'person' => 'required|numeric',
            'extra' => 'required|numeric',
            'remark' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            // Generate voucher number
            $lastVoucher = BookingIn::max('voucher');
            $lastNumber = $lastVoucher ? (int)substr($lastVoucher, strpos($lastVoucher, '-') + 1) : 0;
            $voucher = 'VOU-' . ($lastNumber + 1);

            // Create booking
            $booking = BookingIn::create([
                'voucher' => $voucher,
                'check_in' => $request->check_in,
                'check_out' => $request->check_out,
                'person' => $request->person,
                'extra' => $request->extra,
                'remark' => $request->remark,
            ]);

            // Attach room to booking
            $booking->rooms()->attach($request->room_id);

            DB::commit();

            return redirect('admin/bookings')->with('success', 'New Booking Added!');
        } catch (\Exception $e) {
            DB::rollback();

            return back()->with('error', 'Failed to add new booking, Please try again');
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
        $booking = $this->bookingRepository->findBooking($id);
        $rooms = Room::where('status', 1)->get();
        return view('admin.booking.form', compact('booking', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'person' => 'required|numeric',
            'extra' => 'required|numeric',
            'remark' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            // Find the booking by ID
            $booking = BookingIn::findOrFail($id);

            // Update booking details
            $booking->update([
                'check_in' => $request->check_in,
                'check_out' => $request->check_out,
                'person' => $request->person,
                'extra' => $request->extra,
                'remark' => $request->remark,
            ]);

            // Sync room for booking
            $booking->rooms()->sync([$request->room_id]);

            DB::commit();

            return redirect('admin/bookings')->with('success', 'Booking Updated Successfully!');
        } catch (\Exception $e) {
            DB::rollback();

            return back()->with('error', 'Failed to update booking. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $this->bookingRepository->destoryBooking($id);
        return back()->with('deleted', 'Booking Deleted Successfully');
    }

    public function search(Request $request, BookingRepositoryInterface $bookingRepository)
    {
        $searchData = '%' . $request->search . '%';
        $search = $request->search;
        $bookings = $bookingRepository->searchBooking($searchData);
        return view('admin.booking.index', compact('search', 'bookings'));
    }
}
