<?php

namespace App;

use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    use Notifiable;

    protected $fillable = [
        'name', 'section_id', 'slug'
    ];

    public function section()
    {
        return $this->belongsTo('App\Section')->select('id', 'name');
    }

    public function parent()
    {
        return $this->belongsTo('App\Category', 'parent_id', 'id')->select('id', 'name', 'parent_id', 'section_id', 'slug');
    }
}
