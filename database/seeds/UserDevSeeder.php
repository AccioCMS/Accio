<?php

use Illuminate\Database\Seeder;

class UserDevSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @param int $totalUsers
     * @param int $usersPerRole
     * @param int $roleID
     * @return string
     * @throws Exception
     */
    public function run(int $totalUsers = 0, int $usersPerRole = 0, int $roleID = 0)
    {
        $output = '';
        if($totalUsers || $usersPerRole) {
            $usersCreated = 0;

            $roles = \App\Models\UserGroup::all();
            if (!$roles->count()) {
                Throw new Exception("No users created. You need at least 1 user role to proceed!");
            }

            if($usersPerRole) {
                foreach ($roles as $role) {
                    $usersCreated++;
                    $this->createUser($usersPerRole, $role->groupID);
                }
            }else{
                $usersCreated = $totalUsers;
                $this->createUser($totalUsers, $roleID);
            }

            $output = "Users created successfully (" . ($usersCreated) . ")";
            if ($this->command) {
                $this->command->info($output);
            }
        }
        return $output;
    }

    /**
     * Create user
     *
     * @param int $totalUsers
     * @param int $roleID If not roleID given, a random role will be chosen
     * @return mixed
     * @throws Exception
     */
    public function createUser(int $totalUsers = 1, int $roleID = 0){
        if(!$roleID){
            $roleID = \App\Models\UserGroup::getEditorGroup()->groupID;
        }

        $users = factory(App\Models\User::class, $totalUsers)->create();

        // assign role
        if($users) {
            foreach($users as $user){
                $user->assignRoles($roleID);
            }
        }else{
            throw new Exception("Something went wrong!");
        }
    }
}
