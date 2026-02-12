<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Asset;
use App\Models\NewProperty;
use App\Models\Property;

class AssetsSeeder extends Seeder
{
    public function run(): void
    {
        /*
         |------------------------------------------------------------
         | Example: Assets for NEW PROPERTIES
         |------------------------------------------------------------
         */

        $newProperties = NewProperty::take(3)->get();

        foreach ($newProperties as $property) {

            // Thumbnail (only one active)
            Asset::updateOrInsert(
                [
                    'table_name' => NewProperty::class,
                    'table_id'   => $property->id,
                    'type'       => 'thumbnail',
                ],
                [
                    'file_path'     => 'assets/new_properties/'.$property->id.'/thumb.jpg',
                    'original_name' => 'thumbnail.jpg',
                    'sort_order'    => 0,
                    'is_active'     => true,
                ]
            );

            // Images (multiple)
            foreach ([1, 2, 3] as $order) {
                Asset::updateOrInsert(
                    [
                        'table_name' => NewProperty::class,
                        'table_id'   => $property->id,
                        'type'       => 'image',
                        'sort_order' => $order,
                    ],
                    [
                        'file_path'     => 'assets/new_properties/'.$property->id."/image_$order.jpg",
                        'original_name' => "image_$order.jpg",
                        'is_active'     => true,
                    ]
                );
            }

            // Brochure (optional)
            Asset::updateOrInsert(
                [
                    'table_name' => NewProperty::class,
                    'table_id'   => $property->id,
                    'type'       => 'brochure',
                ],
                [
                    'file_path'     => 'assets/new_properties/'.$property->id.'/brochure.pdf',
                    'original_name' => 'brochure.pdf',
                    'sort_order'    => 0,
                    'is_active'     => true,
                ]
            );
        }

        /*
         |------------------------------------------------------------
         | Example: Assets for PROPERTIES (Resale / Rent)
         |------------------------------------------------------------
         */

        $properties = Property::take(3)->get();

        foreach ($properties as $property) {

            Asset::updateOrInsert(
                [
                    'table_name' => Property::class,
                    'table_id'   => $property->id,
                    'type'       => 'thumbnail',
                ],
                [
                    'file_path'     => 'assets/properties/'.$property->id.'/thumb.jpg',
                    'original_name' => 'thumbnail.jpg',
                    'sort_order'    => 0,
                    'is_active'     => true,
                ]
            );
        }
    }
}
