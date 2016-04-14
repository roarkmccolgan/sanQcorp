<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MaterialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('materials')->insert([ //1
            'name' => 'Coppernit Mineral Torch-on',
            'category_id' => 1,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 9,
            'price' => 660.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'm2',
            'product_type'=>'torchon',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //2
            'name' => 'Axter Mineral Torch-on',
            'category_id' => 1,
            'description' => 'French',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 9,
            'price' => 550.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'm2',
            'product_type'=>'torchon',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //3
            'name' => 'ABE Bitu-Prime',
            'category_id' => 1,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 25,
            'price' => 460.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'Lt',
            'product_type'=>'primer',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //4
            'name' => 'Gas 9kg',
            'category_id' => 1,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 9,
            'price' => 186.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'Lt',
            'product_type'=>'gas',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //5
            'name' => 'Membrane 100',
            'category_id' => 1,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 20,
            'price' => 18.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lm',
            'product_type'=>'membrane',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //6
            'name' => 'Membrane 200',
            'category_id' => 1,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 20,
            'price' => 31.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lm',
            'product_type'=>'membrane',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //7
            'name' => 'Membrane 300',
            'category_id' => 1,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 20,
            'price' => 53.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lm',
            'product_type'=>'membrane',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //8
            'name' => 'Membrane 500',
            'category_id' => 1,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 20,
            'price' => 80.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lm',
            'product_type'=>'membrane',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //9
            'name' => 'Membrane 1000',
            'category_id' => 1,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 20,
            'price' => 117.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lm',
            'product_type'=>'membrane',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //10
            'name' => 'ABE Super Laycryl', 
            'category_id' => 1,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 20,
            'price' => 370.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lm',
            'product_type'=>'acrylic',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //11
            'name' => '16DV 15mm 4mm Fibre Cement',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'price' => 255.12,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'sanika_board',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //12
            'name' => '20DV 15mm 4mm Fibre Cement',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'price' => 275.80,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'sanika_board',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //13
            'name' => '24DV 15mm 4mm Fibre Cement',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'price' => 296.85,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'sanika_board',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //14
            'name' => '16DV 25mm 4mm Fibre Cement',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'price' => 278.02,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'sanika_board',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //15
            'name' => '20DV 25mm 4mm Fibre Cement',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'price' => 270.64,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'sanika_board',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //16
            'name' => '24DV 25mm 4mm Fibre Cement',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'price' => 334.11,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'sanika_board',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //17
            'name' => '16DV 15mm 6mm Fibre Cement',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'price' => 439.56,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'sanika_board',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //18
            'name' => '20DV 15mm 6mm Fibre Cement',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'price' => 460.24,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'sanika_board',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //19
            'name' => '24DV 15mm 6mm Fibre Cement',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'price' => 481.29,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'sanika_board',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //20
            'name' => '16DV 25mm 6mm Fibre Cement',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'price' => 462.46,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'sanika_board',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //21
            'name' => '20DV 25mm 6mm Fibre Cement',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'price' => 455.08,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'sanika_board',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //22
            'name' => '24DV 25mm 6mm Fibre Cement',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'price' => 518.55,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'sanika_board',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //23
            'name' => 'Fillets IBR',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'price' => 9.65,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'fillets',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //24
            'name' => 'Fillets Clip Lock',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'price' => 11.35,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'fillets',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //25
            'name' => 'Fillets Wide Span',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'price' => 15.85,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'fillets',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //26
            'name' => 'Screws',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 200,
            'price' => 50.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'screws',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //27
            'name' => 'Sanika 60mm Washer',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 200,
            'price' => 38.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'washers',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //28
            'name' => 'Flashing Galvanised 50X50 Hellenic',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 20,
            'pack_size' => 2.4,
            'price' => 52.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lm',
            'product_type' => 'flashing',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //29
            'name' => 'Flashing Galvanised 100X100 Hellenic',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 20,
            'pack_size' => 2.4,
            'price' => 85.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lm',
            'product_type' => 'flashing',
            'created_at' => Carbon::now()
        ]);
        // DB::table('materials')->insert([ //27 //9.5m2 per drum
        //     'name' => 'ABE Rubberized Bitumen',
        //     'category_id' => 1,
        //     'Description' => 'blah',
        //     'image' => 'blank.jpg',
        //     'stock' => 1000,
        //     'pack_size' => 200,
        //     'price' => 370.51,
        //     'day_rate' => 0.00,
        //     'unit_of_measure' => 'each',
        //     'product_type' => 'washers',
        //     'created_at' => Carbon::now()
        // ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
