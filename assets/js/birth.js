import Vue from 'vue';
import Datepicker from 'vuejs-datepicker';
let birthPlace = $('#birth_birthPlace').prop("defaultValue");
let birthDate = $('[name="uniquename"]').prop("value");

// var state = {
//     date: new Date(2016, 9,  16)
// }

new Vue({
    delimiters: ['${', '}'],
    el: '#app',
    data: {
        birthPlace: birthPlace,
        birthDate: birthDate,
    },
    components: {
        Datepicker
    }
});