document.addEventListener('DOMContentLoaded', () => {
    // Handle the filter button click event
    const filterBtn = document.getElementById('filterBtn');
    const preferencesModal = document.createElement('div'); // Create the modal dynamically

    preferencesModal.classList.add('preferences-modal');
    preferencesModal.innerHTML = `
        <div class="preferences-modal-content">
            

            <h2>Filter Preferences</h2>
            <label>
                <input type="checkbox" id="wheelchairCheckbox"> Wheelchair Accessible
            </label><br>
            <label>
                <input type="checkbox" id="serviceAnimalCheckbox"> Service Animal Friendly
            </label><br>
            <label>
                <input type="checkbox" id="blankCheckbox"> Show _____
            </label><br>
            <label>
                <input type="checkbox" id="inaccessibleCheckbox"> Inaccessible Ride
            </label><br>
            <button id="applyFiltersBtn">Apply Filters</button>
            <button id="closeModalBtn">Close</button>
        </div>
    `;

    // Append modal to body
    document.body.appendChild(preferencesModal);

    // Show the modal when filter button is clicked
    filterBtn.addEventListener('click', () => {
        preferencesModal.style.display = 'flex';
    });

    

    // Close the modal when the "Close" button is clicked
    document.getElementById('closeModalBtn').addEventListener('click', () => {
        preferencesModal.style.display = 'none';
    });

    // Handle the filter logic when Apply Filters is clicked
    document.getElementById('applyFiltersBtn').addEventListener('click', () => {
        const wheelchairChecked = document.getElementById('wheelchairCheckbox').checked;
        const serviceAnimalChecked = document.getElementById('serviceAnimalCheckbox').checked;
        const blankChecked = document.getElementById('blankCheckbox').checked;
        const inaccessibleChecked = document.getElementById('inaccessibleCheckbox').checked;

        console.log('Wheelchair:', wheelchairChecked);
        console.log('Service Animal:', serviceAnimalChecked);
        console.log('Short Wait:', blankChecked);
        console.log('Inaccessible:', inaccessibleChecked);

        // Get all the ride containers
        const rideContainers = document.querySelectorAll('.ride-container');

        // Loop through each ride and check if it matches the selected preferences
        rideContainers.forEach(ride => {
            // Extract data attributes from the ride container
            const hasWheelchair = ride.getAttribute('data-wheelchair') === 'true';
            const hasServiceAnimal = ride.getAttribute('data-serviceAnimal') === 'true';
            const hasBlank = ride.getAttribute('data-blank') === 'true';
            const hasInaccessible = ride.getAttribute('data-inaccessible') === 'true';

            // Check if the ride matches the selected filters
            const matchesFilter = 
                (!wheelchairChecked || hasWheelchair) &&
                (!serviceAnimalChecked || hasServiceAnimal) &&
                (!blankChecked || hasBlank) &&
                (!inaccessibleChecked || hasInaccessible);

            // Show or hide the ride container based on the match
            if (matchesFilter) {
                ride.style.display = 'flex';  // Show the ride
            } else {
                ride.style.display = 'none';  // Hide the ride
            }
        });

        // Close the modal after applying the filter
        preferencesModal.style.display = 'none';
    });

    // Loop through each ride container and extract accessibility data
    const rideContainers = document.querySelectorAll('.ride-container');
    rideContainers.forEach((ride) => {
        // Grab the data-* attributes
        const wheelchair = ride.getAttribute('data-wheelchair');
        const serviceAnimal = ride.getAttribute('data-serviceAnimal');
        const blank = ride.getAttribute('data-blank');
        const inaccessible = ride.getAttribute('data-inaccessible');

        // Find the span where the accessibility data will be injected
        const accessibilityData = ride.querySelector('.accessibility-data');
        
        // Create an array to hold the accessibility features
        let accessibilityText = [];

        // Check each attribute and add the appropriate text
        if (wheelchair === 'true') {
            accessibilityText.push("Wheelchair Accessible");
        }
        if (serviceAnimal === 'true') {
            accessibilityText.push("Service Animal Allowed");
        }
        if (blank === 'true') {
            accessibilityText.push("Show _____");
        }
        if (inaccessible === 'true') {
            accessibilityText.push("Inaccessible");
        }

        // Join the text array into a single string and insert it into the span
        accessibilityData.textContent = accessibilityText.join(', ') || "No accessibility information available";
    });

    // Handle the sort button click event
    const sortBtn = document.getElementById('sortBtn');
    const sortModal = document.createElement('div'); // Create the modal dynamically
    sortModal.classList.add('sort-modal');
    sortModal.innerHTML = `
        <div class="sort-modal-content">
            <h2>Sort Preferences</h2>
            <div class="sort-options">
                <label>
                    <input type="radio" name="sortOption" id="sortByName" checked> Sort by Name
                </label><br>
                <label>
                    <input type="radio" name="sortOption" id="sortByHeight"> Sort by Minimum Height
                </label><br>
                <label>
                    <input type="radio" name="sortOption" id="sortByDuration"> Sort by Duration
                </label><br>
            </div>
            <div class="sort-order">
                <label>
                    <input type="radio" name="sortOrder" id="sortAsc" checked> Ascending (A-Z)
                </label><br>
                <label>
                    <input type="radio" name="sortOrder" id="sortDesc"> Descending (Z-A)
                </label><br>
            </div>
            <button id="applySortBtn">Apply Sort</button>
            <button id="closeSortModalBtn">Close</button>
        </div>
    `;
    document.body.appendChild(sortModal);

    // Show the modal when sort button is clicked
    sortBtn.addEventListener('click', () => {
        sortModal.style.display = 'flex';
    });

    // Close the modal when the "Close" button is clicked
    document.getElementById('closeSortModalBtn').addEventListener('click', () => {
        sortModal.style.display = 'none';
    });

    // Handle the sort logic when Apply Sort is clicked
    document.getElementById('applySortBtn').addEventListener('click', () => {
        const sortByName = document.getElementById('sortByName').checked;
        const sortByHeight = document.getElementById('sortByHeight').checked;
        const sortByDuration = document.getElementById('sortByDuration').checked;
        const sortAsc = document.getElementById('sortAsc').checked;  // Ascending order
        const sortDesc = document.getElementById('sortDesc').checked; // Descending order

        const rideArray = Array.from(rideContainers);
        let sortOrder = sortAsc ? 1 : -1; // 1 for ascending, -1 for descending

        if (sortByName) {
            rideArray.sort((a, b) => {
                const nameA = a.querySelector('h2').textContent.toLowerCase();
                const nameB = b.querySelector('h2').textContent.toLowerCase();
                return nameA.localeCompare(nameB) * sortOrder;  // Apply sort order
            });
        } else if (sortByHeight) {
            rideArray.sort((a, b) => {
                const heightA = parseInt(a.getAttribute('data-minHeight'));
                const heightB = parseInt(b.getAttribute('data-minHeight'));
                return (heightA - heightB) * sortOrder;  // Apply sort order
            });
        } else if (sortByDuration) {
            rideArray.sort((a, b) => {
                const durationA = parseInt(a.getAttribute('data-duration'));
                const durationB = parseInt(b.getAttribute('data-duration'));
                return (durationA - durationB) * sortOrder;  // Apply sort order
            });
        }

        // Append the sorted rides back to the container
        const ridesContainer = document.querySelector('.rides-container');
        rideArray.forEach(ride => {
            ridesContainer.appendChild(ride);
        });

        // Close the sort modal
        sortModal.style.display = 'none';
    });
});