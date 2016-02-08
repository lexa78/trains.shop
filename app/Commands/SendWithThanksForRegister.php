<?php namespace App\Commands;

use App\Commands\Command;

use Auth;
use Illuminate\Contracts\Bus\SelfHandling;
use Mail;

class SendWithThanksForRegister extends Command implements SelfHandling {

	private $messageData;
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(Array $messageData)
	{
		$this->messageData = $messageData;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
        Mail::send('emails.thanksForRegister', $this->messageData, function($message)
        {
            $message->from('support@transgarant.com', 'transgarant');

            $message->to(Auth::user()->email)->subject('Вы успешно зарегистрировались на сайте transgarant.com');
        });
	}

}
