import Vue from 'vue'
import VueRouter from 'vue-router'
import BootstrapVue from 'bootstrap-vue'

import app from 'src/app.vue'
import routerList from './router'

import 'scss/style.scss'

// Registry
Vue.use(BootstrapVue)
Vue.use(VueRouter)

/**
 * Instantiate vue router
 */
const router = new VueRouter(routerList)

/* eslint-disable no-new */
new Vue({
  router,
  render: h => h(app)
}).$mount('#app')
