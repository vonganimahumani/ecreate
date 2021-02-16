<?php

namespace App\Http\Controllers;

use App\Currency as Currency;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CurrenciesController extends Controller
{
    public function index()
    {

        $currency = Currency::where([['user_id', '=', Auth::user()->id]])->first();
        $date = Carbon::now()->format('Y-m-d');

        // dd($date );
        if($currency->count()){
            $base = 'base= '. $currency->base_currency; // the subscription should on basic plan
            $response = Http::get('http://data.fixer.io/api/latest?access_key=788a53dcf36db5b679c8fb28708e8411');

            $not_process_rates = $response->json()['rates'];

            $rates = collect();

            $array_values = collect(array_values($not_process_rates));
            $array_keys = collect(array_keys($not_process_rates));

            for ($i=0; $i < $array_values->count(); $i++) {
                $rates->push(['currency' => $array_keys[$i], 'price' => $array_values[$i]]);
            }
            $base_rates = $rates;
            $base_currency = $rates->where('currency', $currency->base_currency);
        }else{
            $currency = '';
            $rates = '';
        }

        return view('currencies.index',compact('rates','currency','base_rates','base_currency'));
    }

    public function create()
    {
        $response = Http::get('http://data.fixer.io/api/latest?access_key=788a53dcf36db5b679c8fb28708e8411');
        $rates = collect($response->json()['rates']);
        return view('currencies.create',compact('rates'));
    }

    public function edit($id)
    {
        $response = Http::get('http://data.fixer.io/api/latest?access_key=788a53dcf36db5b679c8fb28708e8411');
        $rates = collect($response->json()['rates']);
        $currency = Currency::where([['id', '=', $id],['user_id', '=', Auth::user()->id]])->firstOrFail();
       return view('currencies.edit', compact('currency','rates'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'base_currency' => 'required',
            'user_currency' => 'required',
        ]);

        $currency = new Currency([
            'base_currency' => $request->input('base_currency'),
            'user_currency' => $request->input('user_currency'),
            'notify' => $request->input('notify'),
            'user_id' => Auth::user()->id,
        ]);

        $currency->save();

        return redirect()->route('currencies.index')
            ->withSuccess('Currency created successfully.');
    }

    public function update(Request $request, $id)
    {

        $currency = Currency::where('id', '=',$id)->firstOrFail();

        $this->validate($request, [
            'base_currency' => 'required',
            'user_currency' => 'required',
            ]);

            $currency->fill($request->only('base_currency'));
            $currency->fill($request->only('user_currency'));
            if($request->input('notify')){
                $currency->notify = 1;
            }else{
                $currency->notify = 0;
            }

        $currency->save();

        return redirect()->route('currencies.index')
            ->withSuccess('Currency updated successfully.');
    }
}
