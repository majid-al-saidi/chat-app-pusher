export function listenForMessages(myId, theirId) {
    if (!myId || !theirId) {
        console.warn('User IDs missing. Cannot listen for messages.');
        return;
    }

    const [id1, id2] = [myId, theirId].sort(); // Sort so it matches event logic
    const channel = `chat.${id1}.${id2}`;

    console.log('🔌 Subscribing to:', channel);

    window.Echo.private(channel)
        .listen('MessageSent', (e) => {
            console.log('📩 New message received:', e.message, 'from:', e.from);

            const chatBox = document.getElementById('chat-messages');
            if (chatBox) {
                const div = document.createElement('div');
                div.textContent = `From ${e.from_name}: ${e.message}`;
                chatBox.appendChild(div);

                div.className = parseInt(e.from) === parseInt(myId) ? 'my-message' : 'their-message';
                div.style.textAlign = parseInt(e.from) === parseInt(myId) ? 'right' : 'left';
                div.style.backgroundColor = parseInt(e.from) === parseInt(myId) ? '#d1e7dd' : '#f8d7da';
                div.style.borderRadius = '5px';
            }
        });
}
