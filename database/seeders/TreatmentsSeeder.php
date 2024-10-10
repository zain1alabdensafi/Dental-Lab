<?php

namespace Database\Seeders;

use App\Models\Treatment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TreatmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('treatments')->insert([
            'type_treatment'=>'Pontic'
        ]);
        DB::table('treatments')->insert([
            'type_treatment'=>'Implat'
        ]);
        DB::table('treatments')->insert([
            'type_treatment'=>'Veneer'
        ]);
        DB::table('treatments')->insert([
            'type_treatment'=>'Inlay'
        ]);
        DB::table('treatments')->insert([
            'type_treatment'=>'Denture'
        ]);
    }
}


/*
<?php

use App\Models\Treatment;
use Illuminate\Database\Seeder;

class dSeeder extends Seeder
{
    protected $type_treatment;

    public function __construct($type_treatment)
    {
        $this->type_treatment = $type_treatment;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     *//*
    public function run()
    {
        Treatment::create([
            'type_treatment' => $this->type_treatment
        ]);
        $message = 'Treatment added successfully';
        return redirect()->back()->with('Treatment',$message );
        
    }
}*/

