import Vue from 'vue';

new Vue({
    delimiters: ['${', '}'],
    el: '#app',
    data: {
        lastName: null,
        firstName: null,
        nickName: null,
    }
})