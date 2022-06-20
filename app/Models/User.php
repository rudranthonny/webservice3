<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Http;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    public $token = '3965c3e3228fac0de59b88b77c2625fb';
    public $domainname = 'http://aprendiendo.jademlearning.com/webservice/rest/server.php';
   

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function grados(){
        return $this->belongsToMany(Grado::class);
    }
    //okey
    public function suspender(User $user){
        //declarar variables
        $token = '3965c3e3228fac0de59b88b77c2625fb';
        $domainname = 'http://aprendiendo.jademlearning.com/webservice/rest/server.php';
        $functionname = 'core_user_update_users';
        //preparar consulta
        $consulta = $domainname. '/webservice/rest/server.php'
        . '?wstoken=' . $token 
        . '&wsfunction='.$functionname
        .'&moodlewsrestformat=json&users[0][id]='.$user->id_user_moodle.
        '&users[0][suspended]='.$user->estado;
         Http::get($consulta);
    }
}
