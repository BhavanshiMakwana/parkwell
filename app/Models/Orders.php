<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id','code_id','price'];

    public function User(){
        return $this->belongsTo('','user_id');
    }

    public function Code(){
        return $this->belongsTo('App\Models\QRCodeRecord','code_id');
    }
}
