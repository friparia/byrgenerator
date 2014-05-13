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
      <a href="{{ '{'.'{'.'action("PermissionController@getList")'.'}'.'}' }}">权限管理</a>
      </li>
    </ul>
  </div>

  <div class="row-fluid sortable">		
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i> 权限</h2>
        <div class="pull-right">
          <a href="#" class="btn btn-small btn-success btn-add"><i class="icon-plus"></i>添加权限</a>
        </div>
      </div>
      <div class="box-content">
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr>
              <th>权限</th>
              <th>描述</th>
              <th>操作</th>
            </tr>
          </thead>   
          <tbody>
          {{ '@'.'foreach ($permissions as $permission)' }}
          <tr>
              <td class="center">{{ '{'.'{'.'$permission->name'.'}'.'}' }}</td>
              <td class="center">{{ '{'.'{'.'$permission->description'.'}'.'}' }}</td>
              <td class="center">
                <a class="btn btn-success btn-view" data-id="{{ '{'.'{'.'$permission->id'.'}'.'}' }}">
                  <i class="icon-zoom-in icon-white"></i>  
                  查看
                </a>
                <a class="btn btn-info btn-edit" data-id="{{ '{'.'{'.'$permission->id'.'}'.'}' }}">
                  <i class="icon-edit icon-white"></i>  
                  编辑
                </a>
                <a class="btn btn-danger btn-delete" data-id="{{ '{'.'{'.'$permission->id'.'}'.'}' }}">
                  <i class="icon-trash icon-white"></i> 
                  删除
                </a>
              </td>
            </tr>
            {{ '@'.'endforeach' }}
            </tbody>
        </table>            
        <div class="span12 center">
          {{ '{'.'{'.'$permissions->links()'.'}'.'}' }}
        </div>
      </div>
    </div><!--/span-->
  </div><!--/row-->
</div><!--/row-->

<div class="modal hide fade" id="viewModal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>查看权限</h3>
  </div>
  <div class="modal-body">
    <table id="view-table" class="table table-striped">
      <tr>
        <td>权限</td>
        <td id="viewname"></td>
      </tr>
      <tr>
        <td>描述</td>
        <td id="viewdescription"></td>
      </tr>
    </table>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">关闭</a>
  </div>
</div>

<div class="modal hide fade" id="editModal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>修改权限</h3>
  </div>
  <div class="modal-body">
    <form class="form-horizontal" id="permissionEditForm">
      <fieldset>
        <input type="hidden" id="editid" name="id"/>
        <div class="control-group">
          <label class="control-label">权限</label>
          <div class="controls">
            <input id="editname" name="name" type="text">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label">描述</label>
          <div class="controls">
            <input id="editdescription" name="description" type="text">
          </div>
        </div>
      </fieldset>
    </form>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">取消</a>
    <a href="#" class="btn btn-primary" id="permissionEditSave">保存</a>
  </div>
</div>
<div class="modal hide fade" id="addModal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>添加权限</h3>
  </div>
  <div class="modal-body">
    <form class="form-horizontal" id="permissionAddForm">
      <fieldset>
        <div class="control-group">
          <label class="control-label">权限</label>
          <div class="controls">
            <input id="addname" name="name" type="text">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label">描述</label>
          <div class="controls">
            <input id="adddescription" name="description" type="text">
          </div>
        </div>
      </fieldset>
    </form>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">取消</a>
    <a href="#" class="btn btn-primary" id="permissionAddSave">保存</a>
  </div>
</div>
<script>
  $(document).ready(function(){

    $('.btn-view').click(function(){
      $('#viewModal').modal('show');
      $.get('{{ '{'.'{'.'action("PermissionController@getInfo")'.'}'.'}' }}', { id: $(this).attr('data-id') }, function(ret){
        if(ret.success == true){
          $('#viewname').html(ret.data.name);
          $('#viewdescription').html(ret.data.description);
        }
      });
    });

    $('.btn-add').click(function(){
      $('#addModal').modal('show');
    });

    $('.btn-edit').click(function(){
      $('#editModal').modal('show');
      $.get('{{ '{'.'{'.'action("PermissionController@getInfo")'.'}'.'}' }}', { id: $(this).attr('data-id') }, function(ret){
        if(ret.success == true){
          $('#editid').val(ret.data.id);
          $('#editname').val(ret.data.name);
          $('#editdescription').val(ret.data.description);
        }
      }, 'json');
    });

    $('.btn-delete').click(function(){
      if(confirm("确认删除？")){
        $.post('{{ '{'.'{'.'action("PermissionController@postDelete")'.'}'.'}' }}', { id : $(this).attr("data-id") }, function(ret){
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

    $('#permissionAddSave').click(function(){
      $.post('{{ '{'.'{'.'action("PermissionController@postStore")'.'}'.'}' }}', $('#permissionAddForm').serialize(), function(ret){
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

    $('#permissionEditSave').click(function(){
      $.post('{{ '{'.'{'.'action("PermissionController@postUpdate")'.'}'.'}' }}', $('#permissionEditForm').serialize(), function(ret){
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
@stop
