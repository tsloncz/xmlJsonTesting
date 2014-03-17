<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
/*
Elements can have:
	 only child elements
	 attributes with valuable information
	 attributes with valuable info and child elements
	 csv formatted body with an attribute that contains column names
*/

//XML Testing
 
$startTime = new DateTime();
print $startTime->getTimestamp() . '<br>';

//Parser XML seems to be better but saving this incase
//Simple XML Reference http://www.w3schools.com/Php/php_ref_simplexml.asp
print '<b>Using Simple XML</b>' . "<br>";
$sxe=simplexml_load_file("data/ARBASXA1.wdb.xml");

echo "file type: <font color='red'>" . $sxe->getName() . "</font><br>";
foreach ($sxe->children() as $child)
  {
 	 echo "<font color='green'>" . $child->getName() . "</font>";
	 foreach ($child->children() as $grandChild)
	 {	 echo "<table>";
		 foreach($child->attributes() as $a => $b)
		{
			echo "&nbsp &nbsp<tr><td width='20'>" . $a . ":</td><td>" . "<input type='text' value='$b'>" . "</td></tr>";
		}
		echo "</table>";
		 echo "<font color='blue'>" . $grandChild->getName() . "</font><br>";
		 //If count()>0 the element has children and is not in csv format
		 //Should write 2 functions to handle either case
		 if (  $grandChild->count() == 0 )
		 	printCsvElement( $grandChild );	
		 	//echo "content: " . $grandChild . "<br>";
		 else
		 	foreach($grandChild->attributes() as $a => $b)
		  	{
				echo "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp" . $a,'=>"',$b[0],"\"<br>";
				echo '';
		  	}
		 foreach ($grandChild->children() as $greatGrandChild)
		 {
			 echo "&nbsp &nbsp &nbsp &nbsp<font color='violet'>" . $greatGrandChild->getName() . "</font><br>";
			 foreach($greatGrandChild->attributes() as $a => $b)
			  {
			  	echo "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp" . $a,'="',$b,"\"<br>";
			  }
		 }
	 }
  
  }

function printCsvElement( $element )
{
	echo "<table><tr>";
	$csv =  ((string) $element);
	$csv = explode("," , $csv);
	$numColumns;
	foreach($element->attributes() as $a => $b)
        {
                $bArray = explode(",",$b);
		$numColumns = count($bArray);
                echo "<br><table border='1' border-collapse='collapse' cellpadding='5'><tr>";
                foreach($bArray as $val)
                {
                     	echo "<td><b>" . $val . "</b></td>";
                }
	echo "</tr><tr>";
	}
	foreach( $csv as $a => $b )
	{
		if( ($a % $numColumns) == 0)
			echo "</tr><tr>";
		echo "<td align='center'><input type='text' size='5' value='$b'" . "</td>";
	}
	echo "</tr></table><br><br>";

}
$endTime = new DateTime();
$diff = $endTime->diff($startTime);
print "Time to create: " . $diff->s . "seconds";
?>
    </body>
</html>
