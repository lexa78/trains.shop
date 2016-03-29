<?php namespace App\Commands;

use App\Commands\Command;

use Auth;
use Illuminate\Contracts\Bus\SelfHandling;
use Mail;

class SendWithTanksForOrder extends Command implements SelfHandling {

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
        Mail::send('emails.thanksForOrder', $this->emailMessage, function($message)
        {
            $message->to(Auth::user()->email)->subject('Заказ оформлен. Спасибо за заказ');
        });
    }

}
