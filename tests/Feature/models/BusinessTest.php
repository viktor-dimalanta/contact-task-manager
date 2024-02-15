<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Business;
use App\Models\Category;
use App\Models\Person;
use App\Models\Task;

class BusinessTest extends TestCase
{
    /**
     * Test the fillable attributes.
     *
     * @return void
     */
    public function test_fillable_attributes()
    {
        $business = new Business();
        
        $this->assertEquals(
            ['business_name', 'email', 'categories', 'tags'],
            $business->getFillable()
        );
    }

    /**
     * Test the categories relationship.
     *
     * @return void
     */
    // public function test_categories_relationship()
    // {
    //     $business = Business::factory()->create();
    //     $category = Category::factory()->create();
    //     $business->categories()->attach($category);

    //     $this->assertCount(1, $business->categories);
    //     $this->assertTrue($business->categories->contains($category));
    // }

    /**
     * Test the people relationship.
     *
     * @return void
     */
    public function test_people_relationship()
    {
        $business = Business::factory()->create();
        $person = Person::factory()->create(['business_id' => $business->id]);

        $this->assertInstanceOf(Person::class, $business->people->first());
    }

    /**
     * Test the tasks relationship.
     *
     * @return void
     */
    public function test_tasks_relationship()
    {
        $business = Business::factory()->create();
        $task = Task::factory()->create(['taskable_id' => $business->id, 'taskable_type' => Business::class]);

        $this->assertInstanceOf(Task::class, $business->tasks->first());
    }
}
