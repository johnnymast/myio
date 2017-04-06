/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('jquery');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('notification', require('./components/Notification.vue'));

import admin_users_create from './mixins/admin/admin_users_create';
import admin_any_index from './mixins/admin/admin_any_index';

const app = new Vue({
    mixins: [admin_users_create, admin_any_index],
    el: '#app',
});