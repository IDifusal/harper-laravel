// Import necessary modules
import { createRouter, createWebHistory } from 'vue-router';

// Import your components
import Home from './views/Home.vue';
import About from './views/About.vue';
import Login from './views/Login.vue';
const routes = [
  {
    path: '/',
    component: () => import('./views/products/AllProducts.vue'),
    name: 'home',
    meta: { requiresAuth: true }, 
  },
  {
    path: '/about',
    component: About,
    name: 'about',
    meta: { requiresAuth: true },
  },
  {
    path: '/login',
    component: Login,
    name: 'login',
  },
  {
    path: '/products',
    component: () => import('./views/products/AllProducts.vue'),
    name: 'products',
    meta: { requiresAuth: true },     
  }, 
  {
    path: '/products/:id',
    component: () => import('./views/products/DetailsProduct.vue'),
    name: 'details',
    meta: { requiresAuth: true },     
  },
  {
    path: '/products/request',
    component: () => import('./views/products/AllProducts.vue'),
    name: 'request',
    meta: { requiresAuth: true },     
  }, 
  {
    path: '/products/movements',
    component: () => import('./views/products/Movements.vue'),
    name: 'movements',
    meta: { requiresAuth: true },     
  },
  {
    path:'/requests/my-requests',
    component: () => import('./views/products/MyRequests.vue'),
    name: 'my-requests',
    meta: { requiresAuth: true },
  },
  {
    path:'/requests/pending-requests',
    component: () => import('./views/products/PendingRequests.vue'),
    name: 'pending-requests',
    meta: { requiresAuth: true },
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  const isAuthenticated = !!localStorage.getItem('authToken'); // Check if the token is present in local storage

  if (to.matched.some((record) => record.meta.requiresAuth)) {
    // If the route requires authentication
    if (!isAuthenticated) {
      // If the user is not authenticated, redirect to the login page
      next({ name: 'login' });
    } else {
      // If the user is authenticated, allow access to the route
      next();
    }
  } else {
    // If the route does not require authentication, allow access
    next();
  }
});

export default router;
