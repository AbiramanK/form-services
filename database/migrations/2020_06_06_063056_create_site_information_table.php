<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_information', function (Blueprint $table) {
            $table->id();
            $table -> string('clinic_name');  
            $table -> integer('telephone'); 
            $table -> string('email'); 
            $table -> string('website'); 
            $table -> string('ec_available'); 
            $table -> string('streetaddress'); 
            $table -> string('city'); 
            $table -> string('state'); 
            $table -> integer('pincode');
            $table -> string('accept');
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
        Schema::dropIfExists('site_information');
    }
}
