<?php

namespace App\Models;

use Accio\User\Models\UserModel;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends UserModel
{
    use Notifiable, HasApiTokens;

}
