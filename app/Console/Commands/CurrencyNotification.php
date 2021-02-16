<?php

namespace App\Console\Commands;

use App\Currency;
use Illuminate\Console\Command;
use App\User as User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class CurrencyNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Currency:Hourly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a hourly email to all users who subscribe for notification';

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
    public function handle()
    {


        $users = User::all();
        $currencies = Currency::all();
        foreach ($currencies as $currency) {
            $date = Carbon::now()->format('Y-m-d');
            $response = Http::get('http://data.fixer.io/api/latest?access_key=788a53dcf36db5b679c8fb28708e8411');
            $not_process_rates = $response->json()['rates'];

            $rates = collect();

            $array_values = collect(array_values($not_process_rates));
            $array_keys = collect(array_keys($not_process_rates));

            for ($i=0; $i < $array_values->count(); $i++) {
                $rates->push(['currency' => $array_keys[$i], 'price' => $array_values[$i]]);
            }

            if($currency->notify == 1){
                $base_currency = $rates->where('currency', $currency->base_currency);
                $user_currency = $rates->where('currency', $currency->user_currency);
                if($base_currency['0']['price'] < $user_currency['0']['price']){
                    $data = [
                        'from' => 'noreply@noreply.co.za',
                        'to' => User::where( [['id' => $currency->user_id]])->first()->email,
                        'name' => User::where( [['id' => $currency->user_id]])->first()->name,
                        'base_currency' => $currency->base_currency,
                        'user_currency' => $currency->user_currency,
                        'price' => $base_currency['price'],
                    ];

                    Mail::send('emails.notification', ['data' => $data], function ($m) use ($data) {
                        $m->from($data['from'], $data['name']);

                        $m->to($data['to'], $data['name'])->subject('Change of currency rates');
                    });

                }
            }

        }

        $this->info('Change of rate notification sent to All Users subscribed');
        // return 0;
    }
}
