<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'organizationName'
    ];

    public function scopeSearch($query, $val)
    {
        $val = "%$val%";
        $query->where(function ($query) use ($val) {
            $query->where('organizationName', 'like', $val);
        });
    }
    public function employee()
    {
        return $this->belongsToMany(Employee::class, 'organization_id', 'id');
    }
}
