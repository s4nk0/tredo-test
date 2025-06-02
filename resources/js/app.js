import './bootstrap';
// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
import { getMessaging, getToken, onMessage  } from "firebase/messaging";
// Если должен быть найден один элемент
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional

document.addEventListener('DOMContentLoaded', function(){ // Аналог $(document).ready(function(){

    const firebaseConfig = {
        apiKey: "AIzaSyAI4I77MQorZhRKaWxcShxwlvoEh1voFPw",
        authDomain: "tredo-test-7d015.firebaseapp.com",
        projectId: "tredo-test-7d015",
        storageBucket: "tredo-test-7d015.firebasestorage.app",
        messagingSenderId: "560017540118",
        appId: "1:560017540118:web:00ee5d0560ebf205aaa137",
        measurementId: "G-Z5RW16BBTJ"
    };

// Initialize Firebase
    const app = initializeApp(firebaseConfig);
    const analytics = getAnalytics(app);
// Initialize Firebase Cloud Messaging and get a reference to the service
    const messaging = getMessaging(app);

    function requestPermission() {
        console.log('Requesting permission...');
        Notification.requestPermission().then((permission) => {
            if (permission === 'granted') {

                console.log('Notification permission granted.');
                getToken(messaging, {vapidKey: "BG7bpfXcVnfpGyEHZGSWOAPAcFpsfuYQ185a5cTj-REZmry3_UvMOQuMWBlnvL8PNYQrXVMq5lZTgbEM1nG0tb0"}).then((currentToken) => {
                    if (currentToken) {
                        // Send the token to your server and update the UI if necessary
                        console.log(currentToken);
                    } else {
                        // Show permission request UI
                        console.log('No registration token available. Request permission to generate one.');
                        // ...
                    }
                }).catch((err) => {
                    console.log('An error occurred while retrieving token. ', err);
                    // ...
                });
            }
        })
    }


    requestPermission();

    onMessage(messaging, (payload) => {
        console.log('Message received. ', payload);
        // ...
    });
});


