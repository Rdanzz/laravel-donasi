<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FundraisingPhase extends Model
{
    use HasFactory, SoftDeletes;

    public function fundraising()
    {
        return $this->belongsTo(Fundraising::class);
    }
}
