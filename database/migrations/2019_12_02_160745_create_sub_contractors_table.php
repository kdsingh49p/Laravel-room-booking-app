<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubContractorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_contractors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sub_contractors_name')->nullable();
            $table->string('sub_contractors_rep_01')->nullable();
            $table->string('sub_contractors_rep_02')->nullable();
            $table->string('sub_contractors_contact_01')->nullable();
            $table->string('sub_contractors_contact_02')->nullable();
            $table->string('sub_contractors_email_01');
            $table->string('sub_contractors_email_02')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_contractors');
    }
}
