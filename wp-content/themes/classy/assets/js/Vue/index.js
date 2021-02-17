window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Vue from 'vue';
import App from './App.vue'

const initVueInstances = () => {
    console.log('initVueInstances')
    
    if($('#app').length > 0) {
        new Vue({
            render: h => h(App)
        }).$mount('#app');
    }
}

export default initVueInstances;
