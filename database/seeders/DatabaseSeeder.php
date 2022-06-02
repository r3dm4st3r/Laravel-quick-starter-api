<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory(1)->create();
//         Contact::factory(10)->make();
        Article::factory(20)->make();
    }
}
