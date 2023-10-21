// Import necessary modules
import { createRouter, createWebHistory } from 'vue-router';

// Import your components
import Home from './views/Home.vue';
import About from './views/About.vue';
import Login from './views/Login.vue';
import EmailVerification from './views/EmailVerification.vue'; // Create this component for email verification

const routes = [
  {
    path: '/',
    component: Home,
    name: 'home',
    meta: { requiresAuth: true }, // Add this meta field to require authentication
  },
  {
    path: '/about',
    component: About,
    name: 'about',
    meta: { requiresAuth: true }, // Add this meta field to require authentication
  },
  {
    path: '/login',
    component: Login,
    name: 'login',
  },
  {
    path: '/email/verify/:id/:hash', // Define a route for email verification
    component: EmailVerification,
    name: 'email-verification',
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

// Route navigation guards
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
