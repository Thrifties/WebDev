<?php
    $xml = new domdocument("1.0");
    $xml->load("AITools.xml");
    $search = strtolower($_REQUEST["q"]); 

    $AIs = $xml->getElementsByTagName('AI');

    $output = "<div class='result' id='search-result'><ul>"; //This will be the placeholder for the search results

    foreach($AIs as $AI){                                                                       //  ]
        $ToolName = $AI->getElementsByTagName('ToolName')->item(0)->nodeValue;                  //  ]

        if($search == strtolower(substr($ToolName, 0, strlen($search)))){                       //Determines whether if the item that we are looking for is inside our XML file
            if($output == "<ul>") {                                                             //Lines 17-41 will display the data that we are looking for from the XML file                                
                $output = "
                <li class='result-list'>
                    <div class='search-list'>
                        <div class='search-list-right'>
                            <a href='loadSearchSuggestion.php?q=".$ToolName."'><span class='search-list-title'>".$ToolName."</span></a><br>
                        </div>      
                    </div>                                                                                  
                </li>
                ";
            }
            else {
                $output .= "<li class=''>
                <div class='search-list'>
                    <div class='search-list-right'>
                        <a href='loadSearchSuggestion.php?q=".$ToolName."'><span class='search-list-title'>".$ToolName."</span></a><br>
                    </div>
                </div>
            </li>
            ";
            }
        }
    }


    $output .= "</ul></div>"; //This closes the list of items

	if($output=="<div class='result' id='search-result'><ul></ul></div>") //Lines 50-65 will output "no result found" if there is no data in the XML file of what we are looking for
        echo "
        <div class='result' id='search-result'>
            <ul>
                <li class='result-list'>
                    <div class='no-record'>
                        <div class='search-list-right'>
                            <span class='no-record-text'>No Result found.</span>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        ";
	else
		echo $output;

?>