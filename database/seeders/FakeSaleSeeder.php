<?php

namespace Database\Seeders;

use App\Models\FakeSale;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FakeSaleSeeder extends Seeder
{
    public function run(): void
    {
        FakeSale::query()->truncate();
        FakeSale::factory(100)->create();
    }
}
