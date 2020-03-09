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
    window.scrollTo(0,0);
    html2canvas(document.querySelector("#babyCard"),{width:600, height:800}).then(canvas => {
        let imgData = canvas.toDataURL('image/jpeg');
        $('[name="birth[imgData]"]').val(imgData);
        // let data = {};
        // data['base64data'] = imgData;
        // $(":input").serializeArray().forEach((object) => {
        //  data[object.name] = object.value;
        // });
        //
        // $.ajax({
        //     type: "POST",
        //     url: window.location.pathname,
        //     dataType: 'json',
        //     data: data,
        //     success: function(data) {
        //         window.location = '/baby/'+data["babyId"]+'/share?file='+data['filePath'];
        //     }
        // });

        $('[name="birth"]').submit();
    });
    // window.scrollTo(0,0);
    // html2canvas(document.querySelector("#babyCard"), {width:600, height:800, scrollX:0, scrollY:0}).then(canvas => {
    //     document.body.appendChild(canvas)
    // });

}