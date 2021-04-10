require('./bootstrap');
import Vue from 'vue'
import common from './common'
Vue.mixin(common)

Vue.component('search', require('./components/search.vue').default)
Vue.component('comment', require('./components/comment.vue').default)
Vue.component('writecomment', require('./components/writecomment.vue').default)
const app = new Vue({
    el: '#app',
})
