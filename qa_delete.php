<?
    include "./common.php";

    $text1=$_REQUEST["text1"];
	$page=$_REQUEST["page"];
	$id=$_REQUEST["id"];

    $sql="delete from qa where id=$id";
    $result=mysqli_query($db,$sql); 
    if (!$result) exit("에러:$sql");

    echo("<script>location.href='qa.php?page=$page&text1=$text1'</script>");
?>