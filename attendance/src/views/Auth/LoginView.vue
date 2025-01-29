
<script setup>
import { useLoginStore } from '@/stores/login';
import InputField from '@/components/InputField.vue';
import { ref } from 'vue';
const loginStore = useLoginStore();
const requestForm = async ()=>{
  loginStore.login();
}
</script>

<template>
    <div class="container">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card px-sm-6 px-0">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">

                  </span>
                  <span class="app-brand-text demo text-heading fw-bold">ATTENDANCE SYSTEM</span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-1">Welcome to software 👋</h4>
              <p class="mb-6">Please sign-in to your account and start the adventure</p>

              <form id="formAuthentication" class="mb-6" @submit.prevent="requestForm">
                <div class="mb-6">
                  <label for="email" class="form-label">Email or Username</label>
                  <input
                    type="email"
                    class="form-control"
                    id="email"
                    v-model="loginStore.inputField.email"
                    placeholder="Enter your email or username"
                    autofocus />
                </div>

                <div class="mb-6 form-password-toggle">
                  <label class="form-label" for="password">Password</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      v-model="loginStore.inputField.password"
                      placeholder="Enter user password"
                      aria-describedby="password" />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <!-- <div class="mb-6 form-password-toggle">
                  <InputField type="password" id="password" v-model="loginStore.inputField.password" placeholder="Enter user password" aria-describedby="password"/>
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div> -->
                <div class="mb-8">
                  <div class="d-flex justify-content-between mt-8">
                    <div class="form-check mb-0 ms-2">
                      <input class="form-check-input" type="checkbox" id="remember-me" />
                      <label class="form-check-label" for="remember-me"> Remember Me </label>
                    </div>
                    <a href="auth-forgot-password-basic.html">
                      <span>Forgot Password?</span>
                    </a>
                  </div>
                </div>
                <div class="mb-6">
                  <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                </div>
              </form>


            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>
</template>

<style>
/* Add component-specific styles here if needed */
</style>
