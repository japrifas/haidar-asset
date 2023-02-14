<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'asset_id',
        'employee_id',
        'checkin_date',
        'action',
        'note',
    ];
}
