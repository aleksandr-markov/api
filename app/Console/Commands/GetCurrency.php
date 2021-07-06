<?php

namespace App\Console\Commands;

use App\CurrencyService;
use App\Models\currency;
use Illuminate\Console\Command;

class GetCurrency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:getCurrency';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(CurrencyService $currencyService)
    {
//        dd(count($currencyService->callCurrencyPage()));
        foreach ($currencyService->callCurrencyPage() as $item) {
                $currency = new Currency();

                $currency->name = $item['name'];
                $currency->symbol = $item['symbol'];

                $currency->save();
        }
    }
}
