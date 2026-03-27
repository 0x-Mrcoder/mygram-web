<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;
use Illuminate\Support\Facades\DB;

class UpdatePlans extends Seeder
{
    public function run()
    {
        $plans = [
             ['price' => 3500, 'daily' => 583, 'name' => 'VIP 1'],
             ['price' => 7000, 'daily' => 1166, 'name' => 'VIP 2'],
             ['price' => 12500, 'daily' => 2083, 'name' => 'VIP 3'],
             ['price' => 20000, 'daily' => 3333, 'name' => 'VIP 4'],
             ['price' => 35000, 'daily' => 5803, 'name' => 'VIP 5'],
             ['price' => 60000, 'daily' => 10000, 'name' => 'VIP 6'],
             ['price' => 100000, 'daily' => 16666, 'name' => 'VIP 7'],
             ['price' => 150000, 'daily' => 25000, 'name' => 'VIP 8'],
             ['price' => 200000, 'daily' => 33320, 'name' => 'VIP 9'],
             ['price' => 300000, 'daily' => 50000, 'name' => 'VIP 10'],
        ];

        // Soft delete active VIP plans
        Package::where('tab', 'vip')->update(['status' => 'inactive']);

        $catId = DB::table('packages')->whereNotNull('package_id')->value('package_id') ?? 1;

        foreach ($plans as $index => $plan) {
            try {
                $p = new Package();
                $p->package_id = $catId;
                $p->name = $plan['name'];
                $p->price = $plan['price'];
                $p->daily_limit = $plan['daily'];
                $p->tab = 'vip';
                $p->status = 'active';
                $p->validity = 60;
                $p->label = $plan['daily'] . '/day';
                $p->income_range = $plan['daily'];
                $p->commission_with_avg_amount = $plan['price'] * 0.1;
                $p->ref1 = 20;
                $p->ref2 = 3;
                $p->ref3 = 3;
                $p->photo = ''; // Ensure not null
                $p->save();
                echo "Created " . $plan['name'] . "\n";
            } catch (\Exception $e) {
                echo "Error creating " . $plan['name'] . ": " . $e->getMessage() . "\n";
            }
        }
    }
}
