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

    <div id="chatbot-container" class="hidden fixed bottom-16 right-5 bg-white shadow-lg rounded-lg w-80 p-4">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-800">Chatbot</h3>
            <button id="close-chatbot" class="text-gray-600">✖</button>
        </div>
        <div id="chatbot-messages" class="h-40 overflow-y-auto border p-2 mt-2 bg-gray-50"></div>
        <input type="text" id="chatbot-input" class="w-full p-2 border mt-2" placeholder="Ask about free slots...">
    </div>
</div>

<script>
document.getElementById('chatbot-btn').addEventListener('click', function() {
    document.getElementById('chatbot-container').classList.toggle('hidden');
});

document.getElementById('close-chatbot').addEventListener('click', function() {
    document.getElementById('chatbot-container').classList.add('hidden');
});

document.getElementById('chatbot-input').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        const message = e.target.value;
        e.target.value = '';

        // Display user message
        let chatbotMessages = document.getElementById('chatbot-messages');
        chatbotMessages.innerHTML += `<div class="text-right text-gray-900">${message}</div>`;

        // Simulate chatbot response
        setTimeout(() => {
            chatbotMessages.innerHTML += `<div class="text-left text-gray-700">Checking available slots...</div>`;
        }, 500);
    }
});
</script>
@endsection
