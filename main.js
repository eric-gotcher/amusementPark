// Importing the functions needed from the SDKs 
import { initializeApp } from "https://www.gstatic.com/firebasejs/11.0.0/firebase-app.js";
import { getAuth, signInWithEmailAndPassword, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/11.0.0/firebase-auth.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/11.0.0/firebase-analytics.js";

// Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyBn7xE-jaEuixzyDROnbHrQo6-YtOR5LaU",
  authDomain: "amusement-park-4039d.firebaseapp.com",
  projectId: "amusement-park-4039d",
  storageBucket: "amusement-park-4039d.appspot.com",
  messagingSenderId: "625618396056",
  appId: "1:625618396056:web:ff2907be3a1958ed9041ed",
  measurementId: "G-6QHBHT0PPE"
};
// Initializing the Firebase
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const analytics = getAnalytics(app);
