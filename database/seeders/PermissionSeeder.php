<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $userId = 1;

        $itemIds = DB::table('items')->pluck('id');

        foreach ($itemIds as $itemId) {
            DB::table('permissions')->updateOrInsert(
                ['user_id' => $userId, 'item_id' => $itemId],
                [
                    'estado' => 'A',
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }
}
