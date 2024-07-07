<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\QRCodeRecord;
use App\Models\User;

class QRCodeRegistration extends Model
{
    use SoftDeletes;
    protected $fillable = [ 'user_id', 'qr_code_id', 'vehicle_plate_number', 'vehicle_type', 'active_date', 'is_active'];

    public function qrCodeRecord()
    {
        return $this->belongsTo(QRCodeRecord::class, 'qr_code_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
