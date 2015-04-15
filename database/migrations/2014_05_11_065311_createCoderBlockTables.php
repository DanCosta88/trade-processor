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
        Schema::dropIfExists('message_user');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('blocks');
        Schema::dropIfExists('coder_project');
        Schema::dropIfExists('coder_block');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('countries');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('continent');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('lessons');
        Schema::dropIfExists('meta');
        Schema::dropIfExists('coder_course');
        Schema::dropIfExists('coder_lesson');
        Schema::dropIfExists('block_lesson');
    }

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            $this->clearAll();

            Schema::create('coders', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('username', 255)->unique();
                $table->string('email', 255)->unique();
                $table->string('password', 255)->nullable();
                $table->mediumInteger('coding_points')->unsigned()->default(0);
                $table->mediumInteger('battle_points')->unsigned()->default(0);
                $table->mediumInteger('teaching_points')->unsigned()->default(0);
                $table->mediumInteger('can_teaching')->unsigned()->default(0);
                $table->mediumInteger('first_login')->unsigned()->default(0);
                $table->string('ip_address',20)->nullable();                
                $table->string('ip_registration_address', 20)->nullable();
                $table->mediumInteger('confirmation_email')->unsigned()->default(0);
//                $table->string('remember_token')->nullable();
                $table->mediumInteger('confirmed')->unsigned()->default(0);
                $table->smallInteger('blacklist')->unsigned()->default(0);
                $table->mediumInteger('has_feedback_mail')->unsigned()->default(0);                                
                $table->mediumInteger('total_wall_impressions')->unsigned()->default(0);

                $table->rememberToken();

                $table->timestamps();
                $table->softDeletes();
            });


            Schema::create('users', function($table)
            {
                $table->engine = 'InnoDB';                
                $table->increments('id');
                $table->string('email', 45)->unique();
                $table->string('username', 45);
                $table->string('password', 45)->nullable();
                $table->string('remember_token')->nullable();

                // $table->primary('id');

                $table->timestamps();
                $table->softDeletes();
            });


            Schema::create('signins', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->mediumInteger('coder_id')->unsigned();
                $table->string('ip_address', 20)->nullable();
                $table->string('user_agent', 255)->nullable();

                // $table->primary('id');

                $table->timestamps();
                $table->softDeletes();
            });
           


            Schema::create('languages', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('label', 45);
                $table->string('slug', 45);
                $table->string('extensions', 5)->nullable();
                $table->mediumInteger('courses_counter')->unsigned()->default(0);
                $table->mediumInteger('lessons_counter')->unsigned()->default(0);                
                $table->mediumInteger('blocks_counter')->unsigned()->default(0);
                $table->mediumInteger('questions_counter')->unsigned()->default(0);
                $table->mediumInteger('answers_counter')->unsigned()->default(0);

                $table->timestamps();
                $table->softDeletes();
            });


            Schema::create('projects', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('title', 255)->nullable();
                $table->string('description', 600)->nullable();
                $table->string('slug', 40)->nullable();
                $table->string('bare_path', 255);
                $table->string('working_path', 255);
                $table->smallInteger('language_id')->unsigned()->nullable();
                $table->smallInteger('social_id')->unsigned()->nullable();
                $table->smallInteger('permission_id')->unsigned()->default(1);

                $table->timestamps();
                $table->softDeletes();
            });

            Schema::create('permissions', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('label', 50);

                $table->timestamps();
                $table->softDeletes();
            });

            Schema::create('blocks', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('title', 255)->nullable();
                $table->string('content', 600)->nullable();
                $table->string('slug', 40)->nullable();
                $table->binary('encoding', 600)->nullable();

                $table->smallInteger('language_id')->unsigned()->nullable();
                $table->smallInteger('social_id')->unsigned()->nullable();

                $table->timestamps();
                $table->softDeletes();
            });

            Schema::create('commits', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('hash', 255)->nullable();

                $table->smallInteger('project_id')->unsigned()->nullable();

                $table->timestamps();
                $table->softDeletes();
            });

            Schema::create('socials', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->mediumInteger('likes')->unsigned()->default(0);
                $table->mediumInteger('shares')->unsigned()->default(0);
                $table->mediumInteger('comments')->unsigned()->default(0);

                $table->timestamps();
                $table->softDeletes();
            });

            Schema::create('medium', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('url', 255)->nullable();

                $table->smallInteger('social_id')->unsigned()->nullable();

                $table->timestamps();
                $table->softDeletes();
            });


            Schema::create('statuses', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->mediumInteger('coder_id')->unsigned();
                $table->mediumInteger('owner_id')->unsigned();
                $table->string('body', 255)->nullable();
                $table->smallInteger('language_id')->unsigned()->nullable();
                $table->smallInteger('social_id')->unsigned()->nullable();

                $table->timestamps();
                $table->softDeletes();
            });


        Schema::create('continents', function($table)
            {
                $table->engine = 'InnoDB';
                $table->string('id');
                $table->string('continent_name', 45);
                $table->string('continent_code', 2);

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


            Schema::create('cities', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id');

                $table->string('continent_id', 2);
                $table->string('country_id', 2);

                $table->string('subdivision_iso_code', 2);
                $table->string('subdivision_name', 45);
                $table->string('city_name', 45);
                $table->string('metro_code', 2);
                $table->string('time_zone', 45);

                $table->timestamps();
                $table->softDeletes();
            });

           
            Schema::create('courses', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->mediumInteger('coder_id')->unsigned();                
                $table->string('title', 255)->nullable();
                $table->string('description',600)->nullable();
                $table->string('slug', 40)->nullable();
                $table->smallInteger('num_lessons')->unsigned()->default(0);
                $table->smallInteger('partecipants')->unsigned()->default(0);
                $table->smallInteger('is_test')->unsigned()->default(0);
                $table->smallInteger('language_id')->unsigned()->nullable();
                $table->decimal('price',10,2)->default(0);       

                $table->timestamps();
                $table->softDeletes();
            });
                      

            Schema::create('lessons', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->mediumInteger('course_id')->unsigned(); 
                $table->string('title', 255)->nullable();
                $table->text('content', 600)->nullable();
                $table->string('slug', 40)->nullable();
                $table->smallInteger('impressions')->unsigned()->default(0);
                $table->smallInteger('likes')->unsigned()->default(0);
                $table->smallInteger('shares')->unsigned()->default(0);

                $table->timestamps();
                $table->softDeletes();

                $table->string('creation_date')->nullable();
                $table->string('updated_date')->nullable();
            });
           

            Schema::create('profile', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->mediumInteger('coder_id')->unsigned();
                $table->string('first_name', 255)->nullable();
                $table->string('last_name', 255)->nullable();
                $table->string('paypal', 255)->nullable();
                $table->string('gender', 6)->nullable();
                $table->string('picture_url', 200)->nullable();
                $table->string('panorama_url', 200)->nullable();
                $table->string('facebook_username', 45)->nullable();
                $table->string('twitter_username', 45)->nullable();
                $table->string('github_username', 45)->nullable();
                $table->string('fb_token', 45)->nullable();
                $table->string('tw_token', 45)->nullable();
                $table->string('gh_token', 45)->nullable();
                $table->string('address', 100)->nullable();
                $table->string('postal_code', 10)->nullable();
                $table->text('bio', 600)->nullable();
                $table->mediumInteger('country_id')->unsigned();                    
                $table->mediumInteger('city_id')->unsigned();
                $table->string('date_of_birth')->nullable();
                $table->string('website',255)->nullable();

                // $table->primary('id');

                $table->timestamps();
                $table->softDeletes();
            });
           


            Schema::create('coder_project', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->mediumInteger('coder_id')->unsigned();
                $table->mediumInteger('project_id')->unsigned();
                $table->smallInteger('is_parent')->unsigned()->default(0);

                // $table->primary('id');

                $table->timestamps();
                $table->softDeletes();
            });


            Schema::create('coder_block', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->mediumInteger('blocks_id')->unsigned();
                $table->mediumInteger('coders_id')->unsigned();
                $table->smallInteger('is_parent')->unsigned()->default(0);

                // $table->primary('id');

                $table->timestamps();
                $table->softDeletes();
            });


            Schema::create('coder_course', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->mediumInteger('coders_id')->unsigned();
                $table->mediumInteger('courses_id')->unsigned();
                $table->smallInteger('vote')->unsigned()->default(0);

                // $table->primary('id');

                $table->timestamps();
                $table->softDeletes();
            });
            

            Schema::create('coder_lesson', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->mediumInteger('coders_id')->unsigned();
                $table->mediumInteger('lessons_id')->unsigned();
                $table->smallInteger('vote')->unsigned()->default(0);

                // $table->primary('id');

                $table->timestamps();
                $table->softDeletes();
            });

            Schema::create('block_lesson', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->mediumInteger('blocks_id')->unsigned();
                $table->mediumInteger('lessons_id')->unsigned();

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