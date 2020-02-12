import Vue from 'vue';
import VueTimepicker from 'vue2-timepicker';
import 'vue2-timepicker/dist/VueTimepicker.css';
import html2canvas from "html2canvas";
require("vue2-timepicker/dist/VueTimepicker.css");

let birthPlace = $('#birth_birthPlace').prop("defaultValue");
let birthDate = $('[name="birth[birthDate]"]').prop("defaultValue");
let birthHour =  $('[name="birth[birthHour]"]').prop("defaultValue");
let birthHeight =  $('[name="birth[birthHeight]"]').prop("defaultValue");
let birthWeight =  $('[name="birth[birthWeight]"]').prop("defaultValue");
let eyeColor =  $('[name="birth[eyeColor]"]').prop("defaultValue");

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
        birthWeight: birthWeight,
        eyeColor: eyeColor,
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
    methods: {
        alert: function () {
            generateImage();
        }
    },
    components: {
        VueTimepicker,
    }
});

$(".datepicker-form input").addClass("form-control");

function generateImage(){
     html2canvas(document.querySelector(".card")).then(canvas => {
             // a.href = canvas.toDataURL("image/jpeg").replace("image/jpeg", "image/octet-stream");
             let imgData = canvas.toDataURL('image/jpeg');
             let url = window.location.pathname;
             console.log(url);
             let data = {};
             data['base64data'] = imgData;
                $(":input").serializeArray().forEach((object) => {
                 data[object.name] = object.value;
             });
             $.ajax({
                 type: "POST",
                 url: url,
                 dataType: 'text',
                 data: data
             });
         })
}