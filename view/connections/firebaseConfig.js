// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyD9qour5Yqk8eoHH-qrRpNF1ewn1H6ePPo",
  authDomain: "makeatry-fbf4c.firebaseapp.com",
  databaseURL: "https://makeatry-fbf4c-default-rtdb.asia-southeast1.firebasedatabase.app",
  projectId: "makeatry-fbf4c",
  storageBucket: "makeatry-fbf4c.appspot.com",
  messagingSenderId: "295510457334",
  appId: "1:295510457334:web:d3c0fd4db79857f3a5a5d7",
  measurementId: "G-B7VKBGGGB3"
};
// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);