import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useAuthStore = defineStore('auth', () => {
  const token = ref('')
  const user = ref({})
  const setToken = (newToken) => {
    token.value = newToken
    localStorage.setItem('token', newToken)
  }
  return { token, user, setToken }
})
