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
            'cost_price' => 660.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'm2',
            'product_type'=>'torchon',
            'coverage'=> 9.00,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //2
            'name' => 'Axter Mineral Torch-on',
            'category_id' => 1,
            'description' => 'French',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 9,
            'cost_price' => 550.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'm2',
            'product_type'=>'torchon',
            'coverage'=>9.00,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //3
            'name' => 'ABE Bitu-Prime',
            'category_id' => 1,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 25,
            'cost_price' => 460.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'Lt',
            'product_type'=>'primer',
            'coverage'=>125.00,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //4
            'name' => 'Gas 9kg',
            'category_id' => 1,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 9,
            'cost_price' => 186.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'Kg',
            'product_type'=>'gas',
            'coverage'=>50,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //5
            'name' => 'Membrane 100',
            'category_id' => 1,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 20,
            'cost_price' => 18.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lm',
            'product_type'=>'membrane',
            'coverage'=>2.00,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //6
            'name' => 'Membrane 200',
            'category_id' => 1,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 20,
            'cost_price' => 20.35,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lm',
            'product_type'=>'membrane',
            'coverage'=>4.00,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //7
            'name' => 'Membrane 300',
            'category_id' => 1,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 20,
            'cost_price' => 50.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lm',
            'product_type'=>'membrane',
            'coverage'=>6.66,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //8
            'name' => 'Membrane 500',
            'category_id' => 1,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 20,
            'cost_price' => 83.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lm',
            'product_type'=>'membrane',
            'coverage'=>10.00,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //9
            'name' => 'Membrane 1000',
            'category_id' => 1,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 20,
            'cost_price' => 156,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lm',
            'product_type'=>'membrane',
            'coverage'=>20.00,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //10
            'name' => 'ABE Super Laycryl', 
            'category_id' => 1,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 20,
            'cost_price' => 716.47,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lt',
            'product_type'=>'acrylic',
            'coverage'=>9.5,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //11
            'name' => '16DV 15mm 4mm Fibre Cement',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'cost_price' => 255.12,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'sanika_board',
            'coverage' => 2.88,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //12
            'name' => '20DV 15mm 4mm Fibre Cement',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'cost_price' => 275.80,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'sanika_board',
            'coverage' => 2.88,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //13
            'name' => '24DV 15mm 4mm Fibre Cement',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'cost_price' => 296.85,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'sanika_board',
            'coverage' => 2.88,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //14
            'name' => '16DV 25mm 4mm Fibre Cement',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'cost_price' => 278.02,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'sanika_board',
            'coverage' => 2.88,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //15
            'name' => '20DV 25mm 4mm Fibre Cement',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'cost_price' => 270.64,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'sanika_board',
            'coverage' => 2.88,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //16
            'name' => '24DV 25mm 4mm Fibre Cement',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'cost_price' => 334.11,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'sanika_board',
            'coverage' => 2.88,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //17
            'name' => '16DV 15mm 6mm Fibre Cement',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'cost_price' => 439.56,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'sanika_board',
            'coverage' => 2.88,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //18
            'name' => '20DV 15mm 6mm Fibre Cement',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'cost_price' => 460.24,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'sanika_board',
            'coverage' => 2.88,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //19
            'name' => '24DV 15mm 6mm Fibre Cement',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'cost_price' => 481.29,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'sanika_board',
            'coverage' => 2.88,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //20
            'name' => '16DV 25mm 6mm Fibre Cement',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'cost_price' => 462.46,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'sanika_board',
            'coverage' => 2.88,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //21
            'name' => '20DV 25mm 6mm Fibre Cement',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'cost_price' => 455.08,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'sanika_board',
            'coverage' => 2.88,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //22
            'name' => '24DV 25mm 6mm Fibre Cement',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'cost_price' => 518.55,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'sanika_board',
            'coverage' => 2.88,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //23
            'name' => 'Fillets IBR',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'cost_price' => 9.65,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'fillets',
            'coverage' => 0.41,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //24
            'name' => 'Fillets Clip Lock',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'cost_price' => 11.35,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'fillets',
            'coverage' => 0.538,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //25
            'name' => 'Fillets Wide Span',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'cost_price' => 15.85,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'fillets',
            'coverage' => 0.4587,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //26
            'name' => '50mm Tek Screws',
            'category_id' => 4,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 200,
            'cost_price' => 0.25,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'screws',
            'coverage' => 0.28,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //27
            'name' => 'Sanika 60mm Washer',
            'category_id' => 4,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 200,
            'cost_price' => 0.55,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'washers',
            'coverage' => 0.28,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //28
            'name' => 'Flashing Galvanised 50X50 Hellenic',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 20,
            'pack_size' => 2.4,
            'cost_price' => 52.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lm',
            'product_type' => 'flashing',
            'coverage' => 2.40,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //29
            'name' => 'Flashing Galvanised 100X100 Hellenic',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 20,
            'pack_size' => 2.4,
            'cost_price' => 85.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lm',
            'product_type' => 'flashing',
            'coverage' => 2.40,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //30
            'name' => 'MCC Grout',
            'category_id' => 2,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 20,
            'cost_price' => 250.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'kg',
            'product_type' => 'cement',
            'coverage' => 4,
            'created_at' => Carbon::now()
        ]);

        DB::table('materials')->insert([ //31
            'name' => 'Cement',
            'category_id' => 2,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 50,
            'cost_price' => 100.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'kg',
            'product_type' => 'cement',
            'coverage' => 6,
            'created_at' => Carbon::now()
        ]);

        DB::table('materials')->insert([ //32
            'name' => 'River Sand',
            'category_id' => 3,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'cost_price' => 380.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'm3',
            'product_type' => 'sand',
            'coverage' => 4,
            'created_at' => Carbon::now()
        ]);

        DB::table('materials')->insert([ //33
            'name' => '25mm Polyurethane board',
            'category_id' => 1,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'cost_price' => 93.82,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'poly_board',
            'coverage' => 2.88,
            'created_at' => Carbon::now()
        ]);

        DB::table('materials')->insert([ //34
            'name' => 'Frogskin Grey', 
            'category_id' => 5,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 20,
            'cost_price' => 550.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lt',
            'product_type'=>'paint',
            'coverage'=>60,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //35
            'name' => 'Frogskin Terracotta', 
            'category_id' => 5,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 20,
            'cost_price' => 550.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lt',
            'product_type'=>'paint',
            'coverage'=>60,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //36
            'name' => 'Frogskin Green', 
            'category_id' => 5,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 20,
            'cost_price' => 550.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lt',
            'product_type'=>'paint',
            'coverage'=>60,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //37
            'name' => 'Frogskin Brown', 
            'category_id' => 5,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 20,
            'cost_price' => 550.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lt',
            'product_type'=>'paint',
            'coverage'=>60,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //38
            'name' => 'Frogskin White', 
            'category_id' => 5,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 20,
            'cost_price' => 648.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lt',
            'product_type'=>'paint',
            'coverage'=>60,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //39
            'name' => 'Membrane Patch', 
            'category_id' => 5,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 200,
            'cost_price' => 0.15,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type'=>'membrane',
            'coverage'=>0.005625,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //40
            'name' => 'Butyl Washer',
            'category_id' => 4,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 200,
            'cost_price' => 0.25,
            'day_rate' => 0.00,
            'unit_of_measure' => 'each',
            'product_type' => 'washer',
            'coverage' => 0.4,
            'created_at' => Carbon::now()
        ]);

        //kryton Stuff
        DB::table('materials')->insert([ //41
            'name' => 'Petrol generator',
            'category_id' => 6,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => null,
            'pack_size' => 1,
            'cost_price' => 12.82,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lt',
            'product_type' => 'fuel',
            'coverage' => 200,
            'created_at' => Carbon::now()
        ]);

        DB::table('materials')->insert([ //42
            'name' => 'Diesel Air',
            'category_id' => 6,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => null,
            'pack_size' => 1,
            'cost_price' => 11.27,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lt',
            'product_type' => 'fuel',
            'coverage' => 10,
            'created_at' => Carbon::now()
        ]);

        DB::table('materials')->insert([ //43
            'name' => 'Electricity',
            'category_id' => 6,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => null,
            'pack_size' => 1,
            'cost_price' => 0,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lt',
            'product_type' => 'fuel',
            'coverage' => 0,
            'created_at' => Carbon::now()
        ]);

        DB::table('materials')->insert([ //44
            'name' => 'Grit',
            'category_id' => 3,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => null,
            'pack_size' => 500,
            'cost_price' => 500,
            'day_rate' => 0.00,
            'unit_of_measure' => 'm3',
            'product_type' => 'Grit',
            'coverage' => 80,
            'created_at' => Carbon::now()
        ]);

        DB::table('materials')->insert([ //45
            'name' => 'Kryton Plug',
            'category_id' => 7,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 25,
            'cost_price' => 2750,
            'day_rate' => 0.00,
            'unit_of_measure' => 'kg',
            'product_type' => 'Plug',
            'coverage' => 25,
            'created_at' => Carbon::now()
        ]);

        DB::table('materials')->insert([ //46
            'name' => 'Kryton Repair Grout',
            'category_id' => 7,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 25,
            'cost_price' => 2750,
            'day_rate' => 0.00,
            'unit_of_measure' => 'kg',
            'product_type' => 'Grout',
            'coverage' => 25,
            'created_at' => Carbon::now()
        ]);

        DB::table('materials')->insert([ //47
            'name' => 'Kryton T1',
            'category_id' => 7,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 25,
            'cost_price' => 2750,
            'day_rate' => 0.00,
            'unit_of_measure' => 'kg',
            'product_type' => 'T1',
            'coverage' => 25,
            'created_at' => Carbon::now()
        ]);

        DB::table('materials')->insert([ //48
            'name' => 'Kryton T2',
            'category_id' => 7,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 25,
            'cost_price' => 2750,
            'day_rate' => 0.00,
            'unit_of_measure' => 'kg',
            'product_type' => 'T2',
            'coverage' => 25,
            'created_at' => Carbon::now()
        ]);

        DB::table('materials')->insert([ //49
            'name' => 'Plain Torch-on 3mm',
            'category_id' => 1,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 9,
            'cost_price' => 530.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'm2',
            'product_type'=>'torchon',
            'coverage'=> 9.00,
            'created_at' => Carbon::now()
        ]);

        DB::table('materials')->insert([ //50
            'name' => 'Plain Torch-on 4mm',
            'category_id' => 1,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 9,
            'cost_price' => 580.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'm2',
            'product_type'=>'torchon',
            'coverage'=> 9.00,
            'created_at' => Carbon::now()
        ]);

        DB::table('materials')->insert([ //51
            'name' => 'Fibre Reinforced Torch-on',
            'category_id' => 1,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 9,
            'cost_price' => 660.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'm2',
            'product_type'=>'torchon',
            'coverage'=> 9.00,
            'created_at' => Carbon::now()
        ]);

        // Plaster KMA
        DB::table('materials')->insert([ //52
            'name' => 'Krystol Mortar Ad-Mixture',
            'category_id' => 7,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 15,
            'cost_price' => 1650.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'kg',
            'product_type'=>'kryton',
            'coverage'=> 300,
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([ //53
            'name' => 'Plaster Sand',
            'category_id' => 3,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'cost_price' => 380.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'm3',
            'product_type' => 'sand',
            'coverage' => 100,
            'created_at' => Carbon::now()
        ]);

        //Alkali Primer
        DB::table('materials')->insert([ //54
            'name' => 'Alkali Primer',
            'category_id' => 5,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 25,
            'cost_price' => 608.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lt',
            'product_type' => 'paint',
            'coverage' => 40,
            'created_at' => Carbon::now()
        ]);

        // MCC MultiSeal
        DB::table('materials')->insert([ //55
            'name' => 'MCC MultiSeal 210',
            'category_id' => 5,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 25,
            'cost_price' => 173.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'kg',
            'product_type' => 'slurry',
            'coverage' => 20,
            'created_at' => Carbon::now()
        ]);

        DB::table('materials')->insert([ //56
            'name' => 'MCC MultiSeal 211',
            'category_id' => 5,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 25,
            'cost_price' => 219.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'kg',
            'product_type' => 'slurry',
            'coverage' => 20,
            'created_at' => Carbon::now()
        ]);

        DB::table('materials')->insert([ //57
            'name' => 'MCC MultiBond',
            'category_id' => 5,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 3,
            'cost_price' => 96.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lt',
            'product_type' => 'bonding',
            'coverage' => 10,
            'created_at' => Carbon::now()
        ]);

        DB::table('materials')->insert([ //58
            'name' => 'Screed Repair Kit',
            'category_id' => 5,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'cost_price' => 300,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lt',
            'product_type' => 'cement',
            'coverage' => 8.5,
            'created_at' => Carbon::now()
        ]);

        //silvakote
        DB::table('materials')->insert([ //59
            'name' => 'Bitumastic Aluminium (Silvakote) 25lt',
            'category_id' => 5,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'cost_price' => 1455.08,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lt',
            'product_type' => 'silvakote',
            'coverage' => 175,
            'created_at' => Carbon::now()
        ]);

        DB::table('materials')->insert([ //60
            'name' => 'Bitumastic Aluminium (Silvakote) 5lt',
            'category_id' => 5,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'cost_price' => 398.20,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lt',
            'product_type' => 'silvakote',
            'coverage' => 35,
            'created_at' => Carbon::now()
        ]);

        //Rubberised Bitumin
        DB::table('materials')->insert([ //61
            'name' => 'Rubberised Bitumen (Superlakold)',
            'category_id' => 5,
            'Description' => 'blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 1,
            'cost_price' => 453.96,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lt',
            'product_type' => 'rubberised',
            'coverage' => 9.5,
            'created_at' => Carbon::now()
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
