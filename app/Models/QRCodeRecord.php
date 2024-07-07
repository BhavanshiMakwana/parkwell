<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\QRCodeStatus;
use App\Models\QRCodeRegistration;

class QRCodeRecord extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['code','type','qr_code_image','status'];

    const QR_GENERATED = '0';
    const QR_SALE = '1';
    const QR_REGISTERED = '2';
    const QR_BLOCK = '3';
    const QR_DOWNLOAD = '4';

    public static $status = [
        self::QR_GENERATED => 'Generated',
        self::QR_SALE => 'Sale',
        self::QR_REGISTERED => 'Registered',
        self::QR_BLOCK => 'Block',
        self::QR_DOWNLOAD => 'Downloaded',
    ];

    const TYPE1 = 'big';
    const TYPE2 = 'small';

    public static $type = [
        self::TYPE1 => 'Big',
        self::TYPE2 => 'Small',
    ];

    public function qrCodeStatus()
    {
        return $this->hasMany(QRCodeStatus::class, 'qr_code_id');
    }

    public function qrCodeRegistrations()
    {
        // return $this->hasMany(QRCodeRegistration::class);
        return $this->hasMany(QRCodeRegistration::class, 'qr_code_id');
    }
}
