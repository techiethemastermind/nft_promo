<?php

namespace App\Models\Ethereum;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EthereumWallet extends Model
{
    use HasFactory;
    
    public $fillable = [
        'address', 
        'transactionsCount', 
        'confirmed_balance_amount',
        'confirmed_balance_unit',
        'received_amount',
        'received_unit',
        'spent_amount',
        'spent_unit',
        'incomeTransactions',
        'outgoingTransactions',
        'rank'
    ];
}
