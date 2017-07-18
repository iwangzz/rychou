<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLicencesAddField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('licences', function (Blueprint $table) {
        //     $table->string('company', 200)->default('')->after('category');
        //     $table->decimal('equity_ratio', 10, 2)->default(0)->after('company');
        //     $table->date('valid_date')->default('0000-00-00')->after('equity_ratio');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
