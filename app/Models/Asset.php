<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
    protected $fillable = [
        'assetTag',
        'assetName',
        'status',
        'model',
        'manufacture_id',
        'ram',
        'processor',
        'windows',
        'antivirus',
        'employee_id'
    ];
    public function manufacture()
    {
        return $this->belongsTo(Manufacture::class, 'manufacture_id', 'id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
    public function scopeSearch($query, $val)
    {
        $val = "%$val%";
        $query->where(function ($query) use ($val) {
            $query->where('assetTag', 'like', $val)
                ->orWhere('assetName', 'like', $val)

                ->orWhere('status', 'like', $val);
        });
    }
}
