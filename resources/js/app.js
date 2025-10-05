import './bootstrap';
import Pusher from 'pusher-js';
import Echo from 'laravel-echo';

// Make them global
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

// Listen for the post creation event
window.Echo.channel('posts')
    .listen('.PostCreated', (e) => {
        console.log('📢 New post broadcast received:', e);
        // Example: alert user
        alert(`New post: ${e.title} by ${e.created_by}`);
    });