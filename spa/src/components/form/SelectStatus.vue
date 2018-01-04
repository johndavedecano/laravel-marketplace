<template>
<v-select
  :value.sync="localValue"
  :options="options"
  placeholder="Select Status"
>
</v-select>
</template>

<script>
import vSelect from 'vue-select';
export default {
  props: ['value'],
  components: { vSelect },
  data() {
    return {
      localValue: null,
      options: [
        {
          value: 'active',
          label: 'Active',
        },
        {
          value: 'draft',
          label: 'Draft',
        },
      ],
    };
  },
  created() {
    this.options.forEach(option => {
      if (option.value === this.value) {
        this.localValue = option;
      }
    });
  },
};
</script>