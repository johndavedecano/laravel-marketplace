<template>
  <div class="card">
    <h4 class="card-header">Forgot Password</h4>
    <div class="card-body">
      <b-form>
        <b-form-group id="emailGroup"
                    label="Email address:"
                    label-for="email">
          <b-form-input id="email"
                        type="email"
                        required
                        :state="false"
                        placeholder="Enter email">
          </b-form-input>
          <b-form-invalid-feedback></b-form-invalid-feedback>
        </b-form-group>

        <div class="auth-buttons">
          <b-button type="submit" variant="primary" block>Submit</b-button>
        </div>

        <div class="auth-links">
          <router-link to="/auth/login">Existing Account</router-link> or
          <router-link to="/auth/register">Register Account</router-link>
        </div>
      </b-form>
    </div>
  </div>
</template>
