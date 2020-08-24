<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
        //Client-receipt relationship
        public function client(){
            return $this->belongsTo(Client::class, 'client_id');
        }

        //invoiceItem-invoice relationship
        public function receiptItem(){
            return $this->hasMany(ReceiptItem::class, 'receipt_id');
        }

        //invoice-client
        public function clients(){
            return $this->hasMany(Client::class, 'client_id');
        }
}
