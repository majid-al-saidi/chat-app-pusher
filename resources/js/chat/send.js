// resources/js/chat/send.js

export function setupSendMessage() {
    const form = document.getElementById('chat-form');
    const messageInput = document.getElementById('message');
    const toUserIdInput = document.getElementById('to-user-id');

    if (!form || !messageInput || !toUserIdInput) {
        console.warn('Chat form elements missing!');
        return;
    }

    form.addEventListener('submit', async (e) => {
        e.preventDefault(); // 🔥 prevents page refresh

        const message = messageInput.value.trim();
        const toUserId = toUserIdInput.value;

        if (!message || !toUserId) return;

        try {
            await axios.post('/chat/send', {
                message,
                to_user_id: toUserId,
            });

            console.log('✅ Message sent!');
            messageInput.value = '';
        } catch (err) {
            console.error('❌ Error sending message:', err);
        }
    });
}
