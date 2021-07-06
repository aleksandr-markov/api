<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\CurrencyUserResource;
use App\Models\CurrencyUser;
use App\Models\User;
use Illuminate\Http\Request;

class CurrencyUserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        return abort('404');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->currency_id);
        $userId = 1;
        $countUserCurrencies = CurrencyUser::whereUserId($userId)->count();
        if ($countUserCurrencies < 5) {
//            $user = User::findOrFail($userId);

        $userCurrency = new CurrencyUser();

        $userCurrency->user_id = $userId;
        $userCurrency->currency_id = $request->currency_id;

        $userCurrency->save();

//        dd($userCurrency->toArray());
        return $this->sendResponse($userCurrency->toArray(), 'Currency for user added');
        } else {
            return $this->sendError('The maximum number of currencies a user has is five');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return $this->sendResponse(new CurrencyUserResource($user), 'Currencies fetched.');
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
