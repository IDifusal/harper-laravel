import { defineStore } from 'pinia';

export const useUserStore = defineStore({
  id: 'user',
  state: () => ({
    role: '', 
  }),
  actions: {
    setRole(role) {
      console.log('setRole', role);
      this.role = role;
    },
  },
});
