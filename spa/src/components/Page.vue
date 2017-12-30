<script>
export default {
  props: ['title', 'subtitle'],
};
</script>

<template>
  <div class="container page">
      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">{{ title }}
        <small v-if="!!subtitle">{{ subtitle }}</small>
      </h1>
      <hr>
      <div class="row">
        <slot></slot>
      </div>
  </div>
</template>
