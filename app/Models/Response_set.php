<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Response_set extends Authenticatable
{
    use Notifiable, HasApiTokens, HasFactory;
    protected $primaryKey = 'responseSetID';
}
