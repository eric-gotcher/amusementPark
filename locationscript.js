// Firebase configuration and initialization (replace with your actual configuration)
const firebaseConfig = {
    apiKey: "AIzaSyBn7xE-jaEuixzyDROnbHrQo6-YtOR5LaU",
    authDomain: "amusement-park-4039d.firebaseapp.com",
    projectId: "amusement-park-4039d",
    storageBucket: "amusement-park-4039d.firebasestorage.app",
    messagingSenderId: "625618396056",
    appId: "1:625618396056:web:ff2907be3a1958ed9041ed",
    measurementId: "G-6QHBHT0PPE"
};

const app = firebase.initializeApp(firebaseConfig);
const db = firebase.firestore(app);

// Array of marker data
const markersData = [
    { lat: 32.75694774660049, lng: -97.06858634954958, title: 'Aquaman', category: 'A' },
    { lat: 32.75867956518985, lng: -97.0665944558818, title: 'Batman', category: 'B' },
    { lat: 32.757562316535875, lng: -97.067054891455, title: 'Batwing', category: 'C' },
    { lat: 32.75775980664769, lng: -97.06749839143542, title: 'Boomtown', category: 'A' },
    { lat: 32.757154197253314, lng: -97.0720959368577, title: 'Boot Scootin', category: 'B' },
    { lat: 32.75637875518429, lng: -97.06841704130149, title: 'Bugs Cloud Bouncer', category: 'C' },
    { lat: 32.75726920754156, lng: -97.06628719155061, title: 'Catwoman Whip', category: 'A' },
    { lat: 32.75687916891457, lng: -97.06778361202024, title: 'Cloud Bouncer', category: 'B' },
    { lat: 32.75912726546584, lng: -97.06800230384427, title: 'Bucket Blasters', category: 'C' },
    { lat: 32.755825529397704, lng: -97.07200652921023, title: 'El Diablo', category: 'A' },
    { lat: 32.755489433620255, lng: -97.0709131848416, title: 'Sombrero', category: 'B' },
    { lat: 32.75323847916851, lng: -97.06802371184325, title: 'Judge Roy Scream', category: 'C' },
    { lat: 32.757991473958874, lng: -97.0677503492011, title: 'Gunslinger', category: 'A' },
    { lat: 32.75731315275531, lng: -97.06689389616429, title: 'Justice League', category: 'B' },
    { lat: 32.755669332272035, lng: -97.07129106781014, title: 'Tea Cups', category: 'C' },
    { lat: 32.75548781011889, lng: -97.07155711109925, title: 'La Vibora', category: 'A' },
    { lat: 32.75784178390764, lng: -97.06661224784125, title: 'Mr. Freeze', category: 'B' },
    { lat: 32.758886637131965, lng: -97.07057433567623, title: 'Shock Wave', category: 'C' },
    { lat: 32.758384840744206, lng: -97.06868454595156, title: 'Superman', category: 'A' },
    { lat: 32.7570749439281, lng: -97.07255299151078, title: 'Texas Depot', category: 'B' },
    { lat: 32.75676784036096, lng: -97.0658927520594, title: 'Texas SkyScreamer', category: 'C' },
    { lat: 32.75685106292408, lng: -97.0652765520594, title: 'Riddler', category: 'A' },
    { lat: 32.7557677102804, lng: -97.07418512037097, title: 'Titan', category: 'B' }
];

// Function to add all markers to Firestore
function addMarkersToFirestore() {
    markersData.forEach(marker => {
        db.collection("locations").add(marker)
            .then(() => {
                console.log(`Marker for ${marker.title} added successfully!`);
            })
            .catch(error => {
                console.error("Error adding marker: ", error);
            });
    });
}

// Call the function to add markers
addMarkersToFirestore();
