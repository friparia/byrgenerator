{{ '<?php' }}

use Illuminate\Auth\UserInterface;
class User extends Eloquent implements UserInterface{
    protected $table = 'users';
    protected $hidden = array('password');
    protected $fillable = array('username', 'password');

    public function getAuthIdentifier(){
        return $this->getKey();
    }

    public function getAuthPassword(){
        return $this->password;
    }

}
