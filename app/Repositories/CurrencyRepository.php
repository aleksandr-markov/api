<?php


namespace App\Repositories;


use App\Models\Currency;

class CurrencyRepository implements RepositoryInterfaces\CurrencyRepositoryInterface
{

    public function all()
    {
        return Currency::all();
    }

    public function currencyId(string $currency){
        return Currency::where('symbol', $currency)->get('id')->toArray();
    }

}
