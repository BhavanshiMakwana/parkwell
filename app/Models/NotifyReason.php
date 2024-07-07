<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotifyReason extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['language','reasons', 'image'];
}
