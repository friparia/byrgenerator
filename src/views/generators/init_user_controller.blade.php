{{ '<?php' }}

class UserController extends BaseController{
    public function getLogin(){
        return View::make('user.login', array('msg' => Input::get('msg')));
    }

    public function postLogin(){
        $username = Input::get('username');
        $password = Input::get('password');
        if(Auth::attempt(array('username' => $username, 'password' => $password))){
            return Redirect::to('/');
        }
        else{
            return Redirect::to('user/login?msg=用户名或密码错误');
        }
    }
}
