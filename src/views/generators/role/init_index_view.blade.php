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
      <a href="{{ '{'.'{'.'action("RoleController@getList")'.'}'.'}' }}">角色管理</a>
      </li>
    </ul>
  </div>

  <div class="row-fluid sortable">		
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i> 角色</h2>
        <div class="pull-right">
          <a href="#" class="btn btn-small btn-success btn-add"><i class="icon-plus"></i>添加角色</a>
        </div>
      </div>
      <div class="box-content">
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr>
              <th>角色</th>
              <th>描述</th>
              <th>权限</th>
              <th>操作</th>
            </tr>
          </thead>   
          <tbody>
          {{ '@'.'foreach ($roles as $role)' }}
          <tr>
              <td class="center">{{ '{'.'{'.'$role->name'.'}'.'}' }}</td>
              <td class="center">{{ '{'.'{'.'$role->description'.'}'.'}' }}</td>
              <td class="center">{{ '{'.'{'.'implode(",", $role->display_permission())'.'}'.'}' }}</td>
              <td class="center">
                <a class="btn btn-success btn-view" data-id="{{ '{'.'{'.'$role->id'.'}'.'}' }}">
                  <i class="icon-zoom-in icon-white"></i>  
                  查看
                </a>
                <a class="btn btn-info btn-edit" data-id="{{ '{'.'{'.'$role->id'.'}'.'}' }}">
                  <i class="icon-edit icon-white"></i>  
                  编辑
                </a>
                <a class="btn btn-danger btn-delete" data-id="{{ '{'.'{'.'$role->id'.'}'.'}' }}">
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
    <h3>查看角色</h3>
  </div>
  <div class="modal-body">
    <table id="view-table" class="table table-striped">
      <tr>
        <td>角色</td>
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
    <h3>修改角色</h3>
  </div>
  <div class="modal-body">
    <form class="form-horizontal" id="roleEditForm">
      <fieldset>
        <input type="hidden" id="editid" name="id"/>
        <div class="control-group">
          <label class="control-label">角色</label>
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
        <div class="control-group">
          <label class="control-label">权限</label>
          <div class="controls">
            <input type="hidden" id="editpermission" name="permission"/>
            {{ '@'.'foreach( Permission::all() as $permission)' }}
            <label class="checkbox inline">
              <div class="checker"><span id="editpermission_{{ '{'.'{'.' $permission->id '.'}'.'}' }}"><input type="checkbox" class="input-edit-permission" value="{{ '{'.'{'.'$permission->id'.'}'.'}' }}" style="opacity: 0;"></span></div>{{ '{'.'{'.'$permission->description'.'}'.'}' }}
            </label>
            {{ '@'.'endforeach' }}
          </div>
        </div>
      </fieldset>
    </form>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">取消</a>
    <a href="#" class="btn btn-primary" id="roleEditSave">保存</a>
  </div>
</div>
<div class="modal hide fade" id="addModal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>添加角色</h3>
  </div>
  <div class="modal-body">
    <form class="form-horizontal" id="roleAddForm">
      <fieldset>
        <div class="control-group">
          <label class="control-label">角色</label>
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
        <div class="control-group">
          <label class="control-label">权限</label>
          <div class="controls">
            <input type="hidden" id="addpermission" name="permission"/>
            {{ '@'.'foreach( Permission::all() as $permission)' }}
            <label class="checkbox inline">
              <div class="checker"><span id="addpermission_{{ '{'.'{'.'$permission->id'.'}'.'}' }}"><input type="checkbox" class="input-add-permission" value="{{ '{'.'{'.'$permission->id'.'}'.'}' }}" style="opacity: 0;"></span></div>{{ '{'.'{'.'$permission->description'.'}'.'}' }}
            </label>
            {{ '@'.'endforeach' }}
          </div>
        </div>
      </fieldset>
    </form>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">取消</a>
    <a href="#" class="btn btn-primary" id="roleAddSave">保存</a>
  </div>
</div>
<script>
  $(document).ready(function(){

    $('.btn-view').click(function(){
      $('#viewModal').modal('show');
      $.get('{{ '{'.'{'.'action("RoleController@getInfo")'.'}'.'}' }}', { id: $(this).attr('data-id') }, function(ret){
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
      $.get('{{ '{'.'{'.'action("RoleController@getInfo")'.'}'.'}' }}', { id: $(this).attr('data-id') }, function(ret){
        if(ret.success == true){
          $('#editid').val(ret.data.id);
          $('#editname').val(ret.data.name);
          $('#editdescription').val(ret.data.description);
          for(var i in ret.data.permissions){
            $('#editpermission_'+ret.data.permissions[i].id).find("input").attr("checked",true).parent().addClass("checked");
          }
        }
      }, 'json');
    });

    $('.btn-delete').click(function(){
      if(confirm("确认删除？")){
        $.post('{{ '{'.'{'.'action("RoleController@postDelete")'.'}'.'}' }}', { id : $(this).attr("data-id") }, function(ret){
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

    $('#roleAddSave').click(function(){
      var checked = [];
      $('.input-add-permission').each(function(){
        if($(this).attr('checked')){
          checked.push($(this).val());
        }
      });
      checked = checked.join(",");
      $('#addpermission').val(checked);
      $.post('{{ '{'.'{'.'action("RoleController@postStore")'.'}'.'}' }}', $('#roleAddForm').serialize(), function(ret){
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

    $('#roleEditSave').click(function(){
      var checked = [];
      $('.input-edit-permission').each(function(){
        if($(this).attr('checked')){
          checked.push($(this).val());
        }
      });
      checked = checked.join(",");
      $('#editpermission').val(checked);
      $.post('{{ '{'.'{'.'action("RoleController@postUpdate")'.'}'.'}' }}', $('#roleEditForm').serialize(), function(ret){
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
