<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->boolean('status')->default(1);
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->integer('deleted_by')->default(0);
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->boolean('status')->default(1);
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->integer('deleted_by')->default(0);
        });

        Schema::table('admins', function (Blueprint $table) {
            $table->boolean('status')->default(1);
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->integer('deleted_by')->default(0);
        });

        Schema::table('content_pages', function (Blueprint $table) {
            $table->boolean('status')->default(1);
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->integer('deleted_by')->default(0);
        });

        Schema::table('social_media', function (Blueprint $table) {
            $table->boolean('status')->default(1);
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->integer('deleted_by')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn('status')->default(1);
            $table->dropColumn('created_by')->default(0);
            $table->dropColumn('updated_by')->default(0);
            $table->dropColumn('deleted_by')->default(0);
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('status')->default(1);
            $table->dropColumn('created_by')->default(0);
            $table->dropColumn('updated_by')->default(0);
            $table->dropColumn('deleted_by')->default(0);
        });

        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn('status')->default(1);
            $table->dropColumn('created_by')->default(0);
            $table->dropColumn('updated_by')->default(0);
            $table->dropColumn('deleted_by')->default(0);
        });

        Schema::table('content_pages', function (Blueprint $table) {
            $table->dropColumn('status')->default(1);
            $table->dropColumn('created_by')->default(0);
            $table->dropColumn('updated_by')->default(0);
            $table->dropColumn('deleted_by')->default(0);
        });

        Schema::table('social_media', function (Blueprint $table) {
            $table->dropColumn('status')->default(1);
            $table->dropColumn('created_by')->default(0);
            $table->dropColumn('updated_by')->default(0);
            $table->dropColumn('deleted_by')->default(0);
        });
    }
};
