<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Label;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LabelControllerTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    protected $seed = true;

    public function testCreate(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('label.create'));

        $response->assertStatus(200);
    }

    public function testDeleteFailed(): void
    {
        $this->actingAs(User::first());

        $task = Task::first();
        $label = Label::where('id', $task->labels()->first()->id)->first();

        $response = $this->delete(route('label.destroy', ['label' => $label]));

        $this->assertDatabaseCount('labels', 2);
        $response->assertRedirect();
    }

    public function testDeleteSuccess(): void
    {
        $this->actingAs(User::first());

        $task = Task::first();
        $label = Label::where('id', '!=', $task->labels()->first()->id)->first();

        $response = $this->delete(route('label.destroy', ['label' => $label]));

        $this->assertDatabaseCount('labels', 1);
        $response->assertRedirect();
    }

    public function testIndex(): void
    {
        $response = $this->get(route('label.index'));

        $response->assertStatus(200);
        $this->assertDatabaseCount('labels', 2);
    }

    public function testShow(): void
    {
        $response = $this->get(route('label.show', ['label' => Label::first()]));

        $response->assertRedirect();
    }

    public function testStore(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('label.store', ['name' => 'created']));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseCount('labels', 3);
        $this->assertDatabaseHas('labels', ['name' => 'created']);
    }

    public function testUpdate(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $label = Label::first();

        $response = $this->patch(route('label.update', $label), ['name' => 'updated']);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseCount('labels', 2);
        $this->assertDatabaseHas('labels', ['id' => $label->id, 'name' => 'updated']);
    }
}
