<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = ['title','content', 'startDate', 'endDate'];

    protected $hidden = ['created_at', 'updated_at'];
}
