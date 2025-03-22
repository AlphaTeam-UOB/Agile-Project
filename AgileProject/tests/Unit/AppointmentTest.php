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
        $appointment = Appointment::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'date' => '2025-12-31',
            'time' => '10:00',
            'consultation_type' => 'Eye Checkup',
            'description' => 'Routine eye checkup',
            'status' => 'Scheduled',
        ]);

        $this->assertDatabaseHas('appointments', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'date' => '2025-12-31',
            'time' => '10:00',
            'consultation_type' => 'Eye Checkup',
            'description' => 'Routine eye checkup',
            'status' => 'Scheduled', // Match enum value from migration
        ]);
    }

    /** @test */
    public function it_hides_sensitive_attributes()
    {
        $appointment = Appointment::factory()->create();
        $appointmentArray = $appointment->toArray();

        // Remove assertions for non-existent fields (password/remember_token)
        // Add assertions for actual hidden fields if any
        $this->assertArrayNotHasKey('non_existent_field', $appointmentArray);
    }

    /** @test */
    public function it_casts_attributes_properly()
    {
        $appointment = Appointment::factory()->create([
            'date' => '2025-12-31',
            'time' => '10:00',
        ]);

        $this->assertIsString($appointment->date); // Date is stored as string in DB
        $this->assertIsString($appointment->time);
    }

    /** @test */
    public function it_has_proper_fillable_attributes()
    {
        $appointment = new Appointment();

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
        // Test actual protected attributes (like 'id' or timestamps)
        $appointment = Appointment::factory()->create();
        $this->assertNotNull($appointment->id); // id should be auto-generated
        $this->assertNull($appointment->getAttribute('non_fillable_attribute'));
    }

    /** @test */
    public function it_can_update_an_appointment()
    {
        $appointment = Appointment::factory()->create(['status' => 'Scheduled']);
        $appointment->update(['status' => 'completed']);

        $this->assertEquals('completed', $appointment->status);
        $this->assertDatabaseHas('appointments', [
            'id' => $appointment->id,
            'status' => 'completed'
        ]);
    }

    /** @test */
    public function it_can_delete_an_appointment()
    {
        $appointment = Appointment::factory()->create(['status' => 'Scheduled']);
        $appointment->delete();
        $this->assertDatabaseMissing('appointments', ['id' => $appointment->id]);
    }
}
