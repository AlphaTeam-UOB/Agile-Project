<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use App\Mail\AppointmentConfirmationMail;

class AppointmentControllerTest extends TestCase
{
    //all changes made to the database during the test will be rolled back automatically after each test, so the data won't persist after the tests run.
    use RefreshDatabase;

    /** @test */
    public function it_can_store_an_appointment_and_send_email()
    {
        // Fake the email sending for testing
        Mail::fake();

        // Create a test user (optional if you want to authenticate)
        $user = User::factory()->create();

        // Prepare the appointment data
        $appointmentData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'date' => '2025-03-20',
            'time' => '10:00 AM',
            'consultation_type' => 'General Consultation',
            'description' => 'Patient needs a check-up',
        ];

        // Send a POST request to the store route
        $response = $this->post(route('appointments.store'), $appointmentData);

        // Assert that the appointment was saved
        $this->assertDatabaseHas('appointments', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'date' => '2025-03-20',
            'time' => '10:00 AM',
            'consultation_type' => 'General Consultation',
            'description' => 'Patient needs a check-up',
        ]);

        // Assert that a confirmation email was sent
        Mail::assertSent(AppointmentConfirmationMail::class, function ($mail) use ($appointmentData) {
            return $mail->hasTo($appointmentData['email']);
        });

        // Assert the response is a redirect back with a success message
        $response->assertRedirect()->with('success', 'Appointment booked successfully! A confirmation email has been sent.');
    }

    /** @test */
    public function it_can_view_all_appointments()
    {
        // Create some appointments
        Appointment::factory()->count(5)->create();

        // Send a GET request to the index route
        $response = $this->get(route('appointments.index'));

        // Assert that the response returns the correct view
        $response->assertViewIs('CustomerSide.AppointmentsPage');

        // Assert that appointments data is passed to the view
        $response->assertViewHas('appointments', Appointment::all());
    }
}
