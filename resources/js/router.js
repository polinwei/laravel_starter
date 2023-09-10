import { createRouter, createWebHistory } from 'vue-router';

import MerchandiseList from './components/MerchandiseList.vue';
import MerchandiseForm from './components/MerchandiseForm.vue';
import Merchandise from './components/Merchandise.vue';

import ExampleComponent from './components/ExampleComponent.vue';
//app.component('example-component', ExampleComponent);

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/vueWelcome', component: MerchandiseList },
        { path: '/ExampleComponent', component: ExampleComponent },
        { path: '/merchandises/create', component: MerchandiseForm },
        { path: '/merchandises/:id', component: Merchandise },
        { path: '/merchandises/:id/edit', component: MerchandiseForm },
    ]
});

export default router