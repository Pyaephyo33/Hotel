<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Room extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function roomType() {
        return $this->belongsTo(RoomType::class, 'room_type_id')->withDefault();
    }

    public function generateQrCode()
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
        ];

        return QrCode::size(50)->generate(json_encode($data));
    }

    public function bookings()
    {
        return $this->belongsToMany(BookingIn::class);
    }
}
