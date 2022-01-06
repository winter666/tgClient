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
                component: () => import('../pages/MyBots/MyBotsIndex')
            },
            {
                path: 'bot/new',
                component: () => import('../pages/MyBots/MyBotsNew')
            },
            {
                path: 'bot/:id/settings',
                component: () => import('../pages/MyBots/MyBotsEdit')
            },
            {
                path: 'prizes',
                component: () => import('../pages/Prizes/Prizes')
            },
            {
                path: 'settings',
                component: () => import('../pages/Settings/Settings')
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
