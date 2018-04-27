
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import $ from 'jquery';
window.$ = window.jQuery = $;

window.Vue = require('vue');

Vue.use(require('vue-moment'));
import Datetime from 'vue-datetime';
Vue.use(Datetime);

import VueCookies from 'vue-cookies';
Vue.use(VueCookies);

import BootstrapVue from 'bootstrap-vue';
Vue.use(BootstrapVue);

require('jquery.easing');

var jQuery = require("jquery");

import * as VueGoogleMaps from 'vue2-google-maps';
Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyCy8QYGViZHpTPprINX1ItmIapduifeXow',
    libraries: 'places', // This is required if you use the Autocomplete plugin
    // OR: libraries: 'places,drawing'
    // OR: libraries: 'places,drawing,visualization'
    // (as you require)
  }
});

import VueCarousel from 'vue-carousel';
Vue.use(VueCarousel);

import VueRouter from 'vue-router';
Vue.use(VueRouter);

Vue.use(require('vue-resource'));

window.bus = new Vue();


// front-end components
import FrontApp from './components/front-end/Front-App.vue';
import FrontView from './components/front-end/Front-View.vue';
import FrontSightSeenList from './components/front-end/Front-SightSeenList.vue';
import AboutUs from './components/front-end/AboutUs.vue';
import ContactUs from './components/front-end/ContactUs.vue';
import TermsConditions from './components/front-end/Terms&Conditions.vue';
import Support from './components/front-end/Support.vue';
import PrivacyPolicy from './components/front-end/PrivacyPolicy.vue';

// back-end coponents
import App from './components/App.vue';
import AddSightSeen from './components/AddSightSeen.vue';
import SightSeen from './components/SightSeen.vue';
import EditSightSeen from './components/EditSightSeen.vue';
import SingleSight from './components/SingleSight.vue';
import UserProfilePage from './components/UserProfilePage.vue';
Vue.component('VuePagination', require('./components/Pagination.vue'));

const routes = [
                  { path: '/', component: FrontView, name: 'frontview' },
                  { path: '/sight-seen-list/:country', component: FrontSightSeenList, name: 'frontsightseenlist' },
                  { path: '/about-us', component: AboutUs, name: 'aboutus' },
                  { path: '/contact-us', component: ContactUs, name: 'contactus' },
                  { path: '/terms-conditions', component: TermsConditions, name: 'termsconditions' },
                  { path: '/support', component: Support, name: 'support' },
                  { path: '/privacy-policy', component: PrivacyPolicy, name: 'privacypolicy' },
                  { path: '/addsightseen', component: AddSightSeen, name: 'addsightseen' },
                  { path: '/editsightseen', component: EditSightSeen, name: 'editsightseen' },
                  { path: '/sightseen', component: SightSeen, name: 'sightseen' },
                  { path: '/singlesight', component: SingleSight, name: 'singlesight' },
                  { path: '/userprofilepage', component: UserProfilePage, name: 'userprofilepage' },
                  { path: '*', redirect: '/' },
              ]

const router = new VueRouter({
    routes,
    mode: 'history',
    scrollBehavior (to, from, savedPosition) {
      if (savedPosition) {
        return savedPosition
      } else {
        return { x: 0, y: 0 }
      }
    }
 });

 var bus = new Vue({});

 if($("#app").length){
   const app = new Vue({
       el: '#app',
   	template: '<App/>',
   	components: { App },
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
