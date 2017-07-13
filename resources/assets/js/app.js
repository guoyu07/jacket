
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


import VueRouter from 'vue-router'
import App from './App.vue'

Vue.use(VueRouter)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const router = new VueRouter({
    saveScrollPosition: true,
    routes:[
        {
            path:'/',
            name:'index',
            component:require('./components/pager/index')
        },
        {
            path:'/category/:id',
            name:'category',
            component:require('./components/pager/category')
        }
    ]
})


const app = new Vue({
    el: '#app',
    router,
    render: (h) => h(App)
});
