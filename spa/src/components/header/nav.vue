<script>
import UserNav from './UserNav.vue';
import GuestNav from './GuestNav.vue';

export default {
  components: {
    UserNav,
    GuestNav,
  },
};
</script>


<template>
  <b-navbar toggleable="md" type="dark" variant="info">
    <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>
    <b-navbar-brand href="#">Laravel Marketplace</b-navbar-brand>
    <b-collapse is-nav id="nav_collapse">
      <GuestNav />
      <!-- Right aligned nav items -->
      <UserNav />
    </b-collapse>
  </b-navbar>
</template>
