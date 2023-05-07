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
        <title>Delete</title>
    </head>

    <body>

    <nav><a href="index.php"><button>Back</button></a></nav>
    <div class="container-delete">
        <form class="delete" action="loadDelete.php" method="post">
            <h1>Delete Info</h1>
            <div class = "field">
            <label for="ToolName">AI: </label>
                <select name="ToolName" id="ToolName" required >
                        <option selected disabled>Select</option>
                        <?php
                            $xml = new DOMDocument('1.0');
                            $xml->load('AITools.xml');
                            $AIs = $xml->getElementsByTagName('AI');

                            foreach($AIs as $AI){
                                $title = $AI->getElementsByTagName('ToolName')->item(0)->nodeValue;
                                echo'<option>'. $title .'</option>';
                            }
                        ?>
                    </select>
            </div>

            <div class="createBtn">
                <button id = "delete" name="delete" type="button">Delete</button>
            </div>
            
        </form>
    </div>



    </body>

</html> 
<script>
    $(document).ready(function(){
    $(document).on('click', '#delete',function(){
        Swal.fire({
            title: 'Are you sure you want to Delete this?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Delete'
              })
              .then ((remove)=>{
                if (remove.isConfirmed){
                    window.location.href = "loadDelete.php" 
                }
              })

    })
    });

    // get input field
    var toolNameInput = $('form.delete #ToolName');

    // disable button initially
    $('#delete').attr('disabled', true);

    // add event listener to input field
    toolNameInput.on('input keyup blur change', function() {
        if ($(this).val() === '') {
            $('#delete').attr('disabled', true);
            // add styles to indicate disabled state, e.g. lower opacity and remove hover effects
            //$('#delete').css({'opacity': '0.5', 'cursor': 'default', 'pointer-events': 'none', 'background-color': '#ccc', 'border-color': '#ccc'});
        } else {
            $('#delete').attr('disabled', false);
            // restore button styles
            //$('#delete').css({'opacity': '1', 'cursor': 'pointer', 'pointer-events': 'auto', 'background-color': '#d33', 'border-color': '#d33'});
        }
    });
    

     


</script>