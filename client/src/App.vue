<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <header>
    <!-- <div>
      <h1 class="text-xl font-bold">Blah</h1>

      <nav>
        <RouterLink to="/" class="nav-link">Home</RouterLink>
        <RouterLink to="/about" class="nav-link">About</RouterLink>
      </nav>
    </div> -->
  </header>
  <RouterView />
</template>

<style scoped></style>
