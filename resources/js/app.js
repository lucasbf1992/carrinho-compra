import './bootstrap';
import { createApp } from 'vue';

import App from './components/App.vue';
import ProductList from './components/ProductList.vue'

const app = createApp(App);

app.component('ProductList', ProductList)
app.mount('#app')
