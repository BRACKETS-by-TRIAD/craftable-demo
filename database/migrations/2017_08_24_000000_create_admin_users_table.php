<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            Schema::create('admin_users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('first_name')->nullable();
                $table->string('last_name')->nullable();
                $table->string('email');
                $table->string('password');
                $table->rememberToken();

                $table->boolean('activated')->default(false);
                $table->boolean('forbidden')->default(false);
                $table->string('language', 2)->default('en');

                $table->softDeletes('deleted_at');
                $table->timestamps();

                $table->unique(['email', 'deleted_at']);
            });

            $connection = config('database.default');
            $driver = config("database.connections.{$connection}.driver");
            if ($driver == 'pgsql') {
                Schema::table('admin_users', function (Blueprint $table) {
                    DB::statement('CREATE UNIQUE INDEX admin_users_email_null_deleted_at ON admin_users (email) WHERE deleted_at IS NULL;');
                });
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_users');
    }
}
