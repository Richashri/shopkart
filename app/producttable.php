<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class producttable extends Model
{
     use Notifiable;
    //

    protected $fillable = [
        'name', 'section_id','parent_id'
    ];
}
