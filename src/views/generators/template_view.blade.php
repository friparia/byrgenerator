{{ '@'.'extends("master")' }}

{{ '@'.'section("content")' }}

<noscript>
  <div class="alert alert-block span10">
    <h4 class="alert-heading">Warning!</h4>
    <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
  </div>
</noscript>

<div id="content" class="span10">

  <div>
    <ul class="breadcrumb">
      <li>
      <a href="/">主页</a> <span class="divider">/</span>
      </li>
      <li>
      <a href="{{ '{'.'{ action("'.$classname.'Controller@getList'.'")'.' }'.'}' }}">{{ $description }}管理</a>
      </li>
    </ul>
  </div>

  <div class="row-fluid sortable">		
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i> {{ $description }}</h2>
        <div class="pull-right">
          <a href="#" class="btn btn-small btn-success btn-add"><i class="icon-plus"></i>添加{{ $description }}</a>
        </div>
      </div>
      <div class="box-content">
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr>
            @foreach ($attributes as $attribute)
              <th>{{ $attribute['description'] }}</th>
            @endforeach
            </tr>
          </thead>   
          <tbody>
            {{ '@'.'foreach ($'.$name.'s as $'.$name.')' }}
            <tr>
              @foreach ($attributes as $attribute)
              <td class="center">{{ '{'.'{ $'.$name.'->'.$attribute['name'].' }'.'}' }}</td>
              @endforeach
              <td class="center">
                <a class="btn btn-success btn-view" data-id="{{ '{'.'{ $'.$name.'->id }'.'}' }}">
                  <i class="icon-zoom-in icon-white"></i>  
                  查看
                </a>
                <a class="btn btn-info btn-edit" data-id="{{ '{'.'{ $'.$name.'->id }'.'}' }}">
                  <i class="icon-edit icon-white"></i>  
                  编辑
                </a>
                <a class="btn btn-danger btn-delete" data-id="{{ '{'.'{ $'.$name.'->id }'.'}' }}">
                  <i class="icon-trash icon-white"></i> 
                  删除
                </a>
              </td>
            </tr>
            {{ '@'.'endforeach' }}
          </tbody>
        </table>            
      </div>
    </div><!--/span-->
  </div><!--/row-->
</div><!--/row-->

<div class="modal hide fade" id="viewModal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>查看{{ $description }}</h3>
  </div>
  <div class="modal-body">
    <table id="view-table" class="table table-striped">
      @foreach ($attributes as $attribute)
      <tr>
        <td>{{ $attribute['description'] }}</td>
        <td id="view{{ $attribute['name'] }}"></td>
      </tr>
      @endforeach
    </table>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">关闭</a>
  </div>
</div>

<div class="modal hide fade" id="editModal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>修改{{ $description }}</h3>
  </div>
  <div class="modal-body">
    <form class="form-horizontal" id="{{ $name }}EditForm">
      <fieldset>
        <input type="hidden" id="edit{{ $name }}id" name="id"/>
        @foreach ($attributes as $attribute)
        <div class="control-group">
          <label class="control-label">{{ $attribute['description'] }}</label>
          <div class="controls">
            <input id="edit{{ $attribute['name'] }}" name="{{ $attribute['name'] }}" type="text">
          </div>
        </div>
        @endforeach
      </fieldset>
    </form>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">取消</a>
    <a href="#" class="btn btn-primary" id="{{ $name }}EditSave">保存</a>
  </div>
</div>
<div class="modal hide fade" id="addModal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>添加{{ $description }}</h3>
  </div>
  <div class="modal-body">
    <form class="form-horizontal" id="{{ $name }}AddForm">
      <fieldset>
        @foreach ($attributes as $attribute)
        <div class="control-group">
          <label class="control-label">{{ $attribute['description'] }}</label>
          <div class="controls">
            <input id="add{{ $attribute['name'] }}" name="{{ $attribute['name'] }}" type="text">
          </div>
        </div>
        @endforeach
      </fieldset>
    </form>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">取消</a>
    <a href="#" class="btn btn-primary" id="{{ $name }}AddSave">保存</a>
  </div>
</div>
<script>
  $(document).ready(function(){

    $('.btn-view').click(function(){
      $('#viewModal').modal('show');
      $.get('{{ '{'.'{ action("'.$classname.'Controller@getInfo'.'")'.' }'.'}' }}', { id: $(this).attr('data-id') }, function(ret){
        if(ret.success == true){
          @foreach( $attributes as $attribute)
          $('#view{{ $attribute['name'] }}').html(ret.data.{{ $attribute['name'] }});
          @endforeach
        }
      });
    });

    $('.btn-add').click(function(){
      $('#addModal').modal('show');
    });

    $('.btn-edit').click(function(){
      $('#editModal').modal('show');
      $.get('{{ '{'.'{ action("'.$classname.'Controller@getInfo'.'")'.' }'.'}' }}', { id: $(this).attr('data-id') }, function(ret){
        if(ret.success == true){
          @foreach( $attributes as $attribute)
          $('#edit{{ $attribute['name'] }}').val(ret.data.{{ $attribute['name'] }});
          @endforeach
        }
      }, 'json');
    });

    $('.btn-delete').click(function(){
      if(confirm("确认删除？")){
        $.post('{{ '{'.'{ action("'.$classname.'Controller@postDelete'.'")'.' }'.'}' }}', { id : $(this).attr("data-id") }, function(ret){
          if(ret.success){
            alert("删除成功");
            location.reload();
          }
          else{
            alert("删除失败");
          }
        });
      }
    });

    $("input:checkbox, input:radio, input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform();

    $('#{{ $name }}AddSave').click(function(){
      $.post('{{ '{'.'{ action("'.$classname.'Controller@postStore'.'")'.' }'.'}' }}', $('#{{ $name }}AddForm').serialize(), function(ret){
        if(ret.success){
          alert('添加成功！');
          location.reload();
        }
        else{
          if(ret.id == 'alert'){
            alert(ret.msg);
          }
          else{
            var content = '<span class="help-inline">'+ ret.msg +'</span>';
            $('#add'+ret.id).after(content).parent().parent().addClass("error");
          }
        }
      },'json');
    });

    $('#{{ $name }}EditSave').click(function(){
      $.post('{{ '{'.'{ action("'.$classname.'Controller@postUpdate'.'")'.' }'.'}'  }}', $('#{{ $name }}EditForm').serialize(), function(ret){
        if(ret.success){
          alert('修改成功！');
          location.reload();
        }
        else{
          if(ret.id == 'alert'){
            alert(ret.msg);
          }
          else{
            var content = '<span class="help-inline">'+ ret.msg +'</span>';
            $('#add'+ret.id).after(content).parent().parent().addClass("error");
          }
        }
      },'json');
    });
  });
</script>
{{ '@'.'stop' }}
