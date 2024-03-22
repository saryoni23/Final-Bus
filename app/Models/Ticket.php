<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function transpotasi()
    {
        return $this->belongsTo(Transpotasi::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function track()
    {
        return $this->belongsTo(Track::class);
    }

    public function price()
    {
        return $this->hasOne(Price::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['transpotasi_id'] ?? false, function ($query, $transpotasi_id) {
            return $query->where('transpotasi_id', '=', $transpotasi_id);
        });
    }
}
