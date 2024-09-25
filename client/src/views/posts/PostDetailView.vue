<script setup>
import DefaultLayout from '@/components/Layouts/DefaultLayout.vue';
import { useRoute } from 'vue-router'

import router from '@/router';
import { ref, onMounted, computed } from 'vue'

const title = ref('')
const slug = ref('')
const content = ref('')
const status = ref('')
const published_at = ref('')
const errors = ref()

const route = useRoute()


const loadPost = async (id) => {
  try {
    const post = await fetchPostById(id)
    title.value = post.title
    slug.value = post.slug
    content.value = post.content
    status.value = post.status
    published_at.value = post.published_at
  } catch (error) {
    errors.value = error.message
  }
}

const fetchPostById = async (id) => {
  const res = await fetch(`/api/posts/${id}`)
  const post = await res.json()
  return post.data
}

onMounted(() => {
  if (route.params.id !== 'new') {
    loadPost(route.params.id)
  }
})

</script>
<template>
  <DefaultLayout>
    <div class="error pt-8" v-if="errors">
      {{ errors }}
    </div>

    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
      <h2 class="text-2xl font-bold mb-6 text-gray-800">{{ title }}</h2>
      <div class="mt-2 flex items-center justify-between">
        <span class="px-3 py-1 text-sm font-semibold rounded-full" :class="{
          'bg-green-100 text-green-800': status === 'published',
          'bg-yellow-100 text-yellow-800': status === 'draft'
        }">
          {{ status }}
        </span>
        <time v-if="published_at" :datetime="published_at" class="text-sm text-gray-600">
          {{ new Date(published_at).toLocaleDateString('en-US', {
            year: 'numeric', month: 'long', day: 'numeric'
          }) }}
        </time>
      </div>
    </div>
    <article class="max-w-2xl mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">

      <div class="prose max-w-none" v-html="content"></div>

      <footer class="mt-8 pt-6 border-t border-gray-200">
        <div class="flex items-center">

          <div>
            <!-- author name etc. -->
          </div>
        </div>
      </footer>
    </article>

  </DefaultLayout>
</template>