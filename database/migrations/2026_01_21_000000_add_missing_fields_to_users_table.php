<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Check if columns exist before adding them to avoid errors if partial migrations ran
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable()->unique();
            }
            if (!Schema::hasColumn('users', 'username')) {
                $table->string('username')->nullable()->unique();
            }
            if (!Schema::hasColumn('users', 'balance')) {
                $table->decimal('balance', 15, 2)->default(0);
            }
            if (!Schema::hasColumn('users', 'code')) {
                $table->string('code')->nullable();
            }
            if (!Schema::hasColumn('users', 'sign_every_day')) {
                $table->boolean('sign_every_day')->default(0);
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'username', 'balance', 'code', 'sign_every_day']);
        });
    }
};
