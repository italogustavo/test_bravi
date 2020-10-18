<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeopleContact extends Model
{
    protected $table = 'people_contacts';

    public $timestamps = true;

    protected $fillable = [
        'people_id', 'whatsapp', 'phone', 'email', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static $minified = ['id', 'people_id', 'whatsapp', 'phone', 'email', 'is_active'];

    public static $rules = [
        'people_id' => 'required|integer|exists:peoples,id',
        'whatsapp' => 'min:7|max:20',
        'phone' => 'min:7|max:20',
        'email' => 'email|max:100',
        'is_active' => 'boolean'
    ];

    public function people()
    {
        return $this->belongsTo('App\People');
    }
}