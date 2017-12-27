<template>
  <div class="card">
    <h4 class="card-header">Account Login</h4>
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

        <b-form-group id="passwordGroup"
                    label="Password:"
                    label-for="password">
          <b-form-input id="password"
                        type="password"
                        required
                        placeholder="">
          </b-form-input>
        </b-form-group>

        <div class="auth-buttons">
          <b-button type="submit" variant="primary" block>Submit</b-button>
        </div>

        <div class="auth-links">
          <router-link to="/auth/forgot">Forgot Password</router-link> or
          <router-link to="/auth/register">Register Account</router-link>
        </div>
      </b-form>
    </div>
  </div>
</template>
