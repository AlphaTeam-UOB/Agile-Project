@extends('layouts.admin')

@section('content')

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Select all delete buttons
    document.querySelectorAll(".delete-button").forEach(button => {
        button.addEventListener("click", function() {
            let form = this.closest(".delete-form");
            let appointmentId = form.getAttribute("data-id");

            // Confirm before deleting
            if (confirm("Are you sure you want to delete this appointment?")) {
                fetch(form.action, {
                    method: "POST",
                    body: new FormData(form),
                })
                .then(response => {
                    if (response.ok) {
                        // Remove the deleted row
                        form.closest("tr").remove();
                        
                        // Show Toastify success message
                        Toastify({
                            text: "Appointment deleted successfully!",
                            duration: 3000,
                            close: true,
                            gravity:"top",
                            position: "center",
                            backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)"
                        }).showToast();
                    } else {
                        throw new Error("Delete failed");
                    }
                })
                .catch(error => {
                    console.error(error);
                    Toastify({
                        text: "Error deleting appointment!",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "linear-gradient(to right, #ff5f6d, #d62929)"
                    }).showToast();
                });
            }
        });
    });
});
</script>


<div class="container mx-auto px-6 py-12">
    <h1 class="text-4xl font-bold text-gray-900 text-center">Appointments</h1>
    <p class="mt-4 text-lg text-gray-700 text-center">
        Here are the upcoming appointments.
    </p>

    <!-- Display appointments -->
    <div class="mt-8">
        @if($appointments->count() > 0)
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                <thead>
                    <tr>
                        <th class="py-3 px-4 text-left bg-gray-100">Name</th>
                        <th class="py-3 px-4 text-left bg-gray-100">Email</th>
                        <th class="py-3 px-4 text-left bg-gray-100">Date</th>
                        <th class="py-3 px-4 text-left bg-gray-100">Time</th>
                        <th class="py-3 px-4 text-left bg-gray-100">Consultation Type</th> <!-- Added column -->
                        <th class="py-3 px-4 text-left bg-gray-100">Description</th> <!-- Added column -->
                        <th class="py-3 px-4 text-left bg-gray-100">Status</th>
                        <th class="py-3 px-4 text-left bg-gray-100">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                        <tr class="border-t border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $appointment->name }}</td>
                            <td class="py-3 px-4">{{ $appointment->email }}</td>
                            <td class="py-3 px-4">{{ $appointment->date }}</td>
                            <td class="py-3 px-4">{{ $appointment->time }}</td>
                            <td class="py-3 px-4">{{ $appointment->consultation_type }}</td> <!-- Display consultation_type -->
                            <td class="py-3 px-4">{{ $appointment->description }}</td> <!-- Display description -->
                            <td class="py-3 px-4">
                                <span class="px-2 py-1 text-sm rounded-full 
                                    {{ $appointment->status === 'Scheduled' ? 'bg-blue-100 text-blue-800' : 
                                       ($appointment->status === 'Completed' ? 'bg-green-100 text-green-800' : 
                                       'bg-red-100 text-red-800') }}">
                                    {{ $appointment->status }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <a href="{{ route('admin.appointments.edit', $appointment->id) }}" class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form class="delete-form" data-id="{{ $appointment->id }}" action="{{ route('admin.appointments.destroy', $appointment->id) }}" method="POST" style="display: inline-block;">
    @csrf
    @method('DELETE')
    <button type="button" class="delete-button text-red-500 hover:text-red-700 ml-2">
        <i class="fas fa-trash"></i> Delete
    </button>
</form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center text-gray-500">No appointments available at the moment.</p>
        @endif
    </div>

    <!-- Create Appointment Button -->
    <div class="mt-8 text-center">
        <a href="{{ route('admin.appointments.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
            <i class="fas fa-plus"></i> Create New Appointment
        </a>
    </div>
</div>
@endsection
