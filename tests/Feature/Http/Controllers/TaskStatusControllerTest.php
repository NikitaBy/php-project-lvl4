<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\TaskStatus;
use App\Models\User;
use Database\Seeders\TaskStatusSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskStatusControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $seeder = TaskStatusSeeder::class;

    public function testCreate()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('taskStatus.create'));

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get(route('taskStatus.index'));

        $response->assertStatus(200);
        $this->assertDatabaseCount('task_statuses', 4);
    }

    public function testStore()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('taskStatus.store', ['name' => 'created']));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseCount('task_statuses', 5);
        $this->assertDatabaseHas('task_statuses', ['name' => 'created']);
    }

    public function testShow()
    {
        $response = $this->get(route('taskStatus.show'));

        $response->assertRedirect();
    }

    public function testUpdate()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $status = TaskStatus::first();

        $response = $this->patch(route('taskStatus.update', $status), ['name'=>'updated']);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseCount('task_statuses', 4);
        $this->assertDatabaseHas('task_statuses', ['id' => $status->id, 'name' => 'updated']);
    }
}
