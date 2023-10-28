<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Product; // Import the Product model
use App\Models\DeliveryMethod; // Import the DeliveryMethod model

class RequestProduct extends Mailable
{
    use Queueable, SerializesModels;

    public $requestData;

    public function __construct($data)
    {
        $product = Product::find($data['product_id']);
        $productName = $product ? $product->name : 'Unknown Product';

        $deliveryMethod = DeliveryMethod::find($data['delivery_method']);
        $deliveryMethodName = $deliveryMethod ? $deliveryMethod->name : 'Unknown Delivery Method';

        $data['product_name'] = $productName;
        $data['delivery_method_name'] = $deliveryMethodName;

        $this->requestData = $data;
    }

    public function build()
    {
        return $this->view('emails.request_product')
                    ->with('data', $this->requestData);
    }
}
