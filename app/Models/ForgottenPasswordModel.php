<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForgottenPasswordModel extends Model
{
    use HasFactory;

    protected $table = 'forgotten_password';

    public $timestamps = false;

    protected $fillable = ['id', 'email', 'token', 'time'];
}
