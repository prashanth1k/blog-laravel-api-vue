<script setup>
import Appbar from '../Appbar.vue';

</script>
<!-- src/components/Layout.vue -->
<template>
  <div class="min-h-screen flex flex-col bg-gray-100">
    <!-- Appbar -->
    <Appbar />

    <!-- Main Content -->
    <main class="flex-grow">
      <slot></slot>
    </main>
  </div>
</template>
