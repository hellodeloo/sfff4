import Vue from 'vue';
import VueRouter from 'vue-router';

import StepVue00 from '../components/StepVue00'
import StepVue01 from '../components/StepVue01'
import StepVue02 from '../components/StepVue02'
import StepVue03 from '../components/StepVue03'

Vue.use(VueRouter);

export default new VueRouter({
  mode: 'history',
  routes: [
    {
      name: 'StepVue00',
      path: '/v',
      component: StepVue00
    },
    {
      name: 'StepVue01',
      path: '/v01',
      component: StepVue01
    },
    {
      name: 'StepVue02',
      path: '/v02',
      component: StepVue02
    },
    {
      name: 'StepVue03',
      path: '/v03',
      component: StepVue03
    },
    {
      name: 'Anything',
      path: '*',
      redirect: '/v'
    }
  ],
});
