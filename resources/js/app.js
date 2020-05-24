import Vue from 'vue';
import VueRouter from 'vue-router';
import VModal from 'vue-js-modal';

import Routes from './routes';
import './test.scss'
require('./bootstrap');

Vue.use(VModal);
Vue.use(VueRouter);
window.collect = require('collect.js').default;
const router = new VueRouter({
    routes: Routes,
    mode: 'history',
});

new Vue({
    el: '#app',
    router
});
