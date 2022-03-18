<?php

namespace App\Http\Controllers\Admin\Ethereum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ethereum\EthereumAddress;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Client;

class WalletController extends Controller
{
    private $client;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->client = new Client([
            'timeout'   => 10,
            'verify'    => false
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $wallets = EthereumAddress::paginate(25);
        return view('ethereum.wallet', compact('wallets'));
    }

    public function update()
    {
        for($i = 0; $i < 4; $i++) {
            try {
                $response = $this->client->get('https://etherscan.io/accounts/' . ($i + 1));
                $content  = $response->getBody()->getContents();
                $crawler  = new Crawler( $content );
                $arrData  = $crawler->filter('div#ContentPlaceHolder1_divTable tbody tr')
                    ->each(function (Crawler $node, $i) {
    
                        $address = $this->hasContent($node->filter('td')->eq(1)->filter('a')) != false ? $node->filter('td')->eq(1)->filter('a')->text() : '';
                        $tagName = $this->hasContent($node->filter('td')->eq(2)) != false ? $node->filter('td')->eq(2)->text() : '';
                        $balance = $this->hasContent($node->filter('td')->eq(3)) != false ? $node->filter('td')->eq(3)->text() : '';
                        $percent = $this->hasContent($node->filter('td')->eq(4)) != false ? $node->filter('td')->eq(4)->text() : '';
                        $txCount = $this->hasContent($node->filter('td')->eq(5)) != false ? $node->filter('td')->eq(5)->text() : '';

                        $balanceDigit = str_replace(' Ether', '', $balance);
                        $percentDigit = str_replace('%', '', $percent);
    
                        return [
                            'address' => $address,
                            'tagName' => $tagName,
                            'balance' => $balanceDigit,
                            'percent' => $percentDigit,
                            'txCount' => (int)$txCount
                        ];
                    }
                );

                foreach($arrData as $key => $item) {
    
                    $rlt = EthereumAddress::updateOrCreate(
                        [
                            'address' => $item['address']
                        ],
                        [
                            'tagName' => $item['tagName'],
                            'balance' => $item['balance'],
                            'percent' => $item['percent'],
                            'txCount' => $item['txCount'],
                            'rank'    => $key + 25 * $i + 1
                        ]
                    );
                }
    
            } catch (\Exception $e) {
                \Log::info('The Page: ' . $i . ', Error:' . $e->getMessage());
            }
        }

        return response([
            'success' => true
        ], 200);
    }

    /**
     * Check is content available
     */
    private function hasContent($node)
    {
        return $node->count() > 0 ? true : false;
    }
}
