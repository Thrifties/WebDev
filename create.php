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
    <title>Create Page</title>
</head>
<body>
    <nav><a href="index.php" id="backBtn"><button>Back</button></a></nav>
    <form class="container-create" method="post" action="loadCreate.php">
        <h1>Add AI</h1>
        <div class="field">
            <label>AI Tool:</label>
            <input name="AITool" id="AITool" type="text" style="text-transform: capitalize;" required>
        </div>
        <div class="field">
            <label>Developer:</label>
            <input name="Developer" id="Developer" type="text" style="text-transform: capitalize;" required>
        </div>
        <div class="field">
            <label for="ReleaseDate">Release Date:</label>
            <input name="ReleaseDate" id="ReleaseDate" type="text" required>
        </div>
        <div class="field">
            <label for="Category">Category:</label>
            <input name="Category" id="Category" type="text" style="text-transform: capitalize;" required>
        </div>
        <div class="field">
            <label for="SubscriptionType">Subscription Type:</label>
            <select name="SubscriptionType" id="SubscriptionType" class="custom-select" required> 
                <option selected disabled>Select...</option>
                <option value="Free">Free</option>
                <option value="Paid">Paid</option>
                <option value="Freemium">Freemium</option>
            </select>
        </div>
        <div class="field">
            <label for="Description">Description:</label>
            <input name="Description" id="Description" type="text" required>
        </div>
        <div class="field">
                <label for="Image">Image:</label>
                <br>
                        
                        <br>
                        <label for="Image">Choose Photo</label>
                        <input type="file" id="Image" style="display: none;" name="Image" onchange="PreviewImage()" required>
        </div>
        <img src="" alt="" id="uploadPreview">
        <div class="createBtn">
            <button name="submit" type="submit" id="addBtn">Add</button>
        </div>
            
    </form>

    <script>

        $(document).ready(function(){


            $("#AITool").blur(function(){

                var toolNameInput = document.getElementById("AITool");
                var toolNameValue = toolNameInput.value.toLowerCase();

                var xml = new XMLHttpRequest();
                xml.open("GET", "AITools.xml", false);
                xml.send();
                var xmlDoc = xml.responseXML;
                var tools = xmlDoc.getElementsByTagName("AI");
                

                for (var i = 0; i < tools.length; i++) {
                    var toolName = tools[i].getElementsByTagName("ToolName")[0].childNodes[0].nodeValue.toLowerCase();
                    console.log(tools.length);
                    console.log(toolName);
                    if (toolName === toolNameValue) {
                        Swal.fire({
                            title: "Invalid Tool Name",
                            icon: "error",
                            text: "The AI Tool name already exists!",
                            showConfirmButton: false,
                            timer: 2000,
                        });
                        $(this).val("");
                        return false;
                    }
                }           
            });     

        })

        function PreviewImage() {
        var pic = new FileReader();
        pic.readAsDataURL(document.getElementById("Image").files[0]);
        pic.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
        };

        // get all input fields
        var inputs = $('form.create :input');

        // disable button initially
        $('button[type="submit"]').attr('disabled', true);

        // add event listeners to input fields
        inputs.on('input keyup blur change', function() {
        var empty = false;
        inputs.each(function() {
            if ($(this).prop('required') && $(this).val() === '') {
            empty = true;
            return false;
            }
            if ($(this).prop('type') === 'file' && $(this).prop('files').length === 0) {
            empty = true;
            return false;
            }
        });
        if (empty) {
            $('button[type="submit"]').attr('disabled', true);
            //dito ilalagay yung pagdisable nung effects nung button bale need din pag empty pa yung fields is disabled din hover effects and mas babaan siguro opacity
        } else {
            $('button[type="submit"]').attr('disabled', false);
        }
        });

    </script>
</body>
</html>