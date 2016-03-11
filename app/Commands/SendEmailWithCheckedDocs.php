<?php namespace App\Commands;

use App\Commands\Command;

use App\Models\Order;
use App\Models\User;
use App\MyDesigns\Classes\Utils;
use Illuminate\Contracts\Bus\SelfHandling;
use League\Flysystem\Exception;
use Mail;

class SendEmailWithCheckedDocs extends Command implements SelfHandling {

	private $fileNames;
	private $orderId;
	private $userId;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($fileNames, $orderId, $userId)
	{
        $this->fileNames = $fileNames;
        $this->orderId = $orderId;
        $this->userId = $userId;
	}

	/**
	 * Execute the command.
	 *
	 *
	 */
	public function handle()
	{
        $emailData = [];

        $user = User::find($this->userId);
        $emailData['userName'] = $user->name;

        $emailData['orderNumber'] = $this->orderId;

        try {
            Mail::send('emails.sendDocs', $emailData, function ($message) use ($user) {
                $message->from('support@transgarant.com', 'transgarant');

                $message->to($user->email)->subject('Докоменты загружены');

                foreach ($this->fileNames as $item) {
                    $partsOfFile = self::getFileNameInParts($item['fName'], $item['type']);
                    $message->attach($item['fName'], ['as' => $partsOfFile['fNameForUser'] . $this->orderId, 'mime' => $partsOfFile['mime']]);
                }
            });
        } catch(Exception $e) {
            return $e->getMessage();
        }
        return Utils::STR_SUCCESS;
    }

    private static function getFileNameInParts($fileName, $type) {
        $tempFileNameArr = explode(DIRECTORY_SEPARATOR,$fileName);
        $onlyFileName = end($tempFileNameArr);
        $tempFileNameArr = explode('.', $onlyFileName);
        $extension = end($tempFileNameArr);
        $extension = strtolower($extension);
        $mime = null;
        if($extension == 'pdf') {
            $mime = 'application/pdf';
        } else {
            $mime = 'image/'.$extension;
        }
        $fNameForUser = Order::getDocTypeName($type, true).' для заказа №';
        return ['fNameForUser'=>$fNameForUser, 'mime'=>$mime];
    }

}
