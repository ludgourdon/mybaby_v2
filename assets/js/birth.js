import Vue from 'vue';
import Datepicker from 'vuejs-datepicker';
let birthPlace = $('#birth_birthPlace').prop("defaultValue");
let birthDate = $('[name="birthDate"]').prop("formattedValue");

var state = {
    date: new Date()
}

const months = [
    'Janvier',
    'Février',
    'Mars',
    'Avril',
    'Mai',
    'Juin',
    'Juillet',
    'Août',
    'Septembre',
    'Octobre',
    'Novembre',
    'Decembre'
]

new Vue({
    delimiters: ['${', '}'],
    el: '#app',
    data: {
        birthPlace: birthPlace,
        birthDate: state.date,
        months:months,
    },
    components: {
        Datepicker
    }
});