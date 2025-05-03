<script>
    console.log('✅ Chat Blade script loaded');
</script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <h2>Chatting with: {{ $chatUser->name }}</h2>
        </h2>
    </x-slot>
    <input type="hidden" id="to-user-id" value="{{ $chatUser->id }}">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form id="chat-form">
                        <input type="text" id="message" placeholder="Type your message..." required style="width: 100%; margin-bottom: 10px;">
                        <input type="hidden" id="to-user-id" value="2"> {{-- Change this dynamically if needed --}}
                        <button type="submit">Send</button>
                    </form>
                
                    <div id="chat-messages" style="margin-top: 20px;">
                        <!-- Incoming messages will show here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>