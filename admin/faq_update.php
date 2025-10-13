<?
    include "../common.php";

    $id=$_REQUEST["id"];
    $title=$_REQUEST["title"];
    $title=addslashes($title);
    $contents=$_REQUEST["contents"];
    $contents=addslashes($contents);

    $sql="update faq set title='$title', contents='$contents'";
    $result=mysqli_query($db, $sql); 	
    if (!$result) exit("에러: $sql");

    echo("<script>location.href='faq.php'</script>");
?>