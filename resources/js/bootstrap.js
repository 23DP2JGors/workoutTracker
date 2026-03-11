import axios from 'axios';
window.axios = axios;

// Setup headers for Laravel Sanctum and AJAX requests
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.withCredentials = true; // Essential for authentication
