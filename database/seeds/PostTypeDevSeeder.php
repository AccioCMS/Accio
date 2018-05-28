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
     * @return string
     */
    public function run(int $totalPostTypes)
    {
        $output = '';
        if($totalPostTypes) {
            $postTypeNames = [];
            for ($i = 1; $i <= $totalPostTypes; $i++) {

                // Create post type row
                $createdPostType = factory(PostType::class)->create();

                // Create table
                PostType::createTable($createdPostType->slug);
                $postTypeNames[] = $createdPostType->name;
            }

            $output = 'Post Type' . ($totalPostTypes > 1 ? 's' : "") . ' (' . implode(", ", $postTypeNames) . ')  created successfully!';

            if ($this->command) {
                $this->command->info($output);
            }
        }

        return $output;
    }
}
