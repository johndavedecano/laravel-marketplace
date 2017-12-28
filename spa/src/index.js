import Vue from 'vue'
import VueBootstrap from 'bootstrap-vue'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import VueMeta from 'vue-meta'

import axios from 'axios'
import { sync } from 'vuex-router-sync'

import App from 'src/App.vue'
import routerList from './router'
import store from './store'

import 'scss/style.scss'

// Registry
Vue.use(VueBootstrap)
Vue.use(VueRouter)
Vue.use(VueAxios, axios)
Vue.use(VueMeta)

/**
 * Create vue router intance
 */
const router = new VueRouter(routerList)

/**
 * Sync router to store
 */
sync(store, router)

/* eslint-disable no-new */
new Vue({
  store,
  router,
  render: h => h(App)
}).$mount('#app')
