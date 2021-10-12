require('./bootstrap');

require('alpinejs');

import Vue from 'vue';

Vue.component("Hello", require('./components/Hello').default);
import Hello from './components/Hello.vue';

const app = new Vue({
    el: '#app',
    components: {
        Hello
    }
});
