<?php
/**
 * Created by PhpStorm.
 * User: sopa
 * Date: 01/05/2018
 * Time: 4:28 PM
 */

namespace Tests\Browser\Traits;


use App\Models\UserGroup;

trait User
{
    /**
     * Get the admin group
     * @return mixed
     * @throws \Exception
     */
    public function getAdminGroup(){
        $find = UserGroup::where('slug','admin')->first();
        if(!$find){
            throw new \Exception("No admin group found");
        }

        return $find;
    }
    public function getAnAdmin(){

    }
}