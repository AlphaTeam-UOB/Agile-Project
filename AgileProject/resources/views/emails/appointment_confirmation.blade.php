<!DOCTYPE html>
<html>
<head>
    <title>Appointment Confirmation - A.A. Samarasinghe Optometrists</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 2px solid #e0e0e0;
        }
        .header img {
            max-width: 150px;
        }
        .content {
            padding: 20px 0;
        }
        .appointment-details {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-top: 15px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
        .footer a {
            color: #d32f2f;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <img src="{{ asset('images/logo.png') }}" alt="A.A. Samarasinghe Optometrists">
        <h2 style="color: #d32f2f;">Appointment Confirmation</h2>
    </div>

    <div class="content">
        <p>Dear {{ $appointment->name }},</p>

        <p>Thank you for scheduling an appointment with <strong>A.A. Samarasinghe Optometrists</strong>. We are pleased to confirm your appointment with the following details:</p>

        <div class="appointment-details">
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->date)->format('l, F j, Y') }}</p>
            <p><strong>Time:</strong> {{ $appointment->time }}</p>
            <p><strong>Consultation Type:</strong> {{ $appointment->consultation_type }}</p>
            <p><strong>Description:</strong> {{ $appointment->description }}</p>
        </div>

        <p>Please arrive at least 10 minutes before your scheduled appointment. If you have any questions or need to reschedule, feel free to contact us.</p>

        <p>Looking forward to serving you.</p>

        <p>Best Regards,</p>
        <p><strong>A.A. Samarasinghe Optometrists</strong></p>
    </div>

    <div class="footer">
        <p>&copy; {{ date('Y') }} A.A. Samarasinghe Optometrists. All Rights Reserved.</p>
        <p><a href="#">Visit our website</a> | <a href="#">Contact Us</a></p>
    </div>
</div>

</body>
</html>
