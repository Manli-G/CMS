<?php
require 'Carbon.php';
use Carbon\Carbon;
?>

<!doctype html>
<html>
<head>
    
<meta charset="UTF-8">
<!-- Viewport Meta Tag -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="http://logo-load.com/uploads/posts/2016-04/1459778990_ucc-logo.png" type="image/x-icon">
<title>CMS with Server Side Content Selection</title>
<link href="css/style.css" rel="stylesheet">
<link id="linkTag" rel="stylesheet">


</head>

<body>

<div class="box">

	<div class="nav">
		<div class="midbox">
            <li class = "logo"><a href="cms_2.php?page=0"><img id="logo" src= "image/ucc-logo.png"></a></li>
 			<li><a href="cms_2.php?page=0">HOME <br> 
 			<p> <?php filenameOrNot('content/home.md')?></p>
 			</a>
                
            </li>
 			<li><a href="cms_2.php?page=1">UCC<br>
            <p> <?php filenameOrNot('content/home.md') ?></p>
            </a>
            </li>
 			<li><a href="cms_2.php?page=2">PERSONAL<br>
            <p> <?php filenameOrNot('content/personal.md') ?></p>
            </a>
            </li>
 			<li><a href="cms_2.php?page=3">COURSE<br>
            <p> <?php filenameOrNot('content/course.md') ?></p>
            </a>
            </li>
            <li><a href="cms_2.php?page=4">ABOUT<br>
            <p> <?php filenameOrNot('content/about.md') ?></p>
            </a><br>
            
            </li>
            <li class = "buttonArea">
                
                <Button id="dayMode" onClick="switchTheme('day.css')">Day</Button>
                <Button id="nightMode" onClick="switchTheme('night.css')">Night</Button>
                <Button id="defaultMode" onClick="switchTheme('style.css')">Default</Button>
                
            </li>
            
 		</div>
		
	</div>
    
	<div class="content-box">
	    
		<div class="content">
		
		<?php
            include 'Parsedown.php';  // load external file
            
        function filenameOrNot($filename){
            
            if (!file_exists($filename)){
                echo 'Offline';
            }else{
                $ts = filemtime($filename);  // create the time stamp
                $carb = Carbon::createFromTimestamp($ts); // create the Carbon object
                echo $carb->diffForHumans(); // generate the text phrase
            }
        };
            
		function includeOrFail($filename){
            $parser = new Parsedown();  // create parser object
            $parser->setSafeMode(true); // escape HTML input such as <SCRIPT> tags etc
            
            if (!file_exists($filename)){
                echo 'Error. Content file cannot be retrieved.';
            }else{
                $text = file_get_contents($filename); // get file text
                echo $parser->text($text);
            }
		};
	
        if(isset($_GET['page'])){
		    switch($_GET['page']){
		        case "0":
                    includeOrFail('content/home.md');
		            break;
	            case "1":
                    includeOrFail('content/ucc.md');
		            break;
	            case "2":
                    includeOrFail('content/personal.md');
		            break;
                case "3":
                    includeOrFail('content/course.md');
		            break;
		        case "4":
                    includeOrFail('content/about.md');
		            break;
                case "5":
                    includeOrFail('content/contact.md');
                    break;
                case "6":
                    includeOrFail('content/others.md');
                    break;
	            default:
	                echo 'Invalid parameter. No such content!';
	                
	            }
            
        }else{
            includeOrFail('content/home.md');
		   };
        
		?>

        </div>
            <div class="console-box" id="msgs" ><i>Status messages will appear here.</i>
            	
            </div>
			
			
		</div>
		

</div>
<script>
function writeMsg(text,level){
    var str1 = text;
    //var str2 = "was activated.";
    //var res = str1.concat(str2);
    document.getElementById("msgs").innerHTML = str1;
    switch (level) {
    case 1://"error"level
            document.getElementById("msgs").style.color = "red";
            break;
    case 2://"success"level
            document.getElementById("msgs").style.color = "green";
            break;
    default://"info"level
            document.getElementById("msgs").style.color = "blue";
    }

    
};

function switchTheme(cssfile){
    document.getElementById("linkTag").setAttribute("href","css/"+cssfile);
    writeMsg("The style sheet " + " " + cssfile +" "+"has applied",3);
    switch(cssfile){
        case "day.css":
            document.getElementById("logo").setAttribute("src","image/ucc-logo-black.png");
            break;
        default:
            document.getElementById("logo").setAttribute("src","image/ucc-logo.png");
    }
};






</script>
</body>

</html>
