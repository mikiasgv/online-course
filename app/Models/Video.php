<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getThumbnailAttribute()
    {
        return $this->thumbnail_image ? '/videos/' . $this->uid . '/' . $this->thumbnail_image : '/videos/' . 'default.png';
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}
