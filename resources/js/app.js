/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Form = Form;
import $ from 'jquery';
window.$ = window.jquery = $;

// window.axios = require('axios');
// axios.defaults.headers.common["Authorization"] = "Bearer" + localStorage.getItem('authToken');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('searchbar-component', require('./components/Admin/formUserSearchBar').default);
Vue.component('pagination-component', require('./components/Admin/Helper/Pagination/PaginationComponent').default);
Vue.component('task-component', require('./components/Admin/Task/TaskComponent').default);
Vue.component('createtask-component', require('./components/Admin/Task/CreateTaskComponent').default);
Vue.component('comments-component', require('./components/Admin/Home/CommentComponent').default);

import Router from './router.js';
import store from './store/index';
import Form from './form';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: '#app',
    router: Router,
    store
});

$(document).ready(function() {
// AUTH FORM --- START ---
    $('.form').find('input, textarea').on('keyup blur focus', function (e) {

        var $this = $(this),
            label = $this.prev('label');

        if (e.type === 'keyup') {
            if ($this.val() === '') {
                label.removeClass('active highlight');
            } else {
                label.addClass('active highlight');
            }
        } else if (e.type === 'blur') {
            if ($this.val() === '') {
                label.removeClass('active highlight');
            } else {
                label.removeClass('highlight');
            }
        } else if (e.type === 'focus') {

            if ($this.val() === '') {
                label.removeClass('highlight');
            } else if ($this.val() !== '') {
                label.addClass('highlight');
            }
        }

    });

    $('.tab a').on('click', function (e) {
        console.log('form');
        e.preventDefault();
        $(this).parent().addClass('active');
        $(this).parent().siblings().removeClass('active');
        console.log($(this).attr('href'));
        var target = $(this).attr('href');
        $('.tab-content > div').not(target).hide();
        $(target).fadeIn(600);
    });
// AUTH FORM --- END ---

});
