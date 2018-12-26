<?php

use Illuminate\Database\Seeder;

class CustomFieldsFactory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param int $totalCustomFields
     * @return void
     */
    public function run($totalCustomFields = 1)
    {
        factory(\App\Models\CustomField::class, $totalCustomFields)->create();

        $this->command->info("Custom Field generated successfully!");
    }
}
