<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisbursementTb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disbursement_tb', function (Blueprint $table) {
            $tabl->bigInteger('dsID');
            $table->bigInteger('uID');
            $table->foreign('uID')->references('uID')->on('users_tb')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->string('disbursement_purpose', 255);
            $table->float('disbursement_amount', 8, 2);
            $table->text('disbursement_description');
            $table->string('disbursement_type_status', 255);
            $table->char('disbursement_delete_status', 1);
            $table->date('disbursement_date');
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
        Schema::dropIfExists('disbursement_tb');
    }
}
