import './bootstrap';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

// Listen for the PostCreated event
window.Echo.channel('posts')
    .listen('.PostCreated', (data) => {
        console.log('📢 New post received:', data);
        const container = document.getElementById('notification');
        container.insertAdjacentHTML(
            'beforeend',
            `<div class="alert alert-success alert-dismissible fade show">
                <strong>${data.title}</strong> by ${data.created_by}
            </div>`
        );
    });