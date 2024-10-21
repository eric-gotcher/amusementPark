// Initializing Firebase
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
firebase.initializeApp(firebaseConfig);
const auth = firebase.auth();
const analytics = firebase.analytics();

// Function to handle login with email and password
function loginWithEmailPassword() {
  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;

  auth.signInWithEmailAndPassword(email, password)
    .then((userCredential) => {
      // Successfully signed in
      const user = userCredential.user;
      console.log('User logged in:', user);

      // Redirect to home page after successful login
      window.location.href = 'home.html';
    })
    .catch((error) => {
      console.error('Error during login:', error);
      alert('Login failed: ' + error.message); // Notify user of login failure
    });
}

// Optionally, monitor authentication state
auth.onAuthStateChanged((user) => {
  if (user) {
    console.log('User is authenticated:', user);
    
  } else {
    console.log('User is not authenticated');
  }
});
