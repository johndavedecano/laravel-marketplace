<template>
<v-select
  :value.sync="selected"
  :options="options"
  placeholder="Select Location"
>
</v-select>
</template>

<script>
import axios from 'axios';
import vSelect from 'vue-select';
export default {
  components: { vSelect },
  data() {
    return {
      selected: null,
      options: [],
    };
  },
  created() {
    this.requestOptions()
      .then(resp => {
        return resp.data;
      })
      .then(options => {
        this.options = options;
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
  },
};
</script>