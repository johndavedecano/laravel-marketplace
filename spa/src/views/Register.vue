<template>
  <div class="card">
    <h4 class="card-header">Registration</h4>
    <div class="card-body">
      <b-form>
        <b-form-group id="name"
                    label="Full name:"
                    label-for="name">
          <b-form-input id="name"
                        type="text"
                        required
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

        <b-form-group id="passwordConfirmationGroup"
                    label="Password Confirmation:"
                    label-for="password_confirmation">
          <b-form-input id="password_confirmation"
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
