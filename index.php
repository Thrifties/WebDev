<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
        <script src="jquery-3.3.1.min.js"></script>
		<script src="jquery-ui.min.js"></script>
        <link rel="stylesheet" href="CSS\style2.css">
        <title>IT 310 ACTIVITY 3 XML WITH CRUD USING DOM PHP</title>
    </head>
    <body>

        <nav>
            <div class="buttons">
                <a href="create.php"><button>Add</button></a>
                <a href="update.php"><button>Update</button></a>
                <a href="delete.php"><button>Delete</button></a>
            </div>

            <div class="srch">
            <form class="searchbox" method="post" action="loadSearch.php">
                <!-- <button type="submit" name="searchBtn" id="searchBtn" >Search</button> -->
                <input id="search" name="search" type="text" onkeyup="showSearch(this.value)" placeholder="Search...">
                
            </form>
            <div id="result-box"> 
            </div>
        </nav>

        <div class="container">
            <?php 
            $xml = new domdocument("1.0");
            $xml->load("AITools.xml");
            
            $AIs = $xml->getElementsByTagName("AI");
            
            foreach($AIs as $AI)
            {
            $toolName = $AI->getElementsByTagName("ToolName")->item(0)->nodeValue;;
            $developer = $AI->getElementsByTagName("Developer")->item(0)->nodeValue;
            $releaseDate = $AI->getElementsByTagName("ReleaseDate")->item(0)->nodeValue;
            $category = $AI->getElementsByTagName("Category")->item(0)->nodeValue;
            $subscriptionType = $AI->getElementsByTagName("SubscriptionType")->item(0)->nodeValue;
            $description = $AI ->getElementsByTagName("Description")->item(0)->nodeValue;
            $image = $AI->getElementsByTagName('Image')->item(0)->nodeValue;
            

            echo '
                <div class="card">
                    <div class="image"> 
                        <img class="uimg" src="data:image;base64,'. $image . '"></div>  
                    <div class="toolName"><a href="">' . $toolName . '</a></div>
                    <div>Developer: ' . $developer . ' </div>
                    <div>Release Date: ' . $releaseDate . '</div>
                    <div>Category: ' . $category . '</div>
                    <div>Subscription Type: ' . $subscriptionType . '</div> 
                    <div id="desc">Description: ' . $description . '</div>  
                    <div id="readMore">Read more...</div>  
                </div>
            ';
            }

            
            ?>
        
    </body>
    <script>
        $(document).ready(function(){


            /* $("#readMore").accordion(function(){
                $(this).animate({height: "60vh", width: "auto"},100);
                
            });*/

            /* $(".card").mouseenter(function(){
                $(this).animate({height: "55vh", width: "auto"}, 100);
            });
            $(".card").mouseleave(function(){
                $(this).animate({height: "40vh", width: "auto"}, 100);
            }); */

            
            
            
            // the purpose of the showSearch function is to process the loadAI.php and show the search results in the result-box
				function showSearch(search) {
					if (search.length == 0) {
						document.getElementById("result-box").innerHTML = "";
					} 
					else {
						http = new XMLHttpRequest();
						http.onreadystatechange = function() 
						{
							if (http.readyState == 4 && http.status == 200) {
								document.getElementById("result-box").innerHTML = http.responseText;
							}
						};
						http.open("GET", "loadAI.php?q=" + search, true);
						http.send();
					}
				}

        });

                
		</script>
    </html>