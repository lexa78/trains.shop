<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use Mail;

class SendEmailWithServiceAgreement extends Command implements SelfHandling {

	private $emailMessage;
	private $fileName;
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($emailContent, $fileName)
	{
		$this->emailMessage = $emailContent;
		$this->fileName = $fileName;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		Mail::send('emails.sendServiceAgreement', $this->emailMessage, function($message)
		{
			$message->to($this->emailMessage['email'])->subject('Договор на оказание услуг');

			$message->attach($this->fileName, ['as' => 'Договор на оказание услуг.pdf', 'mime' => 'application/pdf']);
		});
	}
}
