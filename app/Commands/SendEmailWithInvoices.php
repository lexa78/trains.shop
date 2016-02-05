<?php namespace App\Commands;

use App\Commands\Command;

use Auth;
use Illuminate\Contracts\Bus\SelfHandling;
use Mail;

class SendEmailWithInvoices extends Command implements SelfHandling {

	private $emailMessage;
    private $fileNames;
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($emailContent, $fileNames)
	{
		$this->emailMessage = $emailContent;
        $this->fileNames = $fileNames;
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
            $message->from('support@transgarant.com', 'transgarant');

            $message->to(Auth::user()->email)->subject('Заказ оформлен. Спасибо за заказ');

            foreach($this->fileNames as $fileName) {
                $tempFileNameArr = explode(DIRECTORY_SEPARATOR,$fileName);
                $tempFileName = end($tempFileNameArr);
                $message->attach($fileName, ['as' => $tempFileName, 'mime' => 'application/pdf']);
            }
        });
	}

}
