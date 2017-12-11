
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require('vue');
Vue.use(require('vue-moment'));
console.log(Vue.moment().locale());
import Datetime from 'vue-datetime';
Vue.use(Datetime);
import VueCookies from 'vue-cookies';
Vue.use(VueCookies);
import BootstrapVue from 'bootstrap-vue';
Vue.use(BootstrapVue);
require('jquery.easing');
var jQuery = require("jquery");

import VueRouter from 'vue-router';
Vue.use(VueRouter);
Vue.use(require('vue-resource'));

import $ from 'jquery';
window.$ = window.jQuery = $;

window.bus = new Vue();


import AddSightSeen from './components/AddSightSeen.vue';
import SightSeen from './components/SightSeen.vue';
import EditSightSeen from './components/EditSightSeen.vue';
import SingleSight from './components/SingleSight.vue';
import App from './components/App.vue';
import FrontApp from './components/Front-App.vue';
import FrontView from './components/Front-View.vue';
import FrontSightSeenList from './components/Front-SightSeenList.vue';
import UserProfilePage from './components/UserProfilePage.vue';
import AboutUs from './components/AboutUs.vue';
import ContactUs from './components/ContactUs.vue';
import Bookings from './components/Bookings.vue';



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('vue-pagination', require('./components/Pagination.vue'));
Vue.component('navigation', require('./components/Navigation.vue'));
Vue.component('frontnav', require('./components/Front-Nav.vue'));
Vue.component('frontfooter', require('./components/Front-Footer.vue'));
//
// const app = new Vue({
//     el: '#app'
// });
const router = new VueRouter({
    routes:[
      { path: '/addsightseen', component: AddSightSeen, name: 'addsightseen' },
      { path: '/editsightseen', component: EditSightSeen, name: 'editsightseen' },
      { path: '/sightseen', component: SightSeen, name: 'sightseen' },
      { path: '/singlesight', component: SingleSight, name: 'singlesight' },
      { path: '/', component: FrontView, name: 'frontview' },
      { path: '/userprofilepage', component: UserProfilePage, name: 'userprofilepage' },
      { path: '/frontsightseenlist/:country', component: FrontSightSeenList, name: 'frontsightseenlist' },
      { path: '/aboutus', component: AboutUs, name: 'aboutus' },
      { path: '/contactus', component: ContactUs, name: 'contactus' },
      { path: '/bookings', component: Bookings, name: 'bookings' },
    ],
    history: true,
    saveScrollPosition: false,
    root: '/'
 });

 var bus = new Vue({});

 if($("#app").length){
   const app = new Vue({
       el: '#app',
   	template: '<App/>',
   	components: { App },
       router
   });
}

if($("#frontapp").length){
  const app = new Vue({
      el: '#frontapp',
   template: '<FrontApp/>',
   components: { FrontApp },
      router
  });
}

let token = document.head.querySelector('meta[name="csrf-token"]');

Vue.http.interceptors.push((request, next) => {
    request.headers.set('X-CSRF-TOKEN', token.content);

    next();
});
