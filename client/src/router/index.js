import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import { useAuthStore } from '@/stores/auth'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/blog',
      name: 'blog',
      component: () => import('../views/posts/PostListView.vue')
    },
    {
      path: '/blog/edit/:id',
      name: 'post_edit',
      component: () => import('../views/posts/PostEditView.vue'),
      props: true,
      meta: { requiresAuth: true }
    },
    {
      path: '/blog/:id',
      name: 'post_detail',
      component: () => import('../views/posts/PostDetailView.vue'),
      props: true
    },
    {
      path: '/register',
      name: 'register',
      component: () => import('../views/auth/RegisterView.vue')
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../views/auth/LoginView.vue')
    },
    {
      path: '/logout',
      name: 'logout',
      component: () => import('../views/auth/LogoutView.vue'),
      meta: { requiresAuth: true }
    },
    {
      path: '/about',
      name: 'about',
      component: () => import('../views/AboutView.vue'),
      meta: { requiresAuth: true }
    }
  ]
})

router.beforeEach((to, from, next) => {
  // const isLoggedIn = localStorage.getItem('token')
  const authStore = useAuthStore()

  const isLoggedIn = authStore.token !== ''

  if (to.meta?.requiresAuth && !isLoggedIn) {
    return next('/login')
  }

  next()
})

export default router
