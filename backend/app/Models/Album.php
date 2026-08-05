<?php

namespace App\Models;

use App\Core\Database\Model;


class Album extends Model
{

    protected static string $table = 'albums';


    protected array $fillable = [

        'name',

        'description',

        'status',

    ];


}
