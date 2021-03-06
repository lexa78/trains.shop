<?php namespace App\Commands;

use App\Commands\Command;

use Auth;
use Illuminate\Contracts\Bus\SelfHandling;
use Mail;

class SendWithTanksForServiceOrder extends Command implements SelfHandling {

    private $emailMessage;
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($emailContent)
	{
        $this->emailMessage = $emailContent;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
        Mail::send('emails.thanksForServiceOrder', $this->emailMessage, function($message)
        {
            $message->to(Auth::user()->email)->subject('Заказ услуги оформлен. Спасибо за заказ');
        });
    }

}
