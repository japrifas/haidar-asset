<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Manufacture extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',

    ];

    public function scopeSearch($query, $val)
    {
        $val = "%$val%";
        $query->where(function ($query) use ($val) {
            $query->where('name', 'like', $val);
        });
    }
    public function asset()
    {
        return $this->hasOne(Asset::class, 'id', 'manufacture_id');
    }
}
