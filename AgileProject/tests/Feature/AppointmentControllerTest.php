<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Appointment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppointmentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_appointment_can_be_created()
    {
        $response = $this->post('/appointments', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'date' => '2023-12-31',
            'time' => '10:00 AM',
            'consultation_type' => 'General',
            'description' => 'Test appointment',
            'status' => 'scheduled', // Add the status field
        ]);

        $response->assertRedirect()
                 ->assertSessionHas('success');

        $this->assertDatabaseHas('appointments', [
            'email' => 'john@example.com',
            'status' => 'scheduled', // Verify the status field
        ]);
    }

    public function test_appointments_page_loads()
    {
        $response = $this->get('/appointments');
        $response->assertStatus(200)
                 ->assertViewIs('CustomerSide.AppointmentsPage');
    }
}