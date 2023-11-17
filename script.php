
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<script type="text/javascript">
    function submitData(action){
        $(document).ready(function(){
            var storecategorie = $("#store-categorie").val();
            var storetype = $("#store-type").val();
            var companyname = $("#company-name").val();
            var companynumber = $("#company-number").val();
            var storelocationgovernorate = $("#store-location-governorate").val();
            var locationtext = $("#location-text").val();
            var locationmap = $("#location-map").val();
            var storereceivername = $("#store-receiver-name").val();
            var storereceivernumber = $("#store-receiver-number").val();
            var note = $("#note").val();
            var representative = $("#representative").val();
            var status = $("#status").val();
            var spoonboxcount = $("#spoon-box-count").val();
            var spoonbagcount = $("#spoon-bag-count").val();
          
            var data ={
                action: action,
                storecategorie : $("#store-categorie").val(),
                storetype : $("#store-type").val(),
                companyname : $("#company-name").val(),
                companynumber : $("#company-number").val(),
                storelocationgovernorate : $("#store-location-governorate").val(),
                locationtext : $("#location-text").val(),
                locationmap : $("#location-map").val(),
                storereceivername : $("#store-receiver-name").val(),
                storereceivernumber : $("#store-receiver-number").val(),
                note : $("#note").val(),
                representative : $("#representative").val(),
                status : $("#status").val(),
                spoonboxcount : $("#spoon-box-count").val(),
                spoonbagcount : $("#spoon-bag-count").val(),
            };
            
            $.ajax({
                url: 'functions.php',
                type: 'post',
                data: data,
                success:function(response){

                    alert(response);
                    window.location.href = "welcome.php"; // redirect to home.php
                }
            })
        })
    }

</script>