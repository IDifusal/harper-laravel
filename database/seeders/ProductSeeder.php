<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\DeliveryMethod;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $ncOffice = DeliveryMethod::create(['name' => 'NC Office']);
        $wiOffice = DeliveryMethod::create(['name' => 'WI Office']);
        $custom = DeliveryMethod::create(['name' => 'Custom']);
        $pickUp = DeliveryMethod::create(['name' => 'Pickup in the office']);

        $defaultDeliveryMethodId = $pickUp->id;

        Product::create([
            'name' => 'Business Card',
            'img' => 'Business-Card.png',
            'link' => null,
            'type' => 'Type A',
            'initial_stock' => 100,
        ])->deliveryMethods()->attach([$ncOffice->id, $wiOffice->id, $custom->id]);

        $additionalProducts = [
            ['name' => 'Harper Image Tote Bags', 'initial_stock' => 47, 'img' => 'Harper-Image-Tote-Bags.png'],
            ['name' => 'Camo Hats', 'initial_stock' => 2, 'img' => 'Camo-Hats.png'],
            ['name' => 'Harper Face Mask - Variety of Colors', 'initial_stock' => 23, 'img' => 'Harper-Face-Mask-Variety-of-Colors.png'],
            ['name' => 'Small Pads', 'initial_stock' => 1007, 'img' => 'Small-Pads.png'],
            ['name' => 'Half Tone Screen Finder (Short)', 'initial_stock' => 50, 'img' => 'Half-Tone-Screen-Finder-(Short).png'],
            ['name' => 'Half Tone Screen Finder (Long)', 'initial_stock' => 75, 'img' => 'Half-Tone-Screen-Finder-(Long).png'],
            ['name' => '10 Tips For Anilox Care & Maintenance  - Magnet', 'initial_stock' => 528, 'img' => '10-Tips-For-Anilox-Care-&-Maintenance-Magnet.png'],
            ['name' => 'Anilox Scoring Prevention Guide', 'initial_stock' => 5420, 'img' => 'Anilox-Scoring-Prevention-Guide.png'],
            ['name' => 'Harper Volume Pens', 'initial_stock' => 551, 'img' => 'Harper-Volume-Pens.png'],
            ['name' => 'Harper Grey Pens', 'initial_stock' => 109, 'img' => 'Harper-Grey-Pens.png'],
            ['name' => 'Harper Maroon Pens', 'initial_stock' => 3, 'img' => 'Harper-Maroon-Pens.png'],
            ['name' => 'Magnifier', 'initial_stock' => 2, 'img' => 'Magnifier.png'],
            ['name' => 'Magnifier with Case', 'initial_stock' => 1, 'img' => 'Magnifier-with-Case.png'],
            ['name' => 'Mobile Phone Microscope', 'initial_stock' => 7, 'img' => 'Mobile-Phone-Microscope.png'],
            ['name' => 'Large Note Pad', 'initial_stock' => 36, 'img' => 'Large-Note-Pad.png'],
            ['name' => 'Golf Tees', 'initial_stock' => 68, 'img' => 'Golf-Tees.png'],
            ['name' => 'Golf Balls', 'initial_stock' => 36, 'img' => 'Golf-Balls.png'],
            ['name' => 'Anilox Rolls By Harper Magnet', 'initial_stock' => 5, 'img' => 'Anilox-Rolls-By-Harper-Magnet.png'],
            ['name' => 'Harper Scientific Roll Spec Magnet', 'initial_stock' => 200, 'img' => 'Harper-Scientific-Roll-Spec-Magnet.png'],
            ['name' => 'Camo Bottle Holder', 'initial_stock' => 4, 'img' => 'Camo-Bottle-Holder.png'],
            ['name' => 'Harper Tie-Dye Lanyard', 'initial_stock' => 245, 'img' => 'Harper-Tie-Dye-Lanyard.png'],
            ['name' => 'Anilox Troubleshooting Guide', 'initial_stock' => 367, 'img' => 'Anilox-Troubleshooting-Guide.png'],
            ['name' => 'Harper Zip Up Note Pad Holder', 'initial_stock' => 7, 'img' => 'Harper-Zip-Up-Note-Pad-Holder.png'],
            ['name' => 'XLT Flyers', 'initial_stock' => 999, 'img' => 'XLT-Flyers.png'],
            ['name' => 'XCAT Flyers', 'initial_stock' => 1029, 'img' => 'XCAT-Flyers.png'],
            ['name' => 'Harper Visor', 'initial_stock' => 1, 'img' => 'Harper-Visor.png'],
            ['name' => 'Harper Red Clips', 'initial_stock' => 2, 'img' => 'Harper-Red-Clips.png'],
            ['name' => 'Guitar Picks', 'initial_stock' => 155, 'img' => 'Guitar-Picks.png'],
            ['name' => 'Hot Cup Sleeve', 'initial_stock' => 348, 'img' => 'Hot-Cup-Sleeve.png'],
            ['name' => 'Harper White Folders', 'initial_stock' => 175, 'img' => 'Harper-White-Folders.png'],
            ['name' => 'Seven Elements Flexo (English)', 'initial_stock' => 322, 'img' => 'Seven-Elements-Flexo-(English).png'],
            ['name' => 'Seven Elements Flexo (Spanish)', 'initial_stock' => 679, 'img' => 'Seven-Elements-Flexo-(Spanish).png'],
            ['name' => 'Harper White Envelopes', 'initial_stock' => 751, 'img' => 'Harper-White-Envelopes.png'],
            ['name' => 'Harper Bottle Holder - Red', 'initial_stock' => 1, 'img' => 'Harper-Bottle-Holder-Red.png'],
            ['name' => 'Harper Playing Cards', 'initial_stock' => 2, 'img' => 'Harper-Playing-Cards.png'],
            ['name' => '10 Tips For Anilox Care & Maintenance (Spanish) - Magnet', 'initial_stock' => 350, 'img' => '10-Tips-For-Anilox-Care-&-Maintenance-(Spanish)-Magnet.png'],
            ['name' => 'Name Tag Holder - Blue', 'initial_stock' => 1, 'img' => 'Name-Tag-Holder-Blue.png'],
            ['name' => 'Name Tag Holder - Black', 'initial_stock' => 70, 'img' => 'Name-Tag-Holder-Black.png'],
            ['name' => 'Name Tag Holder - Red', 'initial_stock' => 196, 'img' => 'Name-Tag-Holder-Red.png'],
            ['name' => 'Plastic Trade Show Bags', 'initial_stock' => 0, 'img' => 'Plastic-Trade-Show-Bags.png'],
            ['name' => 'Roller Bags', 'initial_stock' => 7, 'img' => 'Roller-Bags.png'],
            ['name' => 'Harper Table Clothes (Small)', 'initial_stock' => 2, 'img' => 'Harper-Table-Clothes-(Small).png'],
            ['name' => 'Harper Table Clothes (Large)', 'initial_stock' => 2, 'img' => 'Harper-Table-Clothes-(Large).png'],
            ['name' => 'Pop-Up Harper Banner', 'initial_stock' => 1, 'img' => 'Pop-Up-Harper-Banner.png'],
            ['name' => 'Hanging Harper Banner', 'initial_stock' => 1, 'img' => 'Hanging-Harper-Banner.png'],            
        ];

        foreach ($additionalProducts as $productData) {
            Product::create([
                'name' => $productData['name'],
                'img' => strtolower(str_replace(' ', '-', $productData['name'])).'.png',
                'link' => null,
                'type' => 'Type C',
                'initial_stock' => $productData['initial_stock'],
            ])->deliveryMethods()->attach([$defaultDeliveryMethodId]);
        }
    }
}
