<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS\style2.css">
    <title>Search Result</title>
</head>
<body>
    <div class="buttons">
        <button><a href="index.php">Back</a></button>
    </div>
    <div class="result">
    <?php
        $xml = new DOMDocument("1.0");
        $xml->load('AITools.xml');
        $AIs = $xml->getElementsByTagName('AI');

        $flag = 0;

        $search = strtolower($_REQUEST["q"]); 

        foreach($AIs as $AI){
            $ToolName = $AI->getElementsByTagName('ToolName')->item(0)->nodeValue;
            $Developer = $AI->getElementsByTagName('Developer')->item(0)->nodeValue;
            $ReleaseDate = $AI->getElementsByTagName('ReleaseDate')->item(0)->nodeValue;
            $Category = $AI->getElementsByTagName('Category')->item(0)->nodeValue;
            
            $Tools = strtolower($ToolName);
            $Dev = strtolower($Developer);
            $Cat = strtolower($Category);

            if(
                ($search == $Tools) ||
                ($search == $Dev) ||
                ($search == $ReleaseDate) ||
                ($search == $Cat)
            ){
                $flag++;
                $SubscriptionType = $AI->getElementsByTagName('SubscriptionType')->item(0)->nodeValue;
                echo'
                        <div class="AI">
                            <h3 class="title">' ."Tool Name: ". $ToolName .'</h3>
                            <div class="genre">' ."Developer: ". $Developer .'</div>
                            <div class="releaseYear">' ."Release Date: ". $ReleaseDate .'</div>
                            <div class="console">' ."Category: ". $Category .'</div>
                            <div class="director">' ."Subscription Type: ". $SubscriptionType .'</div>
                        </div>
                    ';
            }
        }
        if($flag == 0){
            echo'<p>No Record Found.</p>';
            
        }
    ?>
    </div>
</body>
</html>

