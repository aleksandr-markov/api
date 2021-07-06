<?php


namespace App;


use Illuminate\Support\Facades\Http;

class CurrencyService
{

    public function callCurrencyPage()
    {
        $url = "https://www.coinbase.com/api/v2/assets/search?&filter=all&include_prices=true&limit=50&order=asc&page=1&query=&resolution=day&sort=rank";
        $response = Http::get($url);

        $totalPage = $response->json()['pagination']['total_pages'];
        $currency = [];

        for ($i = 1; $i <= $totalPage; $i++) {
            $page = Http::get('https://www.coinbase.com/api/v2/assets/search?&filter=all&include_prices=true&limit=50&order=asc&page='."$i".'&query=&resolution=day&sort=rank');
            foreach ($page->json()['data'] as $item) {
                $currency[] = ['symbol' => $item['symbol'], 'name' => $item['name']];
            }
        }

        return $currency;
    }

    public function getPriceChanges(string $symbol, string $currency = 'USD')
    {
        $priceChange = Http::get("https://api.coinbase.com/v2/prices/$symbol-$currency/buy");

        return $priceChange->json()['data'];
    }

}
