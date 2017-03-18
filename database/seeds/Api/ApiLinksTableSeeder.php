<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class ApiLinksTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::table('links')->delete();

        $links = collect([
            ['url' => 'https://www.google.com', 'hash' => '83328932', 'user_id' => 1],
            ['url' => 'https://www.yahoo.com', 'hash' => '32212322', 'user_id' => 1]
        ]);

        $links->each(function ($link)  {
            App(App\Link::class)->create($link);
        });

        Model::reguard();
    }
}
