import welcome from './views/welcome.vue'
import about from './views/about.vue'
import NotFound from './views/NotFound.vue'

export default {
  mode: 'history',
  base: '/',
  linkActiveClass: 'active',
  routes: [
    { path: '/', component: welcome },
    { path: '/about', component: about },
    { path: '*', component: NotFound }
  ]
}
