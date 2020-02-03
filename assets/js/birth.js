import Vue from 'vue';
import VueTimepicker from 'vue2-timepicker';
import 'vue2-timepicker/dist/VueTimepicker.css';
require("vue2-timepicker/dist/VueTimepicker.css");
let birthPlace = $('#birth_birthPlace').prop("defaultValue");
let birthDate = $('[name="birth[birthDate]"]').prop("defaultValue");
let birthHour =  $('[name="birth[birthHour]"]').prop("defaultValue");
let birthHeight =  $('[name="birth[birthHeight]"]').prop("defaultValue");

var state = {
    date: new Date()
};

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
];

new Vue({
    delimiters: ['${', '}'],
    el: '#app',
    data: {
        birthPlace: birthPlace,
        birthDate: birthDate,
        birthHour: birthHour,
        birthHeight: birthHeight,
        returnDate: function(datevar) {
            if (datevar === undefined || datevar.length === 0) {
                return '';
            }
            var date = new Date(datevar);

            return date.getDate()+' '+months[date.getMonth()]+ ' '+date.getFullYear();
        },
        returnHour: function(timevar, birthDate=null) {
            if (timevar === undefined || timevar.length === 0) {
                return '';
            }

            return timevar;
        }
    },
    components: {
        VueTimepicker,
    }
});

$(".datepicker-form input").addClass("form-control");