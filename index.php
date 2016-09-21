<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <title>#DoWszystkich</title>
</head>
<body>
  <h2>Generator Filtrów</h2>
  <form action="gear.php" method="post">
    Klasa:<br/>
    <input name="class_name"/>
    <br/>
     
    Adres skrzynki pośredniczącej:<br/>
    <input name="class_email"/>
    <br/><hr/><br/>
     
    Adresy uczniow<br/>
    <textarea cols="40" rows="5" name="students"></textarea>
    <br/><hr/><br/>
     
    Adresy nauczycieli<br/>
    <textarea cols="40" rows="5" name="teachers"></textarea>
    <br/><hr/><br/>
     
    <input type="submit" value="Send"/>
  </form>
  
</body>
</html>
