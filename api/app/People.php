<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $table = 'peoples';

    public $timestamps = true;

    protected $fillable = [
        'fullname', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static $minified = ['id', 'fullname', 'is_active'];

    public static $rules = [
        'fullname' => 'required|min:3|max:250',
        'is_active' => 'boolean'
    ];

    public function contacts()
    {
        return $this->hasMany('App\PeopleContact');
    }
}