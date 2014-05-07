{{ '<?php' }}
class Role extends Eloquent{
    protected $table = 'roles';
    protected $fillable = array('name', 'description');

    public function users(){
        return $this->belongsToMany('User', 'user_role');
    }

    public function permissions(){
        return $this->belongsToMany('Permission', 'permission_role');
    }

    public function display_permission(){
        $permissions = array();
        foreach($this->permissions as $permission){
            $permissions[] = $permission->description;
        }
        return $permissions;
    }

    public function can($permissions){
        foreach($this->permissions as $permission){
            if(in_array($permission->name, $permissions)){
                return true;
            }
        }
        return false;
    }
}
