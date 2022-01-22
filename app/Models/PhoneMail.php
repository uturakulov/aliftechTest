<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhoneMail extends Model
{
    use HasFactory, SoftDeletes;

    public function contacts()
    {
        return $this->belongsTo(Contact::class, 'contact_id', 'id');
    }
}
