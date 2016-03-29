<?php namespace App\Commands;

use App\Commands\Command;

use Exception;
use File;
use Illuminate\Contracts\Bus\SelfHandling;
use Log;
use Storage;

class UploadOferta extends Command implements SelfHandling {

	protected $file;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($file)
	{
		$this->file = $file;
	}

	/**
	 * Execute the command.
	 *
	//	 * @return void
	 */
	public function handle()
	{
		$whereIsOferta = DIRECTORY_SEPARATOR.'documents';

		if( ! Storage::disk('local')->exists($whereIsOferta.DIRECTORY_SEPARATOR.'oferta')) {
			Storage::makeDirectory($whereIsOferta.DIRECTORY_SEPARATOR.'oferta');
		}

		$ofertaFolder = $whereIsOferta.DIRECTORY_SEPARATOR.'oferta';

		$extension = $this->file->getClientOriginalExtension();

        //get all files from folder
        $files = Storage::files($ofertaFolder);

        Storage::delete($files);

        try {
			Storage::disk('local')->put($ofertaFolder.DIRECTORY_SEPARATOR.'oferta.'.$extension,  File::get($this->file));
		} catch(Exception $e) {
			Log::error('Ошибка загрузки файла с договором оферты'.' message - '.$e->getMessage());
			return false;
		}
		return storage_path().DIRECTORY_SEPARATOR.'app'.$ofertaFolder.DIRECTORY_SEPARATOR.'oferta.'.$extension;
	}

}
