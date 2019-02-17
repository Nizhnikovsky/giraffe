
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/menu-page.vue -> <example-component></example-component>
 */

import Vue from 'vue';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import Vuex from 'vuex';


Vue.use(ElementUI);

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import MenuPage from './components/menu-page.vue';
import AllAdverts from './components/all-adverts';
import FooterPage from './components/footer-page';
import CreateAdvert from './components/create-advert';
import LoginPage from './components/login-page';
import OneAdvert from './components/one-advert';
import EditAdvert from './components/edit-advert';
import store from './storage/store';
import getters from './storage/getters';


const advertsStore = new Vuex.Store({
    modules: {
        store
    },
    getters
});
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store: advertsStore,
    components: {
        MenuPage,
        AllAdverts,
        FooterPage,
        CreateAdvert,
        LoginPage,
        OneAdvert,
        EditAdvert
    },
});
