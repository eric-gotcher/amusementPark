// Importing the Firebase SDK modules
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
import { getAuth, createUserWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js";

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

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);

// Get submit button and add event listener
const submit = document.getElementById("submit");
submit.addEventListener("click", function (event) {
    event.preventDefault(); // Prevent form submission

    // Get email and password values
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    // Input validation
    if (email.trim() === "" || password.trim() === "") {
        alert("Email and password cannot be empty");
        return;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("Invalid email format");
        return;
    }

    if (password.length < 6) {
        alert("Password must be at least 6 characters long");
        return;
    }

    // Create user with email and password using Firebase Authentication
    createUserWithEmailAndPassword(auth, email, password)
        .then((userCredential) => {
            // Account created successfully
            const user = userCredential.user;
            alert("Account created successfully. Redirecting...");
            window.location.href = "home.html";  // Adjust to your desired page after account creation
        })
        .catch((error) => {
            const errorCode = error.code;
            const errorMessage = error.message;
            alert("Error: " + errorMessage);
        });
});
