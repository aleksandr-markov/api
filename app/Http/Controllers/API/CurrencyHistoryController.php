<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\CurrencyHistoryResource;
use App\Models\CurrencyHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurrencyHistoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $history = DB::table("currency_users")
            ->join("currency_histories", function ($join) {
                $join->on("currency_users.currency_id", "=", "currency_histories.currency_id");
            })
            ->select("currency_histories.currency_id", "currency_histories.amount","currency_histories.created_at" )
            ->where("currency_users.user_id", "=", $id)
            ->orderBy('created_at', 'DESC')
            ->get();

            return $this->sendResponse(new CurrencyHistoryResource($history), 'Currencies history fetched.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
