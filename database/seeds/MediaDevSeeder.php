<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\Cache;

class MediaDevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param int $totalMedia Defines how many media shall be created
     * @return string
     */
    public function run(int $totalMedia)
    {
        $output = '';
        if($totalMedia) {
            for ($i = 1; $i <= $totalMedia; $i++) {
                $this->createImage();
            }

            $output = "Media created successfully (" . $totalMedia . ")";
            if ($this->command) {
                $this->command->info($output);
            }

        }

        return $output;
    }

    /**
     * Create image
     * @return mixed
     */
    public function createImage(){
        return factory(App\Models\Media::class)->create()->makeThumb(200, 200);
    }
}
