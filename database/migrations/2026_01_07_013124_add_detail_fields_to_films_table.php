<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('films', function (Blueprint $table) {

            if (!Schema::hasColumn('films', 'rating')) {
                $table->decimal('rating', 2, 1)->nullable(); // contoh 8.5
            }

            if (!Schema::hasColumn('films', 'director')) {
                $table->string('director')->nullable();
            }

            if (!Schema::hasColumn('films', 'writer')) {
                $table->string('writer')->nullable();
            }

            if (!Schema::hasColumn('films', 'cast')) {
                $table->text('cast')->nullable(); // aktor (dipisah koma)
            }

        });
    }

    public function down()
    {
        Schema::table('films', function (Blueprint $table) {
            $table->dropColumn(['rating', 'director', 'writer', 'cast']);
        });
    }

};
