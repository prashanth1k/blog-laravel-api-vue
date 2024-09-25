<script setup>
import DefaultLayout from '@/components/Layouts/DefaultLayout.vue';
import router from '@/router';
import { useAuthStore } from '@/stores/auth';
import { ref, computed, onMounted } from 'vue'


const authStore = useAuthStore()
const errors = ref()
onMounted(async () => {
  await handleSubmit()
})
const handleSubmit = async () => {
  try {
    errors.value = ""
    const res = await fetch('/api/logout', {
      method: 'POST',
      headers: {
        authorization: `Bearer ${authStore.token}`,
      },
      body: JSON.stringify({

      })
    })
    await router.push({ name: 'home' })

  } catch (error) {
    console.error('Error:', error)
    errors.value = error.message
  }
  finally {
    authStore.user = ""
    authStore.setToken("")
  }
}
</script>
<template>
  <DefaultLayout>
    <div class="flex flex-col justify-center py-12 sm:px-6 lg:px-8">
      <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="text-center text-3xl font-extrabold text-gray-900">
          Logout
        </h2>
      </div>
      <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
          <h3 class="text-lg">This will take a min..👋</h3>

          <div class="mt-6">
            <div class="relative">
              <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300">

                </div>
              </div>
            </div>

            <div class="mt-6">
              <RouterLink to="/"
                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-600 bg-white hover:bg-gray-50">
                Go Back to Home Page
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
