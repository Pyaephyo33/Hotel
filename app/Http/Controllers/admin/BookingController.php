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
        return view('admin.booking.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $booking = new BookingIn();
        $rooms = Room::where('status', 1 || true)->get();
        return view('admin.booking.index', compact('booking', 'rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'check_in' => 'required',
            'check_out' => 'required',
            'person' => 'required',
            'extra' => 'required',
            'remark' => 'required',
            'room_id' => 'required',
        ]);

        // Generate voucher number
        $lastVoucher = BookingIn::max('voucher');
        $lastNumber = $lastVoucher ? (int)substr($lastVoucher, strpos($lastVoucher, '-') + 1) : 0;
        $voucher = 'VOU-' . ($lastNumber + 1);

        try {
            DB::beginTransaction();

            $booking = BookingIn::create([
                'voucher' => $voucher,
                'check_in' => $request->check_in,
                'check_out' => $request->check_out,
                'person' => $request->person,
                'extra' => $request->extra,
                'remark' => $request->remark,
            ]);

            DB::table('booking_room')->insert([
                'booking_id' => $booking->id,
                'room_id' => $request->room_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();
            return redirect('admin/bookings')->with('success', 'New Booking Added!');
        } catch (\Exception $e) {
            DB::rollback();

            return back()->with('deleted', 'Failed to add new booking, Please try again');
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

    public function search(Request $request, BookingRepositoryInterface $bookingRepository)
    {
        $searchData = '%' . $request->search . '%';
        $search = $request->search;
        $bookings = $bookingRepository->searchBooking($searchData);
        return view('admin.booking.index', compact('search', 'bookings'));
    }
}
