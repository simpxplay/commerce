<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    public const TYPES = [self::TYPE_R, self::TYPE_S, self::TYPE_V];
    public const TYPE_V = 'v';
    public const TYPE_R = 'r';
    public const TYPE_S = 's';
}
