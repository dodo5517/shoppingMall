<?
	include "../common.php";

    $id=$_REQUEST["id"];

    
    $sql="select * from product where id=$id ";     // id번째 자료 읽기
    $result=mysqli_query($db,$sql); 
    if (!$result) exit("에러:$sql");
    $row=mysqli_fetch_array($result);    // 1레코드 읽기

	$sel1=$_REQUEST["sel1"];
	$sel2=$_REQUEST["sel2"];
	$sel3=$_REQUEST["sel3"];
	$sel4=$_REQUEST["sel4"];
	$text1=$_REQUEST["text1"];
	$page=$_REQUEST["page"];

    $menu=$_REQUEST["menu"];    // 혹은  $name=$_POST["name"];
    $code=$_REQUEST["code"];
    $name=$_REQUEST["name"];
    $name=addslashes($name);
    $coname=$_REQUEST["coname"];
    $price=$_REQUEST["price"];
    $opt1=$_REQUEST["opt1"];
    $opt2=$_REQUEST["opt2"];
    $contents=$_REQUEST["contents"];
    $contents=addslashes($contents);
    $status=$_REQUEST["status"];
    $icon_new=$_REQUEST["icon_new"];
    $icon_hit=$_REQUEST["icon_hit"];
    $icon_sale=$_REQUEST["icon_sale"];
    $discount=$_REQUEST["discount"];
    $regday=$_REQUEST["regday"];
    $image1=$_REQUEST["image1"];
    $image2=$_REQUEST["image2"];
    $image3=$_REQUEST["image3"];
    $checkno1=$_REQUEST["checkno1"];
    $checkno2=$_REQUEST["checkno2"];
    $checkno3=$_REQUEST["checkno3"];

    $fname1=$row["image1"];
    if ($checkno1=="1") {
        $fname1="";
        
    }
    if ($_FILES["image1"]["error"]==0) 
    {
        $fname1=$_FILES["image1"]["name"];    
        if (!move_uploaded_file($_FILES["image1"]["tmp_name"],
            "../product/" . $fname1)) exit("업로드 실패");
    }
    $fname2=$row["image2"];
    if ($checkno2=="1") $fname2="";   
    if ($_FILES["image2"]["error"]==0) 
    {
         $fname2=$_FILES["image2"]["name"];    
         if (!move_uploaded_file($_FILES["image2"]["tmp_name"],
             "../product/" . $fname2)) exit("업로드 실패");
    }
    $fname3=$row["image3"];
    if ($checkno3=="1") $fname3="";   
    if ($_FILES["image3"]["error"]==0) 
    {
         $fname3=$_FILES["image3"]["name"];    
         if (!move_uploaded_file($_FILES["image3"]["tmp_name"],
             "../product/" . $fname3)) exit("업로드 실패");
    }

    if (!$icon_new)   $icon_new=0;   else   $icon_new=1; 
    if (!$icon_hit)   $icon_hit=0;   else   $icon_hit=1;      
    if (!$icon_sale)   $icon_sale=0;   else   $icon_sale=1;    

    if ($icon_sale==1){
        $sql="update product set menu=$menu, code='$code', name='$name', coname='$coname', price=$price, opt1=$opt1, opt2=$opt2,
            contents='$contents', status=$status, regday='$regday', icon_new=$icon_new, icon_hit=$icon_hit,
                icon_sale=$icon_sale, discount=$discount, image1='$fname1', image2='$fname2', image3='$fname3'
                where id=$id";
    } else {
        $sql="update product set menu=$menu, code='$code', name='$name', coname='$coname', price=$price, opt1=$opt1, opt2=$opt2,
            contents='$contents', status=$status, regday='$regday', icon_new=$icon_new, icon_hit=$icon_hit,
                icon_sale=$icon_sale, image1='$fname1', image2='$fname2', image3='$fname3'
                where id=$id";
    }
    $result=mysqli_query($db, $sql); 	
    if (!$result) exit("에러: $sql");

    echo("<script>location.href='product.php?id=$id&sel1=$sel1&sel2=$sel2&sel3=$sel3&sel4=$sel4&text1=$text1&page=$page'</script>");
?>