import Vue from 'vue'
import VueBootstrap from 'bootstrap-vue'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import VueMeta from 'vue-meta'

import axios from 'axios'
import { sync } from 'vuex-router-sync'
import env from './../env'

import App from 'src/App.vue'
import routerList from './router'
import store from './store'

import 'scss/style.scss'

// Configure Axios
axios.defaults.baseURL = env.API_HOST
axios.defaults.headers.put['Content-Type'] = 'application/x-www-form-urlencoded'
axios.defaults.headers.post['Content-Type'] = 'multipart/form-data'

if (localStorage.getItem('token')) {
  axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem(
    'token'
  )}`
}

// Registry
Vue.use(VueBootstrap)
Vue.use(VueRouter)
Vue.use(VueAxios, axios)
Vue.use(VueMeta)

/**
 * Create vue router intance
 */
const router = new VueRouter(routerList)

router.beforeEach((to, from, next) => {
  if (to.meta.requireAuth && !store.state.auth.isLoggedIn) {
    store.dispatch('showNotification', {
      type: 'error',
      message: 'You must be logged in to access this page.'
    })
    next({ path: '/auth/login' })
  } else {
    next()
  }
})

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
