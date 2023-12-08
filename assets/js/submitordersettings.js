// check if input dont have value =============================================
// form submission =========================================

// input who are obliged to fill 
var locationMapDiv = document.getElementById("location-map-div");
function checkForm() {
    // List of input field IDs
    if(locationMapDiv.style.display === 'none'){
      var inputFields = ['company-name' , 'company-number' , 'location-text'];
    }else{
      var inputFields = ['store-type', 'company-name', 'company-number', 'location-text', 'location-map', 'store-receiver-name', 'store-receiver-number'];
    }
        

        // Check each input field for empty values
        for (var i = 0; i < inputFields.length; i++) {
            var fieldId = inputFields[i];
            var fieldValue = document.getElementById(fieldId).value;

            if (fieldValue.trim() === '') {
                // alert('The field ' + fieldId + ' is required.');
                alert('يرجى تعبئة جميع المعلومات  ! ');
                return false; // Stop form submission
            }
        }
        // preveting multi submitting 

            // Get the form and the submit button
            var submitBtn = document.getElementById('submitBtn');
            // Add a click event listener to the submit button
                // Disable the submit button to prevent multiple submissions
                submitBtn.style.pointerEvents = "none";
                submitBtn.style.opacity = "0.6";
                submitBtn.style.cursor = "not-allowed";
                submitBtn.innerText = "يرجى الانتظار  ...";
        
            
        return true; // Allow form submission
}