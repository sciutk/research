<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResearchJournalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_journal', function (Blueprint $table) {

            $table->increments('rj_id');
            $table->string('rj_article_name','400');
            $table->string('rj_name','250');
            $table->string('rj_standard','250')->nullable();
            $table->string('rj_owner','250');
            $table->string('rj_source_url','250');
            $table->date('rj_accept_date');
            $table->date('rj_publish_date');
            $table->integer('fund_id');
            $table->string('rj_isbn','250')->nullable();
            $table->integer('rj_volume');
            $table->integer('rj_no');
            $table->string('rj_page');
            $table->string('rj_abstract',1000);
            $table->string('rj_meta_tag');
            $table->string('rj_evaluate_article')->nullable();
            $table->integer('rj_publish_level');
            $table->string('rj_file');
            $table->softDeletes();
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
        Schema::dropIfExists('research_journal');
    }
}
