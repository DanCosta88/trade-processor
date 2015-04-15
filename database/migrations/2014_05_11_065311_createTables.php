<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoderblockTables extends Migration {


    /**
     *  Clear All old table, if them exists.
     */
    public function clearAll()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('countries');
    }

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            $this->clearAll();

            Schema::create('users', function($table)
            {
                $table->engine = 'InnoDB';                
                $table->increments('id');

                $table->timestamps();
                $table->softDeletes();
            });


            Schema::create('messages', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->mediumInteger('user_id')->unsigned();
                $table->mediumInteger('country_id')->unsigned();
                $table->string('currencyFrom', 20)->nullable();
                $table->string('currencyTo', 20)->nullable();
                $table->string('amountSell', 20)->nullable();
                $table->string('amountBuy', 20)->nullable();
                $table->string('rate', 20)->nullable();
                $table->time('timePlaced', 20)->nullable();

                $table->timestamps();
                $table->softDeletes();
            });

            Schema::create('countries', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('continent_id', 2);
                $table->string('country_name', 100);
                $table->string('country_iso_code', 2);

                $table->timestamps();
                $table->softDeletes();
            });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        $this->clearAll();
	}


}