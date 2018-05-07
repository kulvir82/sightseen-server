
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
                  { path: '/',
                    component: FrontView,
                    name: 'frontview', 
                    meta:{
                      title: 'Go4SightSeeing - Book SightSeeing Tour & City Excursions Online',
                      metaTags: [
                        {
                          name: 'description',
                          content: 'Discover online sightseeing tours across various Asian cities with Go4SS. Enjoy the blend of local sightseeing excursions. Visit our website & Book now.'
                        }
                      ]
                    }
                  },
                  { path: '/sight-seen-list/:country', 
                    component: FrontSightSeenList, 
                    name: 'frontsightseenlist', 
                    meta:{
                      title: 'Go4SightSeeing - Book SightSeeing Tour & City Excursions Online',
                      metaTags: [
                        {
                          name: 'description',
                          content: 'Discover online sightseeing tours across various Asian cities with Go4SS. Enjoy the blend of local sightseeing excursions. Visit our website & Book now.'
                        }
                      ]
                    }
                  },
                  { 
                    path: '/about-us', 
                    component: AboutUs,
                    name: 'aboutus',
                    meta:{
                      title: 'About Us - Go4SightSeeing',
                      metaTags: [
                        {
                          name: 'description',
                          content: 'Welcome to Go4SS, gives an easy way to explore all your favourite sightseeings with just a click.'
                        }
                      ]
                    } 
                  },
                  { path: '/contact-us', 
                    component: ContactUs, 
                    name: 'contactus',
                    meta:{
                      title: 'Contact Us - Go4SightSeeing',
                      metaTags: [
                        {
                          name: 'description',
                          content: 'Contact us at support@go4sightseeing.com for any enquiry regarding booking. Experience Go4SS app on mobile.'
                        }
                      ]
                    }
                  },
                  { path: '/terms-conditions', 
                    component: TermsConditions, 
                    name: 'termsconditions', 
                    meta:{
                      title: 'Terms & Conditions - Go4SightSeeing',
                      metaTags: [
                        {
                          name: 'description',
                          content: 'Please read out the terms & conditions carefully regarding website and other third party services.'
                        }
                      ]
                    }
                  },
                  { path: '/support', 
                    component: Support, 
                    name: 'support', 
                    meta:{
                      title: 'Customer Support - Go4SightSeeing',
                      metaTags: [
                        {
                          name: 'description',
                          content: 'Use this webpage to contact Go4SS customer support. For any technical assistance , Call us at +919875950679.'
                        }
                      ]
                    }
                  },
                  { path: '/privacy-policy', 
                    component: PrivacyPolicy, 
                    name: 'privacypolicy',
                    meta:{
                      title: 'Privacy Policy - Go4SightSeeing',
                      metaTags: [
                        {
                          name: 'description',
                          content: 'We at Go4SS, respects & protects the private information or data for our customers privacy. For more Visit our link.'
                        }
                      ]
                    }
                  },
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


// to set title and meta tag dynamically
router.beforeEach((to, from, next) => {
  
  // cehck if title is set
  const nearestWithTitle = to.matched.slice().reverse().find(r => r.meta && r.meta.title);

  // check if metatag is set
  const nearestWithMeta = to.matched.slice().reverse().find(r => r.meta && r.meta.metaTags);
  
  if(nearestWithTitle) document.title = to.meta.title;
  
  if(nearestWithMeta) document.head.querySelector("[name='description']").content = to.meta.metaTags[0].content;

  next();
});
//  

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
