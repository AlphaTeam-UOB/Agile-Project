@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <h1 class="text-4xl font-bold text-gray-900 text-center">Book an Appointment</h1>
    <p class="mt-4 text-lg text-gray-700 text-center">
        Schedule an appointment with our optometrists today.
    </p>

    <!-- Appointment Booking Form -->
    <div class="max-w-lg mx-auto mt-8 bg-white p-6 rounded-lg shadow-md">
        <form action="#" method="POST">
            @csrf
            
            <label class="block text-lg font-semibold text-gray-700">Full Name</label>
            <input type="text" name="name" required class="w-full p-2 border border-gray-300 rounded-lg mt-2">

            <label class="block text-lg font-semibold text-gray-700 mt-4">Email</label>
            <input type="email" name="email" required class="w-full p-2 border border-gray-300 rounded-lg mt-2">

            <label class="block text-lg font-semibold text-gray-700 mt-4">Date</label>
            <input type="date" name="date" required class="w-full p-2 border border-gray-300 rounded-lg mt-2">

            <label class="block text-lg font-semibold text-gray-700 mt-4">Time</label>
            <select name="time" required class="w-full p-2 border border-gray-300 rounded-lg mt-2">
                <option value="">Select a time slot</option>
                <option value="10:00 AM">10:00 AM</option>
                <option value="11:00 AM">11:00 AM</option>
                <option value="2:00 PM">2:00 PM</option>
                <option value="3:00 PM">3:00 PM</option>
            </select>

            <label class="block text-lg font-semibold text-gray-700 mt-4">Type of Consultation</label>
            <select name="consultation_type" required class="w-full p-2 border border-gray-300 rounded-lg mt-2">
                <option value="">Select Consultation Type</option>
                <option value="General Checkup">General Checkup</option>
                <option value="Eye Examination">Eye Examination</option>
                <option value="Contact Lens Fitting">Contact Lens Fitting</option>
                <option value="Other">Other</option>
            </select>

            <label class="block text-lg font-semibold text-gray-700 mt-4">Description</label>
            <textarea name="description" rows="4"  class="w-full p-2 border border-gray-300 rounded-lg mt-2" placeholder="Describe your concerns..."></textarea>

            <button type="submit" class="mt-6 w-full bg-red-700 text-white py-2 rounded-lg hover:bg-red-800 transition duration-300">
                Book Appointment
            </button>
        </form>
    </div>

    <!-- Chatbot Section -->
    <div class="fixed bottom-5 right-5">
        <button id="chatbot-btn" class="bg-red-700 text-white p-4 rounded-full shadow-lg hover:bg-red-800">
            💬 Chat
        </button>
    </div>

    <div id="chatbot-container" class="hidden fixed bottom-16 right-5 bg-white shadow-lg rounded-lg w-96 p-4">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-800">Chatbot</h3>
            <button id="close-chatbot" class="text-gray-600 hover:text-gray-800">✖</button>
        </div>

        <!-- Recommended Commands Section -->
        <div class="mt-4">
            <p class="text-sm text-gray-600">Try these commands:</p>
            <div class="flex flex-wrap gap-2 mt-2">
                <button class="command-btn bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm hover:bg-gray-200">Check availability</button>
                <button class="command-btn bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm hover:bg-gray-200">Book an appointment</button>
                <button class="command-btn bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm hover:bg-gray-200">Show free slots</button>
            </div>
        </div>

        <!-- Chatbot Messages -->
        <div id="chatbot-messages" class="h-64 overflow-y-auto border p-2 mt-4 bg-gray-50 rounded-lg">
            <!-- Messages will appear here -->
        </div>

        <!-- Chatbot Input and Spinner -->
        <div class="mt-4 relative">
            <input type="text" id="chatbot-input" class="w-full p-2 border rounded-lg pr-10" placeholder="Type your message...">
            <div id="chatbot-spinner" class="hidden absolute right-2 top-2">
                <svg class="animate-spin h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<script>
    // Toggle chatbot container visibility
    document.getElementById('chatbot-btn').addEventListener('click', function() {
        document.getElementById('chatbot-container').classList.toggle('hidden');
    });

    // Close chatbot container
    document.getElementById('close-chatbot').addEventListener('click', function() {
        document.getElementById('chatbot-container').classList.add('hidden');
    });

    // Handle recommended command clicks
    document.querySelectorAll('.command-btn').forEach(button => {
        button.addEventListener('click', function() {
            const command = this.innerText;
            document.getElementById('chatbot-input').value = command;
            document.getElementById('chatbot-input').dispatchEvent(new KeyboardEvent('keypress', { key: 'Enter' }));
        });
    });

    // Handle chat input
    document.getElementById('chatbot-input').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            const message = e.target.value;
            e.target.value = '';

            // Display user message
            let chatbotMessages = document.getElementById('chatbot-messages');
            chatbotMessages.innerHTML += `<div class="text-right text-gray-900 mb-2">You: ${message}</div>`;

            // Show spinner
            document.getElementById('chatbot-spinner').classList.remove('hidden');

            // Send message to backend
            fetch('/chatbot', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ message: message })
            })
            .then(response => response.json())
            .then(data => {
                // Hide spinner
                document.getElementById('chatbot-spinner').classList.add('hidden');

                // Display bot response
                chatbotMessages.innerHTML += `<div class="text-left text-gray-700 mb-2">Bot: ${data.fulfillmentText}</div>`;
                chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
            })
            .catch(error => {
                // Hide spinner
                document.getElementById('chatbot-spinner').classList.add('hidden');

                // Display error message
                console.error('Error:', error);
                chatbotMessages.innerHTML += `<div class="text-left text-gray-700 mb-2">Bot: Sorry, something went wrong.</div>`;
            });
        }
    });
</script>
@endsection