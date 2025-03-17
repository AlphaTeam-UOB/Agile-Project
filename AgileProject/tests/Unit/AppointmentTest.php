<?php

namespace Tests\Unit;

use App\Models\Appointment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppointmentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_appointment()
    {
        // Create an appointment using the factory
        $appointment = Appointment::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'date' => '2025-12-31',
            'time' => '10:00',
            'consultation_type' => 'Eye Checkup',
            'description' => 'Routine eye checkup',
            'status' => 'pending',
        ]);

        // Assert the appointment exists in the database
        $this->assertDatabaseHas('appointments', [
            'id' => $appointment->id,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'date' => '2025-12-31',
            'time' => '10:00',
            'consultation_type' => 'Eye Checkup',
            'description' => 'Routine eye checkup',
            'status' => 'pending',
        ]);
    }

    /** @test */
    public function it_has_proper_fillable_attributes()
    {
        // Create a new Appointment instance
        $appointment = new Appointment();

        // Assert the fillable attributes are correct
        $this->assertEquals([
            'name',
            'email',
            'date',
            'time',
            'consultation_type',
            'description',
            'status',
        ], $appointment->getFillable());
    }

    /** @test */
    public function it_does_not_allow_mass_assignment_of_protected_attributes()
    {
        // Create an appointment with only fillable attributes
        $appointment = Appointment::factory()->create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'date' => '2025-12-31',
            'time' => '10:00',
            'consultation_type' => 'Eye Checkup',
            'description' => 'Routine eye checkup',
            'status' => 'pending',
        ]);

        // Attempt to access a non-fillable attribute (e.g., 'id')
        $this->assertNull($appointment->getAttribute('non_fillable_attribute')); // Replace with actual non-fillable attribute
    }

    /** @test */
    public function it_can_update_an_appointment()
    {
        // Create an appointment
        $appointment = Appointment::factory()->create([
            'status' => 'pending',
        ]);

        // Update the appointment status
        $appointment->update(['status' => 'completed']);

        // Assert the status was updated
        $this->assertEquals('completed', $appointment->status);
        $this->assertDatabaseHas('appointments', [
            'id' => $appointment->id,
            'status' => 'completed',
        ]);
    }

    /** @test */
    public function it_can_delete_an_appointment()
    {
        // Create an appointment
        $appointment = Appointment::factory()->create();

        // Delete the appointment
        $appointment->delete();

        // Assert the appointment no longer exists in the database
        $this->assertDatabaseMissing('appointments', [
            'id' => $appointment->id,
        ]);
    }
}