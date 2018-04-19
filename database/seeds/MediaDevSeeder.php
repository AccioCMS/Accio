<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\Cache;

class MediaDevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param int $collections Defines how many media shall be created
     * @return string
     */
    public function run($collections = null)
    {

        if(!is_numeric($collections)){
            $collections = 1;
        }

        if($collections) {
            for ($i = 1; $i <= $collections; $i++) {
                $this->createImage();
            }

            $output = "Media created successfully (" . $collections . ")";
            if ($this->command) {
                $this->command->info($output);
            }

            return $output;
        }
    }

    /**
     * Create image
     * @return mixed
     */
    public function createImage(){
        return factory(App\Models\Media::class)->create()->makeThumb(200, 200);
    }
}
