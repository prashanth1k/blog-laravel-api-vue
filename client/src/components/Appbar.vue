<script setup>
import { ref, computed } from 'vue'
import { Icon } from '@iconify/vue'
import logo from '@/assets/logo.svg'
import { useAuthStore } from '@/stores/auth';

const navItems = [
  { name: 'Home', href: '/' },
  { name: 'Articles', href: '/blog' },
  { name: 'About', href: '/about' },
]

const authStore = useAuthStore()

const isProfileMenuOpen = ref(false)
const isMobileMenuOpen = ref(false)

const isLoggedIn = computed(() => authStore.token != "")

const toggleProfileMenu = () => {
  isProfileMenuOpen.value = !isProfileMenuOpen.value
}

const toggleMobileMenu = () => {
  isMobileMenuOpen.value = !isMobileMenuOpen.value
}
</script>

<template>
  <nav class="bg-gray-100 ">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-20">
      <div class="flex justify-between h-16">
        <div class="flex">
          <div class="flex-shrink-0 flex items-center mr-12">
            <img :src="logo" alt="Logo" class="h-8 w-12" />
            <span class="ml-2 text-xl font-bold text-gray-900">Bloggy</span>
          </div>
          <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
            <RouterLink v-for="item in navItems" :key="item.name" :to="item.href" :class="[
              $route.path == item.href
                ? 'border-indigo-500 text-gray-900'
                : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700',
              'inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium'
            ]">
              {{ item.name }}
            </RouterLink>
          </div>
        </div>
        <div class="hidden sm:ml-6 sm:flex sm:items-center">
          <div class="ml-3 relative">
            <button type="button"
              class="bg-white rounded-full flex text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
              @click="toggleProfileMenu">
              <span class="sr-only">Open user menu</span>
              <!-- <img class="h-8 w-8 rounded-full" src="/placeholder.svg?height=32&width=32" alt="User avatar" /> -->
              <Icon icon="mdi:account" class="h-8 w-8 rounded-full" />
            </button>
            <transition enter-active-class="transition ease-out duration-200"
              enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100"
              leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100"
              leave-to-class="transform opacity-0 scale-95">
              <div v-if="isProfileMenuOpen"
                class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                <div v-if="!isLoggedIn">
                  <RouterLink to="/login" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign in
                  </RouterLink>
                  <RouterLink to="/register" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Register
                  </RouterLink>
                </div>
                <div v-else>
                  <div class="bg-gray-100 block px-4 py-2 text-xs text-gray-700 hover:bg-gray-100">{{
                    authStore.user?.name }} | {{
                      authStore.user?.email }}</div>
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your Profile</a>
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                  <RouterLink to="/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign out
                  </RouterLink>
                </div>
              </div>
            </transition>
          </div>
        </div>
        <div class="-mr-2 flex items-center sm:hidden">
          <button type="button"
            class="bg-white inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
            @click="toggleMobileMenu">
            <span class="sr-only">Open main menu</span>
            <Icon v-if="!isMobileMenuOpen" icon="mdi:menu" class="block h-6 w-6" />
            <Icon v-else icon="mdi:close" class="block h-6 w-6" />
          </button>
        </div>
      </div>
    </div>

    <transition enter-active-class="transition ease-out duration-200" enter-from-class="transform opacity-0 scale-95"
      enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75"
      leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
      <div v-if="isMobileMenuOpen" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
          <a v-for="item in navItems" :key="item.name" :href="item.href" :class="[
            item.current
              ? 'bg-indigo-50 border-indigo-500 text-indigo-700'
              : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800',
            'block pl-3 pr-4 py-2 border-l-4 text-base font-medium'
          ]">
            {{ item.name }}
          </a>
        </div>


        <div class="pt-4 pb-3 border-t border-gray-200">
          <div class="flex items-center px-4">
            <div class="flex-shrink-0">
              <Icon icon="mdi:account" size="large" />
            </div>

          </div>
          <div v-if="!isLoggedIn">
            <RouterLink to="/login"
              class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">Sign in
            </RouterLink>
            <RouterLink to="/register"
              class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">Register
            </RouterLink>
          </div>
          <div class="mt-3 space-y-1" v-else>
            <div class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-100">{{ authStore.user?.name }} | {{
              authStore.user?.email }}</div>


            <a href="#"
              class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">Your
              Profile</a>
            <a href="#"
              class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">Settings</a>
            <RouterLink to="/logout"
              class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">Sign out
            </RouterLink>
          </div>
        </div>
      </div>
    </transition>
  </nav>
</template>
