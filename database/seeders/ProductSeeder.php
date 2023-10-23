<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\DeliveryMethod;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Create Delivery Methods
        $ncOffice = DeliveryMethod::create(['name' => 'NC Office']);
        $wiOffice = DeliveryMethod::create(['name' => 'WI Office']);
        $custom = DeliveryMethod::create(['name' => 'Custom']);
        $onlyByRequests = DeliveryMethod::create(['name' => 'Only by Requests']);

        // Create Products
        Product::create([
            'name' => 'Business Card',
            'img' => 'business-card.jpg',
            'link' => null,
            'type' => 'Type A',
            'initial_stock' => 100,
        ])->deliveryMethods()->attach([$ncOffice->id, $wiOffice->id, $custom->id]);

        Product::create([
            'name' => 'XCat Flyer',
            'img' => 'xcat-flyer.jpg',
            'link' => null,
            'type' => 'Type B',
            'initial_stock' => 30,
        ])->deliveryMethods()->attach([$onlyByRequests->id]);

        Product::create([
            'name' => 'Banner',
            'img' => 'banner.jpg',
            'link' => null,
            'type' => 'Type C',
            'initial_stock' => 0,
        ])->deliveryMethods()->attach([$onlyByRequests->id]);
    }
}
