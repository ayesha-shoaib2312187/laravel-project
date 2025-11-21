// database/migrations/xxxx_xx_xx_create_products_table.php
<?php
public function up(): void
{
Schema::create('products', function (Blueprint $table) {
$table->id();
$table->string('name');
$table->decimal('price', 8, 2);
$table->timestamps();
});
}
