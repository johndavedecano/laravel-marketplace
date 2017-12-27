<script>
import navComponent from './components/header/nav.vue';
import logo from 'images/logo.png';

export default {
  components: {
    navComponent,
  },
};
</script>

<template>
  <div id="app">
    <navComponent />
    <main role="main" class="main">
      <transition name="fade" mode="out-in" appear>
        <router-view></router-view>
      </transition>
    </main>
  </div>
</template>
