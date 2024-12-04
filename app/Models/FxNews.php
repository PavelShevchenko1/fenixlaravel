<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FxNews extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'published',
        'is_birthday',
        'image',
    ];

    public $appends = ['short_description'];
    
    public function getShortDescriptionAttribute()
    {
        return substr($this->description, 0, 200) . '...';
    }
}
