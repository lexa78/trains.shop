<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model {

    protected $guarded = ['id'];

    const TEMPLATE_AGREEMENT_PATH = __DIR__.'/../../resources/views/documents/serviceAgreementTemplate.blade.php';
    const TEMPLATE_INVOICE_PATH = __DIR__.'/../../resources/views/documents/invoice.blade.php';

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function service_order()
    {
        return $this->belongsTo('App\Models\ServiceOrder');
    }

}
