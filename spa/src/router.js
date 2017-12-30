// Layouts goes here
import AuthLayout from './layouts/AuthLayout'

// Views goes here
import About from './views/About.vue'
import Account from './views/Account.vue'
import Contact from './views/Contact.vue'
import Forgot from './views/Forgot.vue'
import Home from './views/Home.vue'
import Login from './views/Login.vue'
import Messages from './views/Messages.vue'
import Notifications from './views/Notifications.vue'
import NotFound from './views/NotFound.vue'
import Posts from './views/Posts.vue'
import PostsSubmit from './views/PostsSubmit.vue'
import PostsUserManager from './views/PostsUserManager.vue'
import Profile from './views/Profile.vue'
import Register from './views/Register.vue'
// Todo use code splitting later.

export default {
  mode: 'history',
  base: '/',
  linkActiveClass: 'active',
  routes: [
    { path: '/', component: Home },
    { path: '/posts', component: Posts },
    { path: '/about', component: About },
    { path: '/contact', component: Contact },
    { path: '/account', component: Account, meta: { requireAuth: true } },
    {
      path: '/account/posts',
      component: PostsUserManager,
      meta: { requireAuth: true }
    },
    {
      path: '/account/posts/submit',
      component: PostsSubmit,
      meta: { requireAuth: true }
    },
    {
      path: '/account/profile',
      component: Profile,
      meta: { requireAuth: true }
    },
    {
      path: '/account/messages',
      component: Messages,
      meta: { requireAuth: true }
    },
    {
      path: '/account/notifications',
      component: Notifications,
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
