<?php

use Illuminate\Database\Seeder;
use App\UserLog;
use Carbon\Carbon;

class DummySeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        UserLog::truncate();

        for ($i = 0; $i < 10; $i++) {
            factory(UserLog::class)->create([
                'user_id' => 1,
                'date'    => Carbon::now()->subDays($i),
            ]);
        }
    }
}
