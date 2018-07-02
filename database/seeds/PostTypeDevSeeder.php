<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\Schema;
use App\Models\PostType;

class PostTypeDevSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @param int $totalPostTypes Number of post types to create
     * @return void
     */
    public function run(int $totalPostTypes)
    {
        if($totalPostTypes) {
            $postTypeNames = [];
            for ($i = 1; $i <= $totalPostTypes; $i++) {

                // Create post type row
                $createdPostType = factory(PostType::class)->create();

                // Create table
                PostType::createTable($createdPostType->slug);
                $postTypeNames[] = $createdPostType->name;
            }
            if(isset($this->command)){
                $this->command->info('Post Types created (' . implode(", ", $postTypeNames) . ')');
            }
        }else{
            if(isset($this->command)){
                $this->command->error("Please give a total number of post type you would like to create!");
            }
        }

        return;
    }
}
