<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ratings', function (Blueprint $table) {
            $table->renameColumn('message', 'value');
        });

        Schema::table('ratings', function (Blueprint $table) {
            $table->integer('value')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ratings', function (Blueprint $table) {
            $table->renameColumn('value', 'message');
        });

        Schema::table('ratings', function (Blueprint $table) {
            $table->char('message', 200)->change();
        });
    }
}
