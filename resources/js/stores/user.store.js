import { defineStore } from 'pinia';

export const useUserStore = defineStore({
  id: 'user',
  state: () => ({
    isLogged: false,
    authToken: null,
    role: '', 
  }),
  getters: {
    isUserLoggedIn: (state) => !!state.isLogged,
  },
  actions: {
    setIslogged(isLogged) {
      console.log('setIslogged', isLogged);
      this.isLogged = isLogged;
    },
    setAuthToken(token) {
      this.authToken = token;
    },
    setRole(role) {
      console.log('setRole', role);
      this.role = role;
    },
    logout() {
      this.authToken = null;
      this.role = '';
    }
  },
});
