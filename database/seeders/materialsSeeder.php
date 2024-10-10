<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class materialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('materials')->insert([
            'type_material' => 'Zircon'
        ]);
        DB::table('materials')->insert([
            'type_material' => 'Metal'
        ]);
        DB::table('materials')->insert([
            'type_material' => 'Wax'
        ]);
        DB::table('materials')->insert([
            'type_material' => 'Acrylic-PMMA'
        ]);

    }
}

class MaterialDataSeeder extends Seeder
{
    protected $type_material;

    public function __construct($type_material)
    {
        $this->type_material = $type_material;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Material::create([
            'type_material' => $this->type_material
        ]);
    }
}

