import './bootstrap';
import Swal from 'sweetalert2';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
window.Swal = Swal;
Alpine.start();

// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyDZCaFaQjIonPFEMgfjx7GY7uL66tIlsRc",
    authDomain: "laravel-e1239.firebaseapp.com",
    projectId: "laravel-e1239",
    storageBucket: "laravel-e1239.appspot.com",
    messagingSenderId: "1081460703380",
    appId: "1:1081460703380:web:ad573fd44c333082a43481",
    measurementId: "G-R673XQJTD8"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
