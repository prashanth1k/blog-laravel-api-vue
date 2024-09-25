<script setup lang="ts">
import DefaultLayout from '@/components/Layouts/DefaultLayout.vue';
import { onMounted, ref } from 'vue';
import { useAuthStore } from '@/stores/auth';
const authStore = useAuthStore()
const posts = ref([])

onMounted(async () => {
  const res = await fetch("/api/posts");
  posts.value = await res.json();
})

const truncateContent = (content, length = 100) => {
  return content.length > length ? content.slice(0, length) + '...' : content;
};

const formatDate = (dateString) => {
  return new Date(dateString).toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'numeric',
    day: 'numeric'
  });
};

const capitalize = (str) => {
  return str.charAt(0).toUpperCase() + str.slice(1);
};


</script>

<template>
  <DefaultLayout>
    <div class="container mx-auto px-4 py-8">
      <h1 class="text-3xl font-bold mb-6">Posts</h1>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div v-for="post in posts.data" :key="post.id" class="bg-white rounded-lg shadow-md overflow-hidden">
          <RouterLink :to="`/blog/${post.id}`">
            <div class="p-6">
              <h2 class="text-xl font-semibold mb-2">{{ post.title }}</h2>
              <p class="text-gray-600 mb-4">{{ truncateContent(post.content) }}</p>
              <div class="flex justify-between items-center text-sm text-gray-500">

                <span
                  :class="{ 'text-green-500': post.status === 'published', 'text-yellow-500': post.status === 'draft' }">
                  {{ capitalize(post.status) }}
                </span>
              </div>
            </div>
            <div class="bg-gray-50 px-6 py-4">
              <div class="flex items-center justify-between text-gray-500 text-xs font-semibold">
                <div>
                  {{ formatDate(post.published_at) }}
                </div>
                <div class="   ">
                  {{ post.user.name }}
                </div>
              </div>
            </div>
          </RouterLink>
        </div>
      </div>
    </div>
  </DefaultLayout>
</template>

<style></style>
