<script>
export default {
  metaInfo: {
    title: 'Submit Post',
  },
  data() {
    return {
      title: '',
      description: '',
      price: 0.0,
      location_id: 1,
      category: 2,
    };
  },
};
</script>

<template>
  <page title="Submit Post">
    <div class="row">
      <div class="col-md-8">
        <b-form @submit.prevent="onSubmit">
          <b-form-group>
            <b-form-input id="title"
              type="text"
              required
              v-model="title"
              placeholder="What are you selling?" />
          </b-form-group>
          <b-form-group>
            <b-form-textarea id="description"
              required
              v-model="description"
              placeholder="Description"
              :rows="10"
              :max-rows="50" />
          </b-form-group>
          <b-form-group>
            <b-input-group left="$">
              <b-form-input id="price"
                type="text"
                required
                v-model="price"
                placeholder="0.00" />
              </b-input-group>
          </b-form-group>

          <b-form-group>
            <select-location v-model="location_id"/>
          </b-form-group>

          <b-form-group>
            <select-category v-model="category" />
          </b-form-group>

          <b-button type="submit" variant="primary">Submit</b-button>
          <b-button type="reset" variant="danger">Reset</b-button>
        </b-form>
      </div>
    </div>
  </page>
</template>
