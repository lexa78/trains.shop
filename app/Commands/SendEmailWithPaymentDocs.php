<?php namespace App\Commands;

use App\Commands\Command;

use App\Models\Order;
use App\Models\User;
use Illuminate\Contracts\Bus\SelfHandling;
use Mail;

class SendEmailWithPaymentDocs extends Command implements SelfHandling {

	private $fileName;
    private $order;
    private $isTorg;
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($fileName, $isTorg, Order $order)
	{
        $this->fileName = $fileName;
        $this->order = $order;
        $this->isTorg = $isTorg;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
        $emailData = [];

        $user = User::find($this->order->user_id);
        $emailData['userName'] = $user->name;

        $emailData['orderNumber'] = $this->order->id;

        $emailData['isTorg'] = $this->isTorg;

        Mail::send('emails.auction12', $emailData, function($message) use($user)
        {
            $message->from('support@transgarant.com', 'transgarant');

            $message->to($user->email)->subject('Ваш заказ выполнен.');

            $tempFileNameArr = explode('/',$this->fileName);
            $tempFileName = end($tempFileNameArr);
            $message->attach($this->fileName, ['as' => $tempFileName, 'mime' => 'application/pdf']);
        });

    }

}
