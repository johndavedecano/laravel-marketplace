<template>
  <b-navbar-nav class="ml-auto">
    <b-nav-item-dropdown right v-if="!isLoggedIn">
      <template slot="button-content">
        <span>Access Account</span>
      </template>
      <router-link role="menuitem" class="dropdown-item" to="/auth/login" exact>Login</router-link>
      <router-link role="menuitem" class="dropdown-item" to="/auth/register" exact>Register</router-link>
    </b-nav-item-dropdown>

    <b-nav-item-dropdown right v-if="isLoggedIn">
      <template slot="button-content">
        <span>Welcome, {{ user ? user.name : 'User' }}</span>
      </template>
      <router-link role="menuitem" class="dropdown-item" to="/account" exact>Account</router-link>
      <router-link role="menuitem" class="dropdown-item" to="/account/profile" exact>Profile</router-link>
      <router-link role="menuitem" class="dropdown-item" to="/account/posts" exact>Posts</router-link>
      <b-dropdown-item href="#" @click.prevent="logout">Logout</b-dropdown-item>
    </b-nav-item-dropdown>
  </b-navbar-nav>
</template>

<script>
export default {
  methods: {
    logout() {
      this.$store.dispatch('logout').then(() => {
        this.$router.push('/auth/login');
      });
    },
  },
  computed: {
    isLoggedIn() {
      return this.$store.getters.isLoggedIn;
    },
    user() {
      return this.$store.getters.currentUser;
    },
  },
};
</script>

