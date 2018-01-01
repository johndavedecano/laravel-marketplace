<script>
export default {
  props: ['title', 'subtitle'],
};
</script>

<template>
  <div class="container page">
    <!-- Page Heading/Breadcrumbs -->
    <h2 class="mt-4 mb-3">{{ title }}
      <small v-if="!!subtitle">{{ subtitle }}</small>
    </h2>
    <slot></slot>
  </div>
</template>
