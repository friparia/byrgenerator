{{ '<?php' }}
class Permission extends Eloquent{
    protected $table = 'permissions';
    protected $fillable = array('name', 'description');

    public function roles(){
        return $this->belongsToMany('Role', 'permission_role');
    }
}
