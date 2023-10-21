import { createApp } from 'vue';
import App from './App.vue';
import { createRouter, createWebHistory } from 'vue-router'; // Import Vue Router
import 'vuetify/styles';
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';
import router from './router'; // Import your router configuration
const harperTheme = {
    dark: false,
    colors: {
        background: '#F5F5F5FF',
        surface: '#FFFFFF',
        primary: '#657686',
        secondary: '#10E49C',
        error: '#F14668',
        info: '#3E8ED0',
        success: '#48C78EFF',
        warning: '#ffdd80',
        harper: '#A31E4C',
    }
}
const vuetify = createVuetify({
    components,
    directives,
    theme: {
        defaultTheme: 'harperTheme',
        themes: {
            harperTheme
        }
    }

});

const app = createApp(App);
app.use(router); // Use Vue Router
app.use(vuetify); // Use Vuetify
app.mount('#app');
