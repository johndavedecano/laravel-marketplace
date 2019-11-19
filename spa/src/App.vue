<script>
import navComponent from './components/header/nav.vue';

export default {
  components: {
    navComponent,
  },
  metaInfo: {
    // if no subcomponents specify a metaInfo.title, this title will be used
    title: 'Buy and Sell',
    meta: [
      { name: 'description', content: 'Your #1 online buy and sell platform' },
    ],
    // all titles will be injected into this template
    titleTemplate: '%s | Laravel Marketplace',
  },
};
</script>

<template>
  <div id="app">
    <navComponent />
    <transition name="fade" mode="out-in" appear>
      <router-view></router-view>
    </transition>
     <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Laravel Marketplace 2017</p>
      </div>
      <!-- /.container -->
    </footer>
  </div>
</template>
