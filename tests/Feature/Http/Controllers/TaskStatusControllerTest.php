<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskStatusControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $seeder = DatabaseSeeder::class;

    public function testCreate(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('taskStatus.create'));

        $response->assertStatus(200);
    }

    public function testDeleteSuccess(): void
    {
        $this->actingAs(User::first());

        $task = Task::first();
        $status = TaskStatus::where('id', '!=', $task->status->id)->first();

        $response = $this->delete(route('taskStatus.destroy', ['taskStatus' => $status]));

        $this->assertDatabaseCount('task_statuses', 1);
        $response->assertRedirect();
    }

    public function testDeleteFailed(): void
    {
        $this->actingAs(User::first());

        $task = Task::first();
        $status = TaskStatus::where('id', $task->status->id)->first();

        $response = $this->delete(route('taskStatus.destroy', ['taskStatus' => $status]));

        $this->assertDatabaseCount('task_statuses', 2);
        $response->assertRedirect();
    }

    public function testIndex(): void
    {
        $response = $this->get(route('taskStatus.index'));

        $response->assertStatus(200);
        $this->assertDatabaseCount('task_statuses', 2);
    }

    public function testShow(): void
    {
        $response = $this->get(route('taskStatus.show', ['taskStatus' => TaskStatus::first()]));

        $response->assertRedirect();
    }

    public function testStore(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('taskStatus.store', ['name' => 'created']));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseCount('task_statuses', 3);
        $this->assertDatabaseHas('task_statuses', ['name' => 'created']);
    }

    public function testUpdate(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $status = TaskStatus::first();

        $response = $this->patch(route('taskStatus.update', $status), ['name' => 'updated']);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseCount('task_statuses', 2);
        $this->assertDatabaseHas('task_statuses', ['id' => $status->id, 'name' => 'updated']);
    }
}
