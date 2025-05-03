// resources/js/chat/listener.js

export function listenForMessages(userId) {
    if (!userId) {
        console.warn('User ID is missing. Cannot listen for messages.');
        return;
    }

    window.Echo.private(`chat.${userId}`)
        .listen('MessageSent', (e) => {
            console.log('📩 New message received:', e.message, 'from:', e.from);

            // Optional: append to DOM
            const chatBox = document.getElementById('chat-messages');
            if (chatBox) {
                const div = document.createElement('div');
                div.textContent = `From ${e.from_name}: ${e.message}`;
                chatBox.appendChild(div);
            }
        });
}
