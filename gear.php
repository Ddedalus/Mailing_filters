<?php
//TODO functions in diffrent file
function map_Teachers($t)
{
    //Does it need to be in that form? I mean evaluate to <>, or just url code?
    return '&lt;'.$t.'&gt;';
}


$class_name = (isset($_POST['class_name']) ? $_POST['class_name'] : '');
$class_email = (isset($_POST['class_email']) ? $_POST['class_email'] : '');;
           
$students_input = (isset($_POST['students']) ? $_POST['students'] : '');
$teachers_input = (isset($_POST['teachers']) ? $_POST['teachers'] : '');
                       
//TODO Validation
$students = preg_split("/[\s,]+/", $students_input);
$teachers = preg_split("/[\s,]+/", $teachers_input);

$teachers = array_map("map_Teachers", $teachers);
$teachers_formula = implode(" OR ", $teachers);

$id = "";
$ids = array(); //array of id
$header = "";
$entries = "";



//TODO Format date
date_default_timezone_get();
$date = date('m/d/Y h:i:s a', time());

for($i = 0;$i < count($students); $i++) {
   
    $simple_id = str_pad(strval($i+1), 10, "0", STR_PAD_LEFT);
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

$output = $header.$entries;
$output .= "\n</feed>";

/*tests
echo $teachers_formula;
echo "<br/><hr/>";
echo $date;
echo "<br/><hr/>";
echo count($students);
echo "<br/><hr/>";
echo $ids;
echo "<br/><hr/>";
*/

?>

<textarea cols="80" rows="50"><?php echo $output;?></textarea>
