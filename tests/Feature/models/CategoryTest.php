<?php

namespace Tests\Unit;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_category()
    {
        // Create a new category
        $category = Category::factory()->create([
            'category_name' => 'Test Category'
        ]);

        // Assert that the category was created successfully
        $this->assertDatabaseHas('categories', [
            'category_name' => 'Test Category'
        ]);
    }

    public function test_update_category()
    {
        // Create a new category
        $category = Category::factory()->create();

        // Update the category name
        $category->update([
            'category_name' => 'Updated Category Name'
        ]);

        // Assert that the category was updated successfully
        $this->assertEquals('Updated Category Name', $category->fresh()->category_name);
    }

    public function test_delete_category()
    {
        // Create a new category
        $category = Category::factory()->create();

        // Delete the category
        $category->delete();

        // Assert that the category was deleted successfully
        $this->assertSoftDeleted($category);
    }

}
