<?
   include "../common.php";

   $id=$_REQUEST["id"];
   $state=$_REQUEST["state"];

   $page=$_REQUEST["page"];
   $sel1=$_REQUEST["sel1"];
   $sel2=$_REQUEST["sel2"];
   $text1=$_REQUEST["text1"];
   $day1=$_REQUEST["day1"];
   $day2=$_REQUEST["day2"];

   $sql="update jumun set state=$state where id='$id'";
   $result=mysqli_query($db, $sql); 	
   if (!$result) exit("에러: $sql");

   echo("<script>location.href='jumun.php'</script>");
?>