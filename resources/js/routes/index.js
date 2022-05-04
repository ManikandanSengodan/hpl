import VueRouter from 'vue-router';

import ExampleComponent from "../components/ExampleComponent";

let routes = [
    {
        path: '/buyers/list',
        component: ExampleComponent,
    }
];

const router = new VueRouter({
    base: '/',
    mode: 'history',
    routes,
    linkActiveClass: 'active'
});

export default router;
