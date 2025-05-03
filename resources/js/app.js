import './bootstrap'; // Sets up Echo and axios

import { listenForMessages } from './chat/listener';
import { setupSendMessage } from './chat/send';
console.log('Echo config test:', import.meta.env.VITE_PUSHER_APP_KEY);

// Get the current user's ID from the meta tag
const userIdMeta = document.head.querySelector('meta[name="user-id"]');
const userId = userIdMeta ? userIdMeta.content : null;

if (userId) {
    listenForMessages(userId);
    setupSendMessage();
} else {
    console.warn('User ID meta tag not found.');
}
