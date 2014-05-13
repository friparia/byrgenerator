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
      <a href="{{ '{'.'{'.'action("UserController@getList")'.'}'.'}' }}">用户管理</a>
      </li>
    </ul>
  </div>

  <div class="row-fluid sortable">		
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i> 用户</h2>
        <div class="pull-right">
          <a href="#" class="btn btn-small btn-success btn-add"><i class="icon-plus"></i>添加用户</a>
        </div>
      </div>
      <div class="box-content">
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr>
              <th>用户名</th>
              <th>注册时间</th>
              <th>角色</th>
              <th>关联教师</th>
              <th>操作</th>
            </tr>
          </thead>   
          <tbody>
          {{ '@'.'foreach ($users as $user)' }}
          {{ '@'.'if (!$user->is("admin") || Auth::user()->is("admin") )' }}
            <tr>
              <td>{{ '{'.'{'.'$user->username'.'}'.'}' }}</td>
              <td class="center">{{ '{'.'{'.'$user->created_at'.'}'.'}' }}</td>
              <td class="center">{{ '{'.'{'.'implode(",", $user->display_role())'.'}'.'}' }}</td>
              <td class="center">{{ '@'.'if (array_key_exists($user->teacher_id, $teachers))'.'{'.'{'.' $teachers[$user->teacher_id]->name '.'}'.'}'.'@'.'endif' }}</td>
              <td class="center">
                <a class="btn btn-success btn-view" data-id="{{ $user->id }}">
                  <i class="icon-zoom-in icon-white"></i>  
                  查看
                </a>
                <a class="btn btn-info btn-edit" data-id="{{ $user->id }}">
                  <i class="icon-edit icon-white"></i>  
                  编辑
                </a>
                <a class="btn btn-danger btn-delete" data-id="{{ $user->id }}">
                  <i class="icon-trash icon-white"></i> 
                  删除
                </a>
              </td>
            </tr>
            {{ '@'.'endif' }}
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
    <h3>查看详情</h3>
  </div>
  <div class="modal-body">
    <table id="view-table" class="table table-striped">
      <tr>
        <td>#</td>
        <td id="viewuserid"></td>
      </tr>
      <tr>
        <td>用户名</td>
        <td id="viewusername"></td>
      </tr>
      <tr>
        <td>角色</td>
        <td id="viewuserrole"></td>
      </tr>
      <tr>
        <td>关联教师</td>
        <td id="viewteacher"></td>
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
    <h3>修改用户</h3>
  </div>
  <div class="modal-body">
    <form class="form-horizontal" id="userEditForm">
      <fieldset>
        <input type="hidden" id="edituserid" name="id"/>
        <div class="control-group">
          <label class="control-label">用户名</label>
          <div class="controls">
            <input id="editusername" name="username" type="text">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label">关联教师</label>
          <div class="controls">
            <select id="editteacher" name="teacher">
              <option value="0">不关联</option>
              {{ '@'.'foreach (Teacher::all() as $teacher)' }}
              <option value="{{ '{'.'{'.'$teacher->id'.'}'.'}' }}">{{ '{'.'{'.'$teacher->name'.'}'.'}' }}</option>
              {{ '@'.'endforeach' }}
            </select>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label">角色</label>
          <div class="controls">
            <input type="hidden" id="editrole" name="role"/>
            {{ '@'.'foreach( Role::all() as $role)' }}
            {{ '@'.'if ($role->name != "admin" || Auth::user()->is("admin") )' }}
            <label class="checkbox inline">
              <div class="checker"><span id="editrole_{{ '{'.'{'.'$role->name'.'}'.'}' }}"><input type="checkbox" class="input-edit-role" value="{{ '{'.'{'.'$role->id'.'}'.'}' }}" style="opacity: 0;"></span></div>{{ '{'.'{'.'$role->description'.'}'.'}' }}
            </label>
            {{ '@'.'endif' }}
            {{ '@'.'endforeach' }}
          </div>
        </div>
      </fieldset>
    </form>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">取消</a>
    <a href="#" class="btn btn-primary" id="userEditSave">保存</a>
  </div>
</div>
<div class="modal hide fade" id="addModal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>添加用户</h3>
  </div>
  <div class="modal-body">
    <form class="form-horizontal" id="userAddForm">
      <fieldset>
        <div class="control-group">
          <label class="control-label">用户名</label>
          <div class="controls">
            <input id="addusername" name="username" type="text">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label">密码</label>
          <div class="controls">
            <input id="addpassword" name="password" type="password">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label">密码确认</label>
          <div class="controls">
            <input id="addconfirmpassword" name="confirmpassword" type="password">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label">关联教师</label>
          <div class="controls">
            <select id="addteacher" name="teacher">
              <option value="0">不关联</option>
              {{ '@'.'foreach (Teacher::all() as $teacher)' }}
              <option value="{{ '{'.'{'.'$teacher->id'.'}'.'}' }}">{{ '{'.'{'.'$teacher->name'.}'.'}' }}</option>
              {{ '@'.'endforeach' }}
            </select>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label">角色</label>
          <div class="controls">
            <input type="hidden" id="addrole" name="role"/>
            {{ '@'.'foreach( Role::all() as $role)' }}
            {{ '@'.'if ($role->name != "admin" || Auth::user()->is("admin") )' }}
            <label class="checkbox inline">
              <div class="checker"><span id="addrole_{{ '{'.'{'.'$role->name'.'}'.'}' }}"><input type="checkbox" class="input-add-role" value="{{ '{'.'{'.'$role->id'.'}'.'}' }}" style="opacity: 0;"></span></div>{{ '{'.'{'.'$role->description'.'}'.'}' }}
            </label>
            {{ '@'.'endif' }}
            {{ '@'.'endforeach' }}
          </div>
        </div>
      </fieldset>
    </form>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">取消</a>
    <a href="#" class="btn btn-primary" id="userAddSave">保存</a>
  </div>
</div>
<script>
  $(document).ready(function(){

    $('.btn-view').click(function(){
      $('#viewModal').modal('show');
      $.get('{{ '{'.'{'.'action("UserController@getInfo")'.'}'.'}' }}', { id: $(this).attr('data-id') }, function(ret){
        if(ret.success == true){
          $('#viewuserid').html(ret.data.id);
          $('#viewusername').html(ret.data.username);
          $('#viewteacher').html(ret.teacher.name);
          var data = [];
          for(var i in ret.data.roles){
            data.push(ret.data.roles[i].description);
          }
          $('#viewuserrole').html(data.join(','));
        }
      });
    });

    $('.btn-add').click(function(){
      $('#addModal').modal('show');
    });

    $('.btn-edit').click(function(){
      $('#editModal').modal('show');
      $.get('{{ '{'.'{'.'action("UserController@getInfo")'.'}'.'}' }}', { id: $(this).attr('data-id') }, function(ret){
        if(ret.success == true){
          $('#editusername').val(ret.data.username);
          $('#edituserid').val(ret.data.id);
          $('#editteacher').val(ret.teacher.id);
          for(var i in ret.data.roles){
            $('#editrole_'+ret.data.roles[i].name).find("input").attr("checked",true).parent().addClass("checked");
          }
        }
      }, 'json');
    });

    $('.btn-delete').click(function(){
      if(confirm("确认删除？")){
        $.post('{{ '{'.'{'.'action("UserController@postDelete")'.'}'.'}' }}', { id : $(this).attr("data-id") }, function(ret){
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

    $('#userAddSave').click(function(){
      var checked = [];
      $('.input-add-role').each(function(){
        if($(this).attr('checked')){
          checked.push($(this).val());
        }
      });
      checked = checked.join(",");
      $('#addrole').val(checked);
      $.post('{{ '{'.'{'.'action("UserController@postStore")'.'}'.'}' }}', $('#userAddForm').serialize(), function(ret){
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

    $('#userEditSave').click(function(){
      var checked = [];
      $('.input-edit-role').each(function(){
        if($(this).attr('checked')){
          checked.push($(this).val());
        }
      });
      checked = checked.join(",");
      $('#editrole').val(checked);
      $.post('{{ '{'.'{'.'action("UserController@postUpdate")'.'}'.'}' }}', $('#userEditForm').serialize(), function(ret){
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
