<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fundraising extends Model
{
    use HasFactory, SoftDeletes;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function fundraiser()
    {
        return $this->belongsTo(Fundraiser::class);
    }

    public function donaturs()
    {
        return $this->hasMany(Donatur::class)->where('is_paid', 1);
    }

    public function totalReachAmounts()
    {
        return $this->donaturs()->sum('total_amount');
    }

    public function withdrawals()
    {
        return $this->hasMany(FundraisingWithdraw::class);
    }
}
