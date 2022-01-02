import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const routes = [
    {
        name: 'home',
        path: '/home',
        component: () => import('../layouts/Home/Home'),
        children: [
            {
                path: '/',
                component: () => import('../components/ExampleComponent')
            },
            {
                path: 'my-bots',
                component: () => import('../components/ExampleComponent')
            },
            {
                path: 'my-bots/new',
                component: () => import('../components/ExampleComponent')
            },
            {
                path: 'my-bots/:id/settings',
                component: () => import('../components/ExampleComponent')
            },
            {
                path: 'prizes',
                component: () => import('../components/ExampleComponent')
            },
            {
                path: 'settings',
                component: () => import('../components/ExampleComponent')
            }
        ]
    },
    {
        name: 'not-found',
        path: '*',
        component: () => import('../components/NotFound')
    }
];

export default new VueRouter({mode: 'history', routes});
