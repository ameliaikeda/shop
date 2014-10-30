<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddOptionsMutationToProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('products', function(Blueprint $table)
		{
			$table->dropColumn('options');
			$table->integer('options_id')->unsigned();
			$table->string('options_type', 190);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('products', function(Blueprint $table)
		{
			$table->text('options');
			$table->dropColumn('options_id');
			$table->dropColumn('options_type');
		});
	}

}
