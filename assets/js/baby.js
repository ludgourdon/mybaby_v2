import Vue from 'vue';
let firstName = $('#baby_firstName').prop("defaultValue");
let lastName = $('#baby_lastName').prop("defaultValue");
new Vue({
    delimiters: ['${', '}'],
    el: '#app',
    data: {
        lastName: lastName,
        firstName: firstName,
        nickName: null,
    }
});