<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$this->down();
		Schema::create('attends', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('remote_addr')->index();
			$table->string('user_agent')->index();
			$table->timestamps('created_at');
			/**$table->timestamps('updated_at');**/
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('attends');
	}

}
