<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('films', function (Blueprint $table) {
            $table->decimal('rating', 2, 1)->nullable(); // contoh 8.5
            $table->string('director')->nullable();
            $table->string('writer')->nullable();
            $table->text('cast')->nullable(); // aktor (dipisah koma)
        });
    }

    public function down()
    {
        Schema::table('films', function (Blueprint $table) {
            $table->dropColumn(['rating', 'director', 'writer', 'cast']);
        });
    }

};
