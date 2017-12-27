// Layouts goes here
import AuthLayout from './layouts/AuthLayout'

// Views goes here
import About from './views/About.vue'
import Forgot from './views/Forgot.vue'
import Home from './views/Home.vue'
import Login from './views/Login.vue'
import NotFound from './views/NotFound.vue'
import Register from './views/Register.vue'

// Todo use code splitting later.

export default {
  mode: 'history',
  base: '/',
  linkActiveClass: 'active',
  routes: [
    { path: '/', component: Home },
    { path: '/about', component: About },
    {
      path: '/auth',
      component: AuthLayout,
      children: [
        {
          path: 'login',
          component: Login
        },
        {
          path: 'forgot',
          component: Forgot
        },
        {
          path: 'register',
          component: Register
        }
      ]
    },
    { path: '*', component: NotFound }
  ]
}
