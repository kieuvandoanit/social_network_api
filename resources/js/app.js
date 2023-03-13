import './bootstrap';
import { createApp } from 'vue';
import { createPinia } from 'pinia';
import router from "./router/index.js";
import {
    Menu,
    List, 
    Button, 
    message,
    Drawer
} from 'ant-design-vue';

import App from './App.vue';

import 'ant-design-vue/dist/antd.css'
import 'bootstrap/dist/css/bootstrap-grid.min.css';
import 'bootstrap/dist/css/bootstrap-utilities.min.css';
import './static/fontawesome/css/all.min.css';

const app = createApp(App);
app.use(createPinia());
app.use(Button).use(List).use(Menu);
app.use(Drawer);
app.use(router);
app.mount("#app");

app.config.globalProperties.$message = message;
