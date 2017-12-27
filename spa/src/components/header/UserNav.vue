<template>
  <b-navbar-nav class="ml-auto">
    <b-nav-item-dropdown right>
      <!-- Using button-content slot -->
      <template slot="button-content">
        <span>Account Login</span>
      </template>
      <b-dropdown-item href="#">Profile</b-dropdown-item>
      <b-dropdown-item href="#">Signout</b-dropdown-item>
    </b-nav-item-dropdown>
  </b-navbar-nav>
</template>
