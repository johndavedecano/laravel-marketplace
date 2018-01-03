<template>
<v-select
  :value.sync="localValue"
  :options="options"
  :on-change="onChange"
  placeholder="Select Location"
>
</v-select>
</template>

<script>
import axios from 'axios';
import vSelect from 'vue-select';
export default {
  props: ['value'],
  components: { vSelect },
  data() {
    return {
      localValue: null,
      options: [],
    };
  },
  created() {
    this.requestOptions()
      .then(resp => {
        return resp.data;
      })
      .then(options => {
        this.options = options.map(option => {
          if (option.value === this.value) {
            this.localValue = option;
          }
          return option;
        });
      })
      .catch(error => {
        console.error(error);
        this.options = [];
      });
  },
  methods: {
    requestOptions() {
      return axios.get('/api/locations?select=true');
    },
    onChange({ value }) {
      this.$emit('change', value);
    },
  },
};
</script>