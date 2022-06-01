<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public const TYPES = [self::TYPE_A, self::TYPE_B, self::TYPE_C];
    public const TYPE_A = 'a';
    public const TYPE_B = 'b';
    public const TYPE_C = 'c';
}
