//==================getting location======================
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

function showPosition(position) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;

    // Display the location on the page

    // Construct Google Maps link
    var googleMapsLink = "https://www.google.com/maps?q=" + latitude + "," + longitude;

    // Set the Google Maps link as the value of the input with id "location-map"
    var locationMapInput = document.getElementById("location-map");
    locationMapInput.value = googleMapsLink;

   
}

function showError(error) {
    // Handle errors as needed
    console.error(error.message);
}


//=================================================================

// hiding inputs if user select فردي  =============================
document.getElementById('store-categorie').addEventListener('change', function() {
    var selectedOption = this.value;
  
    // Get all items
    var items = document.querySelectorAll('.other-hide');
    var cusName = document.getElementById('company-name');
    var cusNumber = document.getElementById('company-number');
    var locationBtn = document.getElementById('location-btn'); 
    
    
    
    
    if (selectedOption === 'فردي'){
      cusName.placeholder = 'أسم الزبون :';
      cusNumber.placeholder = 'رقم الزبون :';
      locationBtn.style.display="none";
      
        
    }else{
      cusName.placeholder = 'أسم المؤسسة :';
      cusNumber.placeholder = 'رقم المؤسسة :';
      locationBtn.style.display="block";
      
    }
    // Loop through each item and toggle visibility based on the selected option
    items.forEach(function(item) {
      if (selectedOption === 'فردي') {
        item.style.display = 'none'; // Show the item
        
      } else {
        item.style.display = 'grid'; // Hide the item
      }
    });
  });


//==================================================================

// show total price =========================================================
function updateTotal() {
    // Get the values entered by the user
    var bagCount = document.getElementById('spoon-bag-count').value;
    var boxCount = document.getElementById('spoon-box-count').value;

    // Define the prices
    var bagPrice = 6.25;
    var boxPrice = 15.5;

    // Calculate the total cost
    var totalCost = Math.abs(bagCount * bagPrice) + Math.abs(boxCount * boxPrice);

    // Display the total on the page
    document.getElementById('total-cost').textContent = 'السعر الاجمالي : ' + totalCost.toFixed(2) + "$";
  }

//===============================================================================


//==============random number =================
function generateRandomNumber() {
    const min = 1000000;
    const max = 9999999999999999;
    return Math.floor(Math.random() * (max - min + 1) + min);
}

const randomNumber = generateRandomNumber();
const randomInput = document.getElementById("order-id");
randomInput.value = randomNumber;


//==================================================================================

  
