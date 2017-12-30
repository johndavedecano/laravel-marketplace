<script>
export default {
  data() {
    return {
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
    };
  },
  methods: {
    onSubmit() {
      this.$store
        .dispatch('register', {
          name: this.name,
          email: this.email,
          password: this.password,
          password_confirmation: this.password_confirmation,
        })
        .then(() => {
          this.$router.push('/');
        });
    },
  },
  computed: {
    isLoading() {
      return this.$store.getters.isLoading;
    },
  },
  metaInfo: {
    title: 'Register',
  },
};
</script>

<template>
  <div class="card">
    <h4 class="card-header">Registration</h4>
    <div class="card-body">
      <b-form @submit.prevent="onSubmit">
        <b-form-group id="name"
                    label="Full name:"
                    label-for="name">
          <b-form-input id="name"
                        type="text"
                        required
                        v-model="name"
                        placeholder="Enter name">
          </b-form-input>
          <b-form-invalid-feedback></b-form-invalid-feedback>
        </b-form-group>

        <b-form-group id="emailGroup"
                    label="Email address:"
                    label-for="email">
          <b-form-input id="email"
                        type="email"
                        required
                        v-model="email"
                        placeholder="Enter email">
          </b-form-input>
          <b-form-invalid-feedback></b-form-invalid-feedback>
        </b-form-group>

        <b-form-group id="passwordGroup"
                    label="Password:"
                    label-for="password">
          <b-form-input id="password"
                        type="password"
                        required
                        v-model="password"
                        placeholder="">
          </b-form-input>
        </b-form-group>

        <b-form-group id="passwordConfirmationGroup"
                    label="Password Confirmation:"
                    label-for="password_confirmation">
          <b-form-input id="password_confirmation"
                        type="password"
                        required
                        v-model="password_confirmation"
                        placeholder="">
          </b-form-input>
        </b-form-group>

        <div class="auth-buttons">
          <b-button type="submit"
                variant="primary"
                :disabled="isLoading === true"
                block>{{ isLoading ? 'Please Wait...' : 'Submit'}}</b-button>
        </div>

        <div class="auth-links">
          <router-link to="/auth/forgot">Forgot Password</router-link> or
          <router-link to="/auth/register">Register Account</router-link>
        </div>
      </b-form>
    </div>
  </div>
</template>
