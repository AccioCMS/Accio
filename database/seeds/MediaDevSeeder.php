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
            if(isset($this->command)) {
                $this->command->info("Media created (" . $totalMedia . ")");
            }
        }elsE{
            if(isset($this->command)) {
                $this->command->error("Please give a total number of media you would like to create!");
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
