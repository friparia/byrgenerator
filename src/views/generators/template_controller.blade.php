{{ '<?php' }}

class {{ $classname }}Controller extends BaseController{

    public function getList(){
        if(!Auth::user()->can('{{ $name }}.read')){
            App::abort(403);
        }
        ${{ $name }}s = {{ $classname }}::paginate(20);
        return View::make('master')->nest('content', '{{ $name }}.index', array('{{ $name }}s' => ${{ $name }}s))->nest('sidebar', 'sidebar', array('active' => '{{ $name }}' ))->nest('navbar', 'navbar');
    }

    public function getInfo(){
        if(!Auth::user()->can('{{ $name }}.read')){
            App::abort(403);
        }
        ${{ $name }} = {{ $classname }}::find(Input::get('id'));
        return Response::json(array('success'=>true, 'data'=>${{ $name }}->toArray()));
    }

    public function postStore(){
        if(!Auth::user()->can('{{ $name }}.create')){
            App::abort(403);
        }
        ${{ $name }} = new {{ $classname }}();

        @foreach ($attributes as $attribute)
${{ $name }}->{{ $attribute['name'] }} = Input::get('{{ $attribute['name'] }}');
        @endforeach

        if(${{ $name }}->save()){
            return Response::json(array('success'=>true));
        }
        return Response::json(array('success'=>false, 'id'=>'alert', 'msg'=>'发生错误，请联系管理员'));
    }

    public function postUpdate(){
        if(!Auth::user()->can('{{ $name }}.update')){
            App::abort(403);
        }
        ${{ $name }} = {{ $classname }}::find(Input::get('id'));

        @foreach ($attributes as $attribute)
${{ $name }}->{{ $attribute['name'] }} = Input::get('{{ $attribute['name'] }}');
        @endforeach

        if(${{ $name }}->save()){
            return Response::json(array('success'=>true));
        }
        return Response::json(array('success'=>false, 'id'=>'alert', 'msg'=>'发生错误，请联系管理员'));
    }

    public function postDelete(){
        if(!Auth::user()->can('{{ $name }}.delete')){
            App::abort(403);
        }
        {{ $classname }}::destroy(Input::get('id'));
        return Response::json(array('success'=>true));
    }
}
