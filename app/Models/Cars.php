<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cars extends Model {

    protected $table = 'cars';

    protected $fillable = [
        'name',
        'description',
        'model',
        'date'
    ];

    protected $casts = [
        'date' => 'Timestamp'
    ];

    // protected $dates = [
    //     'date',
    // ];

    public $timestamps = false;

}