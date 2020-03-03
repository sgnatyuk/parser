import Vue from 'vue'
import App from './App.vue'

import vuetify from './plugins/vuetify'
import router from './plugins/router'
import axios from './plugins/axios'

import Echo from 'laravel-echo'

window.io = require('socket.io-client')

window.Echo = new Echo({
  broadcaster: 'socket.io',
  host: window.location.hostname + ':6001',
})

Vue.config.productionTip = false
Vue.prototype.$http = axios

new Vue({
  data: {
    loading: false
  },
  vuetify,
  router,
  render: h => h(App),
}).$mount('#app')
