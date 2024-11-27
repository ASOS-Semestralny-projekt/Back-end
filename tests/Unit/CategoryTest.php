<?php

namespace Tests\Unit;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creating a category.
     */
    public function test_create_category(): void
    {
        $category = Category::factory()->create(['name' => 'Electronics']);

        $this->assertInstanceOf(Category::class, $category);
        $this->assertEquals('Electronics', $category->name);
    }

    /**
     * Test finding a category by ID.
     */
    public function test_find_category_by_id(): void
    {
        $createdCategory = Category::factory()->create(['name' => 'Books']);
        $foundCategory = Category::find($createdCategory->id);

        $this->assertInstanceOf(Category::class, $foundCategory);
        $this->assertEquals('Books', $foundCategory->name);
    }

    /**
     * Test truncating categories.
     */
    public function test_truncate_categories(): void
    {
        Category::factory()->count(5)->create();
        Category::truncate();

        $this->assertCount(0, Category::all());
    }
}
