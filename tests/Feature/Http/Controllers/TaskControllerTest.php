<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\task;
use App\Models\TaskStatus;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    protected $seed = true;

    protected $seeder = DatabaseSeeder::class;

    public function testCreate(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('task.create'));

        $response->assertStatus(200);
    }

    public function testDeleteFailed(): void
    {
        $task = Task::first();
        $this->actingAs(User::factory()->create());

        $this->delete(route('task.destroy', ['task' => $task]));

        $this->assertDatabaseCount('tasks', 1);
    }

    public function testDeleteSuccess(): void
    {
        $task = Task::first();
        $this->actingAs($task->author);

        $response = $this->delete(route('task.destroy', ['task' => $task]));

        $this->assertDatabaseCount('tasks', 0);
        $response->assertRedirect();
    }

    public function testIndex(): void
    {
        $response = $this->get(route('task.index'));

        $response->assertStatus(200);
        $this->assertDatabaseCount('tasks', 1);
    }

    public function testShow(): void
    {
        $response = $this->get(route('task.show', ['task' => Task::first()]));

        $response->assertStatus(200);
    }

    public function testStore(): void
    {
        $this->actingAs(User::first());

        $response = $this->post(route('task.store', ['name' => 'created', 'status_id' => TaskStatus::first()->id]));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseCount('tasks', 2);
        $this->assertDatabaseHas('tasks', ['name' => 'created']);
    }

    public function testStoreUnauthorized(): void
    {
        $this->post(route('task.store', ['name' => 'created', 'status_id' => TaskStatus::first()->id]));

        $this->assertDatabaseCount('tasks', 1);
    }

    public function testUpdate(): void
    {
        $this->actingAs(User::first());

        $task = Task::first();

        $response = $this->patch(route('task.update', $task), ['name' => 'updated']);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseCount('tasks', 1);
        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'name' => 'updated']);
    }
    //
    //    protected function setUp(): void
    //    {
    //        $this->seed();
    //    }
}
