<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\PhoneMail;
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
        Contact::factory(10)->create();
        PhoneMail::factory(10)->create();
    }
}
