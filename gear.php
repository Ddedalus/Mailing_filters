<?php
//TODO functions in diffrent file

//function to convert values from "foo" into "<foo>"
//if value is improper func. changes it to ERROR
//those wrong keys-values pairs are later checked and deleted from array
function map_Teachers($t)
{
    if( filter_var( $t, FILTER_VALIDATE_EMAIL) === false ) {
    	return "ERROR";
    } else
        return '&lt;'.$t.'&gt;';
}


$class_name = (isset($_POST['class_name']) ? $_POST['class_name'] : '');
$class_email = (isset($_POST['class_email']) ? $_POST['class_email'] : '');;
           
$students_input = (isset($_POST['students']) ? $_POST['students'] : '');
$teachers_input = (isset($_POST['teachers']) ? $_POST['teachers'] : '');
                       
$students = preg_split("/[\s,]+/", $students_input);
$teachers = preg_split("/[\s,]+/", $teachers_input);

$students = array_unique($students);

$teachers = array_unique($teachers);
$teachers = array_map("map_Teachers", $teachers);
$teachers = array_diff($teachers, ["ERROR"]);
$teachers = array_values($teachers);
$teachers_formula = implode(" OR ", $teachers);

$id = "";
$ids = array(); //array of id
$header = "";
$entries = "";


//formatting date
date_default_timezone_get();
$date = date('Y-m-d\Th:i:s\Z', time());

//generatign single filters
for($i = 0, $n = 0;$i < count($students); $i++) {

    if(key_exists($i, $students) ) {
            if(filter_var( ($students[$i]), FILTER_VALIDATE_EMAIL) === false) {
                continue;
            }
	    $n++;
    } else {
        continue;
    }
    
    $simple_id = str_pad(strval($n), 10, "0", STR_PAD_LEFT);
    array_push($ids, $simple_id);

    $entries .= <<<XML
<entry>
		<category term='filter'></category>
		<title>StudentFilter</title>
		<id>tag:mail.google.com,2008:filter:$simple_id</id>
		<updated>$date</updated>
		<content></content>
		<apps:property name='hasTheWord' value='from:(($teachers_formula)) OR subject:(#DoWszystkich)'/>
		<apps:property name='forwardTo' value='$students[$i]'/>
		<apps:property name='sizeOperator' value='s_sl'/>
		<apps:property name='sizeUnit' value='s_smb'/>
</entry>
XML;
}

//creating header
$id = implode(", ", $ids);
$header .= <<<XML
<?xml version='1.0' encoding='UTF-8'?>
<feed xmlns='http://www.w3.org/2005/Atom' xmlns:apps='http://schemas.google.com/apps/2006'>                                                                           
        <title>Filtr-#DoWszystkich</title>
<id>tag:mail.google.com,2008:filters:$id</id>
<updated>$date</updated>
    <author>
        <name>$class_name</name>
        <email>$class_email</email>
    </author>
XML;

//conecting everything
$output = $header.$entries;
$output .= "\n</feed>";

?>

<script type="text/javascript" src="js/main.js"></script>
<textarea id="result" cols="80" rows="50"><?php echo $output;?></textarea>
<button onclick="saveTextAsFile()">Zapisz</button>
