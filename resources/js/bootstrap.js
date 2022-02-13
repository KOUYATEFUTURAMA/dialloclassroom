window._ = require('lodash');

window.axios = require('axios');
window.moment = require('moment')

let token = window.$('meta[name="csrf-token"]').attr('content');

if (!token) {
    console.error('CSRF token not found');
}

window.axios.defaults.headers.common['X-Requested-With'] = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN' : token
};
axios.defaults.headers.common['Authorization'] = token;

window.axios.defaults.headers.post['Content-Type'] = 'application/json';
window.axios.defaults.headers.common.crossDomain = true;
window.axios.defaults.baseURL = '/api';

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

import Echo from "laravel-echo";
window.Pusher = require("pusher-js");

window.Echo = new Echo({
    broadcaster: "pusher",
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true
});
