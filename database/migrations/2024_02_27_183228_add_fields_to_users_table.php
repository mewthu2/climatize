<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->rememberToken()->after('encrypted_password');
            $table->foreignId('current_team_id')->nullable()->after('remember_token');
            $table->string('profile_photo_path', 2048)->nullable()->after('current_team_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('remember_token');
            $table->dropForeign(['current_team_id']);
            $table->dropColumn('current_team_id');
            $table->dropColumn('profile_photo_path');
        });
    }
}
