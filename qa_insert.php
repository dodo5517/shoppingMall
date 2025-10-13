<?
    include "./common.php";
    $title=$_REQUEST["title"];
    $name=$_REQUEST["name"];
    $passwd=$_REQUEST["passwd"];
    $contents=$_REQUEST["contents"];
    $today = date("Y-m-d");

    $sql="insert into qa (title, name, passwd, writeday, count, contents) 
        values ('$title','$name','$passwd','$today', 0,'$contents')";
    $result=mysqli_query($db, $sql); 	
    if (!$result) exit("에러: $sql");

    $id=mysqli_insert_id($db);

    $pos1=$id;
    $pos2="A";

    $sql="update qa set pos1=$pos1, pos2='$pos2' where id=$id";
    $result=mysqli_query($db, $sql); 	
    if (!$result) exit("에러: $sql");

    echo("<script>location.href='qa.php'</script>");
?>