<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['student', 'content_manager', 'admin', 'super_admin'])
                ->default('student')->after('email');
            $table->foreignId('university_id')->nullable()->after('role')
                ->constrained()->nullOnDelete();
            $table->foreignId('department_id')->nullable()->after('university_id')
                ->constrained()->nullOnDelete();
            $table->foreignId('level_id')->nullable()->after('department_id')
                ->constrained()->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('university_id');
            $table->dropConstrainedForeignId('department_id');
            $table->dropConstrainedForeignId('level_id');
            $table->dropColumn('role');
        });
    }
};
