<?php
namespace App\Repositories;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use App\Models\admin\BookingIn;

class BookingRepository implements BookingRepositoryInterface
{
    public function allBookings()
    {
        return BookingIn::orderBy('id', 'desc')->paginate(10);
    }

    public function storeBooking($data)
    {
        return BookingIn::create($data);
    }

    public function findBooking($id)
    {
        return BookingIn::findOrFail($id);
    }

    public function updateBooking($data, $id)
    {
        $booking = BookingIn::where('id', $id)->first();

        if(isset($data['voucher'])){
            $booking->voucher = $data['voucher'];
        }

        if(isset($data['check_in'])) {
            $booking->check_in = $data['check_in'];
        }

        if(isset($data['check_out'])) {
            $booking->check_out = $data['check_out'];
        }

        if(isset($data['person'])) {
            $booking->person = $data['person'];
        }

        if(isset($data['extra'])) {
            $booking->extra = $data['extra'];
        }

        if(isset($data['remark'])) {
            $booking->remark = $data['remark'];
        }

        $booking->save();
    }

    public function destoryBooking($id)
    {
        $booking = BookingIn::findOrFail($id);
        $booking->delete();
    }

    public function searchBooking($searchData)
    {
        return BookingIn::where('voucher', 'ilike', $searchData)
            ->orWhere('check_in', 'ilike', $searchData)
            ->orWhere('check_out', 'ilike', $searchData)
            ->orWhere('person', 'ilike', $searchData)
            ->orWhere('extra', 'ilike', $searchData)
            ->orWhere('remark', 'ilike', $searchData)->get();
    }
}

?>
