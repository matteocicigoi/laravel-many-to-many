import './bootstrap';

import '~resources/scss/app.scss'
import * as bootstrap from 'bootstrap'
import.meta.glob([
    '../img/**'
]);

//img 
const buttonDeleteImg = document.getElementById('delete-img-button');
const checkboxDelete = document.getElementById('delete-img');
let deleteImg = false;
buttonDeleteImg.addEventListener('click', () => {
    deleteImg  = !deleteImg;
    checkboxDelete.checked = deleteImg;
    if(deleteImg === true){
        divPreview.classList.add('d-none');
    }else{
        divPreview.classList.remove('d-none');
    }
});

// preview image form
const imageUpload = document.getElementById('image-upload');
const imagePreview = document.getElementById('img-preview');
const divPreview = document.getElementById('div-preview');
imageUpload.addEventListener('change', (event) => {
    if(event.target.files[0] !== undefined){
        imagePreview.src = URL.createObjectURL(event.target.files[0]);
        divPreview.classList.remove('d-none');
    }else{
        imagePreview.src = '';
        divPreview.classList.add('d-none');
    }
});