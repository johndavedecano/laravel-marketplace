import Vue from 'vue'
import VueRouter from 'vue-router'
import VueAxios from 'vue-axios'
import BootstrapVue from 'bootstrap-vue'
import { sync } from 'vuex-router-sync'
import axios from 'axios'

import App from 'src/App.vue'
import routerList from './router'
import store from './store'

import 'scss/style.scss'

// Registry
Vue.use(BootstrapVue)
Vue.use(VueRouter)
Vue.use(VueAxios, axios)

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
