<?php

namespace App\Models;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'employeeId',
        'employeeName',
        'organization_id',
        'jobPosition',
        'email'
    ];
    public function scopeSearch($query, $val)
    {
        $val = "%$val%";
        $query->where(function ($query) use ($val) {
            $query->where('employeeName', 'like', $val)
                ->orWhere('employeeId', 'like', $val)

                ->orWhere('jobPosition', 'like', $val)
                ->orWhere('email', 'like', $val);
        });
    }

    public function organization()
    {
        return $this->hasOne(Organization::class,  'id', 'organization_id');
    }
    public function asset()
    {
        return $this->hasOne(Asset::class, 'id', 'employee_id');
    }
}
