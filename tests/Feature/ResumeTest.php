<?php

namespace Tests\Feature;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResumeTest extends TestCase
{
    use RefreshDatabase;
    private $user;
    protected function setUp(): void {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
        //$this->withoutExceptionHandling();

    }
    private function resume()
    {
       return Resume::factory()->make()->toArray();

    }
    public function testCreateResumeView()
    {

        $response = $this->get(route('resumes.create'));
        $response->assertOk();//200
    }
    public function testStoreResume()
    {
        $resume = $this->resume();
        $response = $this->post(route('resumes.store'), $resume);
        $this->assertDatabaseCount('resumes', 1);
        $response->assertCreated();
    }
    public function testStoreResumeWithIncorrectFormat()
    {
        $resume = $this->resume();
        $resume['content']['basics']['email'] = 'invalidEmail';
        $response = $this->post(route('resumes.store'), $resume);
        $response->assertSessionHasErrors(['content.basics.email']);
        $this->assertDatabaseCount('resumes', 0);
    }
    public function testUpdateResume()
    {
        $resume = Resume::factory()->create(['user_id' => $this->user->id]);
        $data = $resume->toArray();
        $title = 'Test';
        $data['title'] = $title;
        $response = $this->put(route('resumes.update', $resume->id), $data);
        $response->assertOk();
        $this->assertDatabaseCount('resumes', 1);
        $this->assertEquals(Resume::find($resume->id)->title, $title);
    }

}
