<template>
  <b-navbar-nav>
    <router-link class="nav-item" tag="li" to="/" exact>
      <a class="nav-link">Home</a>
    </router-link>
    <router-link class="nav-item" tag="li" to="/posts">
      <a class="nav-link">Browse</a>
    </router-link>

    <router-link class="nav-item" tag="li" to="/about">
      <a class="nav-link">About Us</a>
    </router-link>

    <router-link class="nav-item" tag="li" to="/contact">
      <a class="nav-link">Contact Us</a>
    </router-link>

    <router-link class="nav-item" tag="li" to="/account/posts/submit">
      <a class="nav-link">Submit</a>
    </router-link>

  </b-navbar-nav>
</template>
