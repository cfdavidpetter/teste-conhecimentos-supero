import Vue from 'vue'
import App from './App.vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueSweetalert2 from 'vue-sweetalert2'

Vue.use(VueAxios, axios)
Vue.use(VueSweetalert2)

new Vue({
    el: '#app',
    render: h => h(App)
})
