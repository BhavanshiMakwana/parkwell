<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\QRCodeRegistration;

class User extends Authenticatable  implements JWTSubject
{
    use HasApiTokens;
    use Notifiable;
    use SoftDeletes;

    protected $fillable = ['name','email', 'country_code' ,'mobile', 'address','password', 'state', 'zip_code', 'gender', 'birthdate','city', 'about_you', 'role', 'otp', 'status', 'is_inquiry' , 'cover_img', 'profile_img', 'pin_number', 'device_token'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password){
        $this->attributes['password'] = bcrypt($password);
    }

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    public static $status = [
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_INACTIVE => 'In Active',
    ];

    public function getJWTIdentifier() {
        return $this->getKey();
    }
    public function getJWTCustomClaims() {
        return [];
    }

    public function qrCodeRegistrations()
    {
        // return $this->hasMany(QRCodeRegistration::class);
        return $this->hasMany(QRCodeRegistration::class, 'admin_id');
    }

}
