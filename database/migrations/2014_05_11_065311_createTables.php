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

                // $table->primary('id');

                $table->timestamps();
                $table->softDeletes();
            });


            Schema::create('messages', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->mediumInteger('user_id')->unsigned();
                $table->string('ip_address', 20)->nullable();
                $table->string('user_agent', 255)->nullable();

                // $table->primary('id');

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