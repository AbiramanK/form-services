<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateECInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_c_information', function (Blueprint $table) {
            $table->id();
            $table -> string('name');  
            $table -> integer('telephone'); 
            $table -> string('email'); 
            $table -> string('website'); 
            $table -> string('is_ecno_available'); 
            $table -> string('streetaddress'); 
            $table -> string('city'); 
            $table -> string('state'); 
            $table -> integer('pincode');
            $table -> integer('ec_reg_no');
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
        Schema::dropIfExists('e_c_information');
    }
}
