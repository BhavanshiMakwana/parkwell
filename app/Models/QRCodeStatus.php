<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\QRCodeRecord;
use Illuminate\Database\Eloquent\SoftDeletes;

class QRCodeStatus extends Model
{
    // use HasFactory;

    use SoftDeletes;
    protected $fillable = ['qr_code_id', 'is_sale' , 'is_register', 'is_active'];

    public function qrCodeRecord()
    {
        return $this->belongsTo(QRCodeRecord::class);
    }
}
