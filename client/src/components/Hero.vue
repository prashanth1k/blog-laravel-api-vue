<template>
  <section class="relative overflow-hidden bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 z-10">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32 lg:py-40">
      <div class="text-center">
        <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-white mb-6">
          <span class="block">Welcome to Bloggy</span>
          <span class="block text-yellow-400">Our Amazing Blog</span>
        </h1>
        <p class="mt-3 max-w-md mx-auto text-base sm:text-lg md:text-xl text-gray-300 sm:mt-5 md:mt-8 md:max-w-3xl">
          Discover insightful articles, expert opinions, and the latest trends in technology, lifestyle, and more. Join
          our community of curious minds and expand your horizons.
        </p>
        <div class="mt-10 sm:mt-12">
          <div class="sm:flex sm:justify-center">
            <div class="rounded-md shadow">
              <RouterLink to="/blog"
                class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-white hover:bg-gray-100 md:py-4 md:text-lg md:px-10 transition duration-150 ease-in-out">
                Start Reading
              </RouterLink>
            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0">
      <svg class="w-full h-24 md:h-32 lg:h-40 text-gray-900 fill-current" xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 1440 320">
        <path fill-opacity="1"
          d="M0,224L60,213.3C120,203,240,181,360,181.3C480,181,600,203,720,213.3C840,224,960,224,1080,213.3C1200,203,1320,181,1380,170.7L1440,160L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z">
        </path>
      </svg>
    </div>
  </section>
</template>

<script setup>
// No additional script is needed for this component
</script>