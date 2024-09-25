<script setup>
import DefaultLayout from '@/components/Layouts/DefaultLayout.vue';
import { useRoute } from 'vue-router'

import router from '@/router';
import { ref, onMounted, computed } from 'vue'

const title = ref('')
const slug = ref('')
const content = ref('')
const status = ref('draft')
const errors = ref()

const route = useRoute()

const generateSlug = () => {
  slug.value = title.value
    .toLowerCase()
    .replace(/[^\w ]+/g, '')
    .replace(/ +/g, '-')
}

const encodeSlug = () => {
  slug.value = encodeURIComponent(slug.value)
}

const isFormValid = computed(() => {
  return title.value?.trim() !== '' &&
    slug.value?.trim() !== '' &&
    content.value?.trim() !== ''
})


const submitForm = async () => {
  errors.value = ""
  try {
    if (route.params.id === 'new') {
      await createPost({ title: title.value, slug: slug.value, content: content.value })
    } else {
      await updatePost(route.params.id, { title: title.value, slug: slug.value, content: content.value })
    }
    // Redirect or show success message
  } catch (error) {
    errors.value = error.message
  }

}

const createPost = async () => {
  if (isFormValid.value) {
    const newPost = {
      title: title.value,
      slug: slug.value,
      content: content.value,
      status: status.value.toLowerCase(),
      // published_at: new Date().toISOString()
      published_at: status.value === 'published' ? new Date().toISOString() : null
    }
    const res = await fetch('/api/posts', {
      method: 'POST',
      body: JSON.stringify(newPost),
      headers: {
        authorization: `Bearer ${localStorage.getItem('token')}`,
      }
    })
    const resData = await res.json()
    if (resData.message) {
      errors.value = resData
    }
    else {

      // Reset form after submission
      title.value = ''
      slug.value = ''
      content.value = ''
      status.value = 'draft'
    }
  }
}

const updatePost = async () => {
  if (isFormValid.value) {
    const updPost = {
      title: title.value,
      slug: slug.value,
      content: content.value,
      status: status.value.toLowerCase(),
      published_at: status.value === 'published' ? new Date().toISOString() : null
    }
    const res = await fetch('/api/posts/' + route.params.id, {
      method: 'PATCH',
      body: JSON.stringify(updPost),
      headers: {
        authorization: `Bearer ${localStorage.getItem('token')}`,
      }
    })
    const resData = await res.json()
    if (resData.message) {
      errors.value = resData
    }
    else {
      await router.push({ name: 'post_detail', params: { id: resData.id } })
    }
  }
}

const loadPost = async (id) => {
  try {
    const post = await fetchPostById(id)
    title.value = post.title
    slug.value = post.slug
    content.value = post.content
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
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
      <h2 class="text-2xl font-bold mb-6 text-gray-800">Create / Edit Post</h2>
      <form @submit.prevent="submitForm" class="space-y-6">
        <!-- Title Input -->
        <div>
          <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
          <input type="text" id="title" v-model="title" @input="generateSlug"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            required>
        </div>

        <!-- Slug Input -->
        <div>
          <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
          <input type="text" id="slug" v-model="slug" @blur="encodeSlug"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            required>
        </div>

        <!-- Content Textarea -->
        <div>
          <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
          <textarea id="content" v-model="content" rows="6"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            required></textarea>
        </div>

        <!-- Status Dropdown -->
        <div>
          <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
          <select id="status" v-model="status"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option value="draft">Draft</option>
            <option value="published">Published</option>
          </select>
        </div>

        <!-- Submit Button -->
        <div>
          <button type="submit"
            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            :disabled="!isFormValid">
            <span v-if="route.params.id === 'new'">Create Post</span>
            <span v-else>Update Post</span>
          </button>
        </div>
      </form>
      <div class="error pt-8" v-if="errors">
        {{ errors }}
      </div>
    </div>
  </DefaultLayout>
</template>