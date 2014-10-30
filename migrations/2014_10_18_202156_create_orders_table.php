<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('total')->unsigned();
			$table->integer('user_id')->unsigned()->index();

			// the card used for the charge; could be different to customer's card.
			$table->integer('card_id')->unsigned()->index();
			$table->enum('status', [
				"shipped",
				"paid",
				"cancelled",
				"rejected",
				"pending",
			]);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orders');
	}

}
