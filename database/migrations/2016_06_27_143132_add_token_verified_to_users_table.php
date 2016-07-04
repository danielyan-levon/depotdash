<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTokenVerifiedToUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('verified')->default(false)->after('remember_token');
            $table->string('verification_token')->nullable()->after('verified');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('users', function (Blueprint $table) {
            $table->removeColumn('verified');
            $table->removeColumn('verification_token');
        });
    }

}
