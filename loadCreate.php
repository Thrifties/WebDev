<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS\style2.css">
    <script src="jquery-3.3.1.min.js"></script>
	<script src="jquery-ui.min.js"></script>
	<script src="sweetalert.min.js"></script>
    <title>Creating</title>
</head>
<body>
    <?php
        $xml = new DOMDocument('1.0');
        $xml->formatOutput = true;
        $xml->preserveWhiteSpace =false;
        $xml->load('AITools.xml');

        $AITool = $_POST['AITool'];
        $Developer = $_POST['Developer'];
        $ReleaseDate = $_POST['ReleaseDate'];
        $Category = $_POST['Category'];
        $SubscriptionType = $_POST['SubscriptionType'];
        $Description = $_POST['Description'];
        $Image = $_POST['Image'];

        $AI = $xml->createElement('AI');

        $ToolName = $xml->createElement('ToolName', $AITool);
        $Dev = $xml->createElement('Developer', $Developer);
        $Rel = $xml->createElement('ReleaseDate', $ReleaseDate);
        $Cat = $xml->createElement('Category', $Category);
        $Subs = $xml->createElement('SubscriptionType', $SubscriptionType);
        $Desc = $xml->createElement('Description', $Description);
        $Img = $xml->createElement('Image');
        $pic = file_get_contents("images/".$Image);
        $base64 = base64_encode($pic);
        $CData = $xml->createCDATASection($base64);
        $Img->appendChild($CData);

        $AI->appendChild($ToolName);
        $AI->appendChild($Dev);
        $AI->appendChild($Rel);
        $AI->appendChild($Cat);
        $AI->appendChild($Subs);
        $AI->appendChild($Desc);
        $AI->appendChild($Img);

        $xml->getElementsByTagName('AIs')->item(0)->appendChild($AI);
        $xml->save('AITools.xml');
    ?>
    
    <script> 
        Swal.fire({
            title: "You have successfully added an AI Tool!",
            icon: "success",
            showConfirmButton: false,
            timer: 2000,
        }).then(function() {
            window.location.href = "index.php";
        });
    </script>
</body>
</html>

