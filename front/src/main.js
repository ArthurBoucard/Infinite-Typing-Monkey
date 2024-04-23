import { createApp } from 'vue';
import App from './App.vue';
import { createWebHistory, createRouter } from 'vue-router'

import GeneratedText from './GeneratedText.vue';
import FullText from './FullText.vue';

const routes = [
	{ path: '/', component: GeneratedText },
  { path: '/fulltext', component: FullText },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

const app = createApp(App);
app.use(router);
app.mount('#app');

export const eventBus = app;
