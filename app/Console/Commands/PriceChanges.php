<?php

namespace App\Console\Commands;

use App\CurrencyService;
use App\Models\CurrencyHistory;
use App\Repositories\CurrencyRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PriceChanges extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:priceChanges';

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
    public function handle(CurrencyService $currencyService, CurrencyRepository $currencyRepository)
    {
        $currencies = DB::table("currencies")
            ->join("currency_users", function ($join) {
                $join->on("currencies.id", "=", "currency_users.currency_id");
            })
            ->select("currencies.symbol")
            ->get();


        foreach ($currencies as $item) {
            $currency = new CurrencyHistory();
            $currency->currency_id = $currencyRepository->currencyId($item->symbol)[0]['id'];
            $currency->amount = $currencyService->getPriceChanges($item->symbol)['amount'];
            $currency->save();
        }
        echo "success \n";

    }
}
