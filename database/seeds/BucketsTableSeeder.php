<?php

use Illuminate\Database\Seeder;

class BucketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('buckets')->insert([
            'username' => 'tanika',
            'fromEmail' => 'admin@sanika.com',
            'message' => 'Eastgate Site visit Liberty Gardens 1st Feb or 2nd Feb',
            'calendar' => '2016-02-01 08:01:38',
            'user_id' => 3
        ]);
        DB::table('buckets')->insert([
            'username' => 'sandor',
            'fromEmail' => 'sandor@sanika.com',
            'message' => 'Test from marketing',
            'calendar' => '2016-02-01 08:04:36',
            'user_id' => 5
        ]);
        DB::table('buckets')->insert([
            'username' => 'paul',
            'fromEmail' => 'paul@sanika.com',
            'message' => 'Quotes',
            'calendar' => '2016-02-01 09:53:19',
            'user_id' => 1
        ]);
        DB::table('buckets')->insert([
            'username' => 'paul',
            'fromEmail' => 'paul@sanika.com',
            'message' => 'Heath planning',
            'calendar' => '2016-02-01 13:22:26',
            'user_id' => 1
        ]);
        DB::table('buckets')->insert([
            'username' => 'tanika',
            'fromEmail' => 'admin@sanika.com',
            'message' => 'Helen Macrais - Insurance claim breakdown',
            'calendar' => '2016-02-01 14:06:51',
            'user_id' => 3
        ]);
        DB::table('buckets')->insert([
            'username' => 'paul',
            'fromEmail' => 'paul@sanika.com',
            'message' => 'Thulisa 24 end at cnr Bree',
            'calendar' => '2016-02-01 14:14:55',
            'user_id' => 1
        ]);
        DB::table('buckets')->insert([
            'username' => 'tanika',
            'fromEmail' => 'admin@sanika.com',
            'message' => 'Eastgate pricing - Christopher Louw Entrance 12 and Mica',
            'calendar' => '2016-02-01 14:30:40',
            'user_id' => 3
        ]);
        DB::table('buckets')->insert([
            'username' => 'sandor',
            'fromEmail' => 'sandor@sanika.com',
            'message' => 'Email glitches',
            'calendar' => '2016-02-02 09:27:18',
            'user_id' => 5
        ]);
        DB::table('buckets')->insert([
            'username' => 'paul',
            'fromEmail' => 'paul@sanika.com',
            'message' => 'Amanda machine',
            'calendar' => '2016-02-02 09:39:35',
            'user_id' => 1
        ]);
        DB::table('buckets')->insert([
            'username' => 'paul',
            'fromEmail' => 'paul@sanika.com',
            'message' => 'Rob Gordon Neighbour',
            'calendar' => '2016-02-02 12:04:32',
            'user_id' => 1
        ]);
        DB::table('buckets')->insert([
            'username' => 'paul',
            'fromEmail' => 'paul@sanika.com',
            'message' => 'Gavin Growthpoint',
            'calendar' => '2016-02-02 12:05:29',
            'user_id' => 1
        ]);
    }
}
