<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS\style2.CSS">
    <script src="jquery-3.3.1.min.js"></script>
	<script src="jquery-ui.min.js"></script>
	<script src="sweetalert.min.js"></script>
    <title>Update Page</title>
</head>
<body>

<nav><a href="index.php"><button>Back</button></a></nav>

<div class="container-update">
    <form class="create" method="post" action="loadUpdate.php">
        <h1>Update Info</h1>
            <div class="field">
                
                <label>AI Tool:</label>
                <select name="AITool" id="AITool" onchange="Display(this.value)" required>
                    <option selected disabled>Select</option>
                    <?php
                    $xml = new DOMDocument('1.0');
                    $xml->load('AITools.xml');
                    $AIs = $xml->getElementsByTagName('AI');

                    foreach ($AIs as $AI) {
                        $title = $AI->getElementsByTagName('ToolName')->item(0)->nodeValue;
                        echo '<option>' . $title . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div id="toolData">
                <div class="field">
                    <label>Developer:</label>
                    <input name="Developer" id="Developer" type="text" required>
                </div>
                <div class="field">
                    <label for="ReleaseDate">Release Date:</label>
                    <input name="ReleaseDate" id="ReleaseDate" type="text" required>
                </div>
                <div class="field">
                    <label for="Category">Category:</label>
                    <input name="Category" id="Category" type="text" required>
                </div>
                <div class="field">
                    <label for="SubscriptionType">Subscription Type:</label>
                    <select name="SubscriptionType" id="SubscriptionType" required>
                        <option selected disabled>Select</option>
                        <option value="Free">Free</option>
                        <option value="Paid">Paid</option>
                        <option value="Freemium">Freemium</option>
                    </select>
                </div>
                <div class="field">
                    <label for="Description">Description:</label>
                    <input name="Description" id="Description" type="text" required>
                </div>
                <div class='field' id='imageContainer'>

                <input type='file' id='Image' name='Image' style='display: none;' onchange='PreviewImage()'>
                
            </div>
            </div> 
            <div class="createBtn">
            <button id= "update" name="update" type="submit" action="loadUpdate.php">Update</button>
            </div>
        </div>
        
            
            
    </form>
 </div>
</body>
</html>

<script>
    //the purpose of Display function is to display the corresponding data in the input fields
    function Display(selected) {
        http = new XMLHttpRequest();
        http.onreadystatechange = function () {
            if (http.readyState == 4 && http.status == 200) {
                document.getElementById("toolData").innerHTML = this.responseText;
            }
        };
        http.open("GET", "displayData.php?name=" + selected, true);
        http.send();


        
    }

    $(document).ready(function(){
        $(document).on('click', '#update',function(e){
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure you want to Save this changes?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Update'
            })
            .then(async (update) => {
                if (update.isConfirmed) {
                    await new Promise(resolve => setTimeout(resolve, 1000));
                    window.location.href = "loadUpdate.php";
                }
            });
        });
    });


        function PreviewImage() {
        var pic = new FileReader();
        pic.readAsDataURL(document.getElementById("Image").files[0]);
        pic.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
        };
</script>