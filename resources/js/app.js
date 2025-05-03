import './bootstrap'; // Sets up Echo and axios

import { listenForMessages } from './chat/listener';
import { setupSendMessage } from './chat/send';

console.log('Echo config test:', import.meta.env.VITE_PUSHER_APP_KEY);

// Get current user ID
const userIdMeta = document.head.querySelector('meta[name="user-id"]');
const myId = userIdMeta ? userIdMeta.content : null;

// Get the other user's ID from the hidden input field
const toUserIdInput = document.getElementById('to-user-id');
const theirId = toUserIdInput ? toUserIdInput.value : null;

if (myId && theirId) {
    listenForMessages(myId, theirId);
    setupSendMessage();
} else {
    console.warn('Missing user IDs — cannot initialize chat.');
}
