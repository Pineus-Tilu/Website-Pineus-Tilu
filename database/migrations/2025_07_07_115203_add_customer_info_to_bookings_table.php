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
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('customer_name')->nullable()->after('unit_id');
            $table->string('customer_email')->nullable()->after('customer_name');
            $table->string('customer_phone')->nullable()->after('customer_email');
            $table->integer('guest_count')->default(1)->after('customer_phone');
            $table->date('visit_date')->nullable()->after('guest_count');
            $table->decimal('total_amount', 10, 2)->nullable()->after('visit_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Check if columns exist before dropping them
            if (Schema::hasColumn('bookings', 'customer_name')) {
                $table->dropColumn('customer_name');
            }
            if (Schema::hasColumn('bookings', 'customer_email')) {
                $table->dropColumn('customer_email');
            }
            if (Schema::hasColumn('bookings', 'customer_phone')) {
                $table->dropColumn('customer_phone');
            }
            if (Schema::hasColumn('bookings', 'guest_count')) {
                $table->dropColumn('guest_count');
            }
            if (Schema::hasColumn('bookings', 'visit_date')) {
                $table->dropColumn('visit_date');
            }
            if (Schema::hasColumn('bookings', 'total_amount')) {
                $table->dropColumn('total_amount');
            }
        });
    }
};
