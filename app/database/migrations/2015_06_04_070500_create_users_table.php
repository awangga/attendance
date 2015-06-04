<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$this->down();
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('profile_id');
			$table->string('domain_id', 255)->nullable();
			$table->string('email', 255);
			$table->string('username', 255);
			$table->string('password', 255);
			$table->timestamp('created_at');
			$table->timestamp('updated_at');
			$table->timestamp('deleted_at')->nullable();
			$table->integer('status');
			$table->integer('flag_banned')->default(0);
			$table->string('remember_token', 100)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('users');
	}

}
