<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'form_route',
        'to_route',
    ];
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
