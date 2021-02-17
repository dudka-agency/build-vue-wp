window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Vue from 'vue';
import App from './App.vue'
import store from './store/index'

const initVueInstances = () => {
    console.log('initVueInstances')
    
    if($('#app').length > 0) {
        new Vue({
            store,
            render: h => h(App)
        }).$mount('#app');
    }
}

export default initVueInstances;
