<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminAppointmentControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create admin user
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('123456789')
        ]);

        $this->actingAs($admin);
    }

    /** @test */
    public function it_can_display_all_appointments()
    {
        $appointments = Appointment::factory()->count(3)->create([
            'status' => 'Scheduled'
        ]);

        $response = $this->get(route('admin.appointments.index'));

        $response->assertStatus(200);
        $response->assertViewIs('AdminSide.Appointments.index');
        $response->assertViewHas('appointments');
    }

    /** @test */
    public function it_can_show_the_create_appointment_form()
    {
        $response = $this->get(route('admin.appointments.create'));
        $response->assertStatus(200);
        $response->assertViewIs('AdminSide.Appointments.create');
    }

    /** @test */
    public function it_can_store_a_new_appointment()
    {
        $appointmentData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'date' => '2025-12-31',
            'time' => '14:00',
            'status' => 'Scheduled',
            'consultation_type' => 'General Checkup',
            'description' => 'Routine checkup',
        ];

        $response = $this->post(route('admin.appointments.store'), $appointmentData);

        $response->assertRedirect(route('admin.appointments.index'));
        $this->assertDatabaseHas('appointments', $appointmentData);
    }

    /** @test */
    public function it_can_show_the_edit_appointment_form()
    {
        $appointment = Appointment::factory()->create([
            'status' => 'Scheduled'
        ]);

        $response = $this->get(route('admin.appointments.edit', $appointment));

        $response->assertStatus(200);
        $response->assertViewIs('AdminSide.Appointments.edit');
        $response->assertViewHas('appointment');
    }

    /** @test */
    public function it_can_update_an_existing_appointment()
    {
        $appointment = Appointment::factory()->create(['status' => 'Scheduled']);

        $updatedData = [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'date' => '2025-12-31',
            'time' => '15:00',
            'status' => 'Completed', // Match controller validation exactly
            'consultation_type' => 'Follow-up',
            'description' => 'Follow-up appointment',
        ];

        $response = $this->put(route('admin.appointments.update', $appointment), $updatedData);

        $response->assertRedirect(route('admin.appointments.index'));
        $this->assertDatabaseHas('appointments', $updatedData);
    }

    /** @test */
    public function it_can_delete_an_appointment()
    {
        $appointment = Appointment::factory()->create(['status' => 'Scheduled']);

        $response = $this->delete(route('admin.appointments.destroy', $appointment));

        $response->assertRedirect(route('admin.appointments.index'));
        $this->assertDatabaseMissing('appointments', ['id' => $appointment->id]);
    }

    /** @test */
    public function it_validates_required_fields()
    {
        $response = $this->post(route('admin.appointments.store'), []);

        $response->assertSessionHasErrors([
            'name',
            'email',
            'date',
            'time',
            'status',
            'consultation_type'
        ]);
    }

    /** @test */
    public function it_rejects_invalid_status_values()
    {
        $invalidData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'date' => '2025-01-01',
            'time' => '10:00',
            'status' => 'invalid-status',
            'consultation_type' => 'Test'
        ];

        $response = $this->post(route('admin.appointments.store'), $invalidData);

        $response->assertSessionHasErrors('status');
    }
}
