<template>
  <div class="page-single">
    <div class="container">
      <div class="row">
        <div class="col col-login mx-auto">
          <div class="text-center mb-6">
            <img
              src="https://tabler.github.io/tabler/demo/brand/tabler.svg"
              class="h-6"
              alt="Logo Tabler"
            >
          </div>

          <form
            class="card"
            method="post"
            novalidate
            @submit.prevent="register"
          >
            <div class="card-body p-6">
              <div class="card-title">
                Create new account
              </div>

              <div class="form-group">
                <label class="form-label">Name</label>
                <input
                  v-model="registerForm.name"
                  type="text"
                  class="form-control"
                  :class="form.errors.has('name') ? 'is-invalid' : ''"
                  placeholder="Enter name"
                  required
                  autofocus
                >
                <span
                  v-if="form.errors.has('name')"
                  class="invalid-feedback"
                >
                  <strong>{{ form.errors.get('name') }}</strong>
                </span>
              </div>
              <div class="form-group">
                <label class="form-label">Email address</label>
                <input
                  v-model="registerForm.email"
                  type="email"
                  class="form-control"
                  :class="form.errors.has('email') ? 'is-invalid' : ''"
                  placeholder="Enter email"
                  required
                >
                <span
                  v-if="form.errors.has('email')"
                  class="invalid-feedback"
                >
                  <strong>{{ form.errors.get('email') }}</strong>
                </span>
              </div>
              <div class="form-group">
                <label class="form-label">Password</label>
                <input
                  v-model="registerForm.password"
                  type="password"
                  class="form-control"
                  :class="form.errors.has('password') ? 'is-invalid' : ''"
                  placeholder="Password"
                  required
                >
                <span
                  v-if="form.errors.has('password')"
                  class="invalid-feedback"
                >
                  <strong>{{ form.errors.get('password') }}</strong>
                </span>
              </div>
              <div class="form-group">
                <label
                  class="form-label"
                  for="password-confirm"
                >Confirm Password</label>
                <input
                  id="password-confirm"
                  v-model="registerForm.password_confirmation"
                  type="password"
                  class="form-control"
                  :class="form.errors.has('password_confirmation') ? 'is-invalid' : ''"
                  placeholder="Confirm Password"
                >
                <span
                  v-if="form.errors.has('password_confirmation')"
                  class="invalid-feedback"
                >
                  <strong>{{ form.errors.get('password_confirmation') }}</strong>
                </span>
              </div>

              <div class="form-footer">
                <button
                  type="submit"
                  class="btn btn-primary btn-block"
                >
                  Create new account
                </button>
              </div>
            </div>
          </form>

          <div class="text-center text-muted">
            Already have an account? <a href="#">Sign in</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

    import Form from 'form-object';

    export default {
        data: function () {
            return {
                registerForm: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                },
                form: new Form
            }
        },
        methods: {
            register() {
                this.form.post('/register', this.registerForm)
                    .then(() => {
                        window.location = '/home';
                    })
            }
        }
    }
</script>
