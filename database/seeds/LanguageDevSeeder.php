<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\Cache;

class LanguageDevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param int $totalLanguages
     * @return string
     */
    public function run($totalLanguages = null)
    {
        if(is_numeric($totalLanguages)) {

            // There my by a default language
            $defaultExists = \App\Models\Language::where('isDefault', true)->get()->count();

            $createdLanguages = [];
            for ($i = 1; $i <= $totalLanguages; $i++) {
                $createdLanguage = factory(App\Models\Language::class)->create([
                    'isDefault' => ($i == 1 && !$defaultExists ? true : false)
                ]);
                $createdLanguages[] = $createdLanguage->name;
            }

            $output = "Languages created successfully (" . $totalLanguages . "). " . implode(', ', $createdLanguages);

            if ($this->command) {
                $this->command->info($output);
            }

            return $output;
        }
    }

}
