// Layouts goes here
import AuthLayout from './layouts/AuthLayout'

// Views goes here
import About from './views/About.vue'
import Account from './views/Account.vue'
import Forgot from './views/Forgot.vue'
import Home from './views/Home.vue'
import Login from './views/Login.vue'
import NotFound from './views/NotFound.vue'
import Posts from './views/Posts.vue'
import Profile from './views/Profile.vue'
import Register from './views/Register.vue'
import UserPosts from './views/UserPosts.vue'
// Todo use code splitting later.

export default {
  mode: 'history',
  base: '/',
  linkActiveClass: 'active',
  routes: [
    { path: '/', component: Home },
    { path: '/posts', component: Posts },
    { path: '/about', component: About },
    { path: '/account', component: Account, meta: { requireAuth: true } },
    {
      path: '/account/posts',
      component: UserPosts,
      meta: { requireAuth: true }
    },
    {
      path: '/account/profile',
      component: Profile,
      meta: { requireAuth: true }
    },
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
