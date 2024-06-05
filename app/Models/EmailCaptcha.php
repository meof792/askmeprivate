<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailCaptcha extends Model
{
    use HasFactory;
    protected $table = 'emailcaptcha';
    public $timestamps = false;

}
