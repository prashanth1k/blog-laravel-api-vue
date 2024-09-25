<script setup>
import DefaultLayout from '@/components/Layouts/DefaultLayout.vue';
import router from '@/router';
import { useAuthStore } from '@/stores/auth';
import { ref, computed } from 'vue'

const name = ref('')
const email = ref('')
const password = ref('')
const passwordConfirmation = ref('')

const isFormValid = computed(() => {
  return (
    name.value.trim() !== '' &&
    email.value.trim() !== '' &&
    password.value.length >= 3 &&
    password.value === passwordConfirmation.value
  )
})

const authStore = useAuthStore()
const errors = ref()
const handleSubmit = async () => {
  try {
    if (isFormValid.value) {
      // Here you would typically make an API call to register the user
      errors.value = ""
      const res = await fetch('/api/register', {
        method: 'POST',
        body: JSON.stringify({
          name: name.value,
          email: email.value,
          password: password.value,
          password_confirmation: passwordConfirmation.value
        })
      })
      const resData = await res.json()
      if (resData.message) {
        errors.value = resData
        authStore.user = ""
        authStore.setToken("")
      }
      else {
        authStore.user = resData.user
        authStore.token = authStore.setToken(resData.token)
        await router.push({ name: 'blog' })
      }
    } else {
      console.log('Form is invalid')
    }
  } catch (error) {
    console.error('Error:', error)
    authStore.user = ""
    authStore.setToken("")
    errors.value = error.message
  }
}
</script>
<template>
  <DefaultLayout>
    <div class="flex flex-col justify-center py-12 sm:px-6 lg:px-8">
      <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="text-center text-3xl font-extrabold text-gray-900">
          Create your account
        </h2>
      </div>

      <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
          <form class="space-y-6" @submit.prevent="handleSubmit">
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700">
                Name
              </label>
              <div class="mt-1">
                <input id="name" v-model="name" name="name" type="text" required
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
              </div>
            </div>

            <div>
              <label for="email" class="block text-sm font-medium text-gray-700">
                Email address
              </label>
              <div class="mt-1">
                <input id="email" v-model="email" name="email" type="email" autocomplete="email" required
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
              </div>
            </div>

            <div>
              <label for="password" class="block text-sm font-medium text-gray-700">
                Password
              </label>
              <div class="mt-1">
                <input id="password" v-model="password" name="password" type="password" autocomplete="new-password"
                  required
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
              </div>
            </div>

            <div>
              <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                Confirm password
              </label>
              <div class="mt-1">
                <input id="password_confirmation" v-model="passwordConfirmation" name="password_confirmation"
                  type="password" autocomplete="new-password" required
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
              </div>
            </div>

            <div>
              <button type="submit"
                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed">
                Register
              </button>
            </div>
          </form>

          <div class="mt-6">
            <div class="relative">
              <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
              </div>
              <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-gray-500">
                  Already have an account?
                </span>
              </div>
            </div>

            <div class="mt-6">
              <RouterLink to="/login"
                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-600 bg-white hover:bg-gray-50">
                Sign in
              </RouterLink>
            </div>
            <div class="error pt-8" v-if="errors">
              <ul>
                <li v-for="error in errors" :key="error">{{ error }}</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

    </div>
  </DefaultLayout>
</template>
