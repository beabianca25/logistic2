import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.a6578a22d6b06e92beab,
    cluster: process.env.ap1,
    forceTLS: true
});

window.Echo.channel('vendor-channel')
    .listen('.vendor.application.submitted', (data) => {
        document.getElementById('vendorCount').innerText = data.pendingVendorCount;
    });
