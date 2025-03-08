<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['address', 'postal_code', 'city', 'country', 'employee_count', 'website', 'logo']);
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->integer('employee_count')->nullable();
            $table->string('website')->nullable();
            $table->string('logo')->nullable();
        });
    }
};
