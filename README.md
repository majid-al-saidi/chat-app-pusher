# Laravel Real-Time Chat (Pusher + Breeze)

This project implements a real-time private chat system between two authenticated users using:

- **Laravel 12**
- **Laravel Breeze** (no frontend framework)
- **Pusher** for WebSocket broadcasting
- **Laravel Echo** for frontend event listening

---

## Features

- Login-based user access
- Select a user to start a private chat
- Two-way real-time messaging with private channels
- Sender messages styled differently
- Live updates without page refresh

---

## Notes on Reverb Conflict

If laravel/reverb was previously installed, the following issue may occur:

```bash
WebSocket connection to 'ws://localhost:8080/app/...' failed
Uncaught You must pass your app key when you instantiate Pusher.
```

### Fix:
1- Ensure .env contains:
```bash
BROADCAST_DRIVER=pusher
```

2- Remove or comment out any of the following if present:
```bash
BROADCAST_CONNECTION=reverb
REVERB_APP_ID=
REVERB_PUBLIC_KEY=
```

3- Confirm config/broadcasting.php has
```js
'default' => env('BROADCAST_DRIVER', 'null')
```

4- In resources/js/bootstrap.js, configure Echo with Pusher:
```js
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: false,
});

```

5- Keep an eye on the `echo.js` or `bootstrap.js` configuration. If Laravel Echo is still using `reverb` instead of `pusher`, it can silently override your `.env` settings. Always verify the `broadcaster` value is correctly set to `pusher`:
```js
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: false,
});
```