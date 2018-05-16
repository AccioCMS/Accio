<?php

use Illuminate\Database\Seeder;

class UserDevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param int $usersPerRole
     * @return string
     * @throws Exception
     */
    public function run($usersPerRole = null)
    {
        if(is_numeric($usersPerRole)) {
            // Create some users for each role
            $roles = \App\Models\UserGroup::all();
            if (!$roles->count()) {
                Throw new Exception("No posts created. You need at least 1 user role");
            }

            foreach ($roles as $role) {
                $this->createUser($role->userGroupID, $usersPerRole);
            }

            $output = "Users created successfully (" . ($usersPerRole * $roles->count()) . ")";
            if ($this->command) {
                $this->command->info($output);
            }

            return $output;
        }
    }

    /**
     * @param int $roleID If not roleID given, a random role will be chosen
     * @param int $usersPerRole
     * @return mixed
     */
    public function createUser($roleID = null, $usersPerRole = 1){
        if(!$roleID){
            $roleID = \App\Models\UserGroup::getEditorGroup()->groupID;
        }

        $user = factory(App\Models\User::class, $usersPerRole)->create();

        // assign role
        if($user) {
            $user->assignRoles([$roleID]);
        }
    }
}
