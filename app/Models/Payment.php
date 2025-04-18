<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'student_id', 'amount', 'payment_date', 'payment_type', 'status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
