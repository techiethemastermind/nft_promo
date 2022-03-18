<?php

namespace App\Models\Ethereum;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EthereumAddress extends Model
{
    use HasFactory;
    public $fillable = ['address', 'tagName', 'balance', 'percent', 'txCount', 'rank'];
}
