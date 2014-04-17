{{ '<?php' }}

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        //Create user table
        Schema::create('users', function($table){
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->timestamps();
        });

        //Create role table
        Schema::create('roles', function($table){
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

        //Create user roles (many to many) table
        Schema::create('user_role', function($table){
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('role_id')->references('id')->on('roles');
        });

        //Create permissions table
        Schema::create('permissions', function($table){
            $table->increments('id');
            $table->string('name');
            $table->string('method');
            $table->string('display_name');
            $table->timestamps();
        });

        //Create permission role table (many to many) table
        Schema::create('permission_role', function($table){
            $table->increments('id');
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->foreign('permission_id')->references('id')->on('permissions');
            $table->foreign('role_id')->references('id')->on('roles');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('user_role', function(Blueprint $table){
            $table->dropForeign('user_role_user_id_foreign');
            $table->dropForeign('user_role_role_id_foreign');
        });
        Schema::table('permission_role', function(Blueprint $table){
            $table->dropForeign('permission_role_permission_id_foreign');
            $table->dropForeign('permission_role_role_id_foreign');
        });
        Schema::drop('user_role');
        Schema::drop('users');
        Schema::drop('roles');
        Schema::drop('permission_role');
        Schema::drop('permissions');
	}

}
