import axios from 'axios';
import _ from 'lodash';
import Vue from 'vue';
import jQuery from 'jquery';
import moment from 'moment';

window.$ = window.jQuery = jQuery;
window.Vue = Vue;
window._ = _;
window.axios = axios;
window.moment = moment;


window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
	window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': token.content}});
} else {
	console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
