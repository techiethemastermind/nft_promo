<?php

namespace App\Http\Controllers\Api\Ethereum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Ethereum\EthereumWallet;

class WalletController extends Controller
{
    /**
     * Get Wallet Data
     */
    public function walletData(Request $request)
    {
        $data = $request->validate([
            'address' => 'required'
        ]);
        $item = EthereumWallet::where('address', $data['address'])->first();
        
        if(!empty($item)) {

            $data = [
                'transactionsCount' => $item['transactionsCount'],
                'confirmedBalance'  => [
                    'amount' => $item['confirmed_balance_amount'],
                    'unit'   => $item['confirmed_balance_unit']
                ],
                'totalReceived' => [
                    'amount' => $item['received_amount'],
                    'unit'   => $item['received_unit']
                ],
                'totalSpent' => [
                    'amount' => $item['spent_amount'],
                    'unit'   => $item['spent_unit']
                ],
                'incomingTransactionsCount' => $item['incomeTransactions'],
                'outgoingTransactionsCount' => $item['outgoingTransactions']
            ];

            return response([
                'response' => $data
            ], 200);

        } else {

            // Get Data from API
            $chain    = 'ethereum';
            $network  = config('keys.ethereum.network');
            $address  = $data['address'];
            $endPoint = "blockchain-data/{$chain}/{$network}/addresses/{$address}";
            $response = Http::cryptoapi()->get($endPoint);
            $jsonData = $response->json();
    
            return response([
                'response' => $jsonData['data']['item']
            ], 200);
        }
    }
}
