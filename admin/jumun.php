<!---------------------------------------------------------------------------------------------
	제목 : 내 손으로 만드는 PHP 쇼핑몰 (실습용 디자인 HTML)

	소속 : 인덕대학교 컴퓨터소프트웨어학과
	이름 : 교수 윤형태 (2024.02)
---------------------------------------------------------------------------------------------->
<?
   include "../common.php";

   $a_text1=array("","주문번호","고객명","상품명");   // for문의 $i는 1부터 시작
   $n_text1=count($a_text1);

   $day1=$_REQUEST["day1"] ? $_REQUEST["day1"] : date("Y-m-d", strtotime("-1 month"));
   $day2=$_REQUEST["day2"] ? $_REQUEST["day2"] : date("Y-m-d");   
   $sel1=$_REQUEST["sel1"];
   $sel2=$_REQUEST["sel2"];
   $text1=$_REQUEST["text1"];
   $page=$_REQUEST["page"];
   if (!$page) {
	$page = 1;
   }

   $args="day1=$day1&day2=$day2&sel1=$sel1&sel2=$sel2&text1=$text1";

   if (!$sel1) $sel1=0;
   if (!$sel2) $sel2=0;
   if (!$text1) $text1=""; 

   $k=0;
   if ($day1 != 0 && $day2 !=0){ $s[$k] = "jumunday between '". $day1."' and '". $day2."'"; $k++; }
   if ($sel1 != 0)        { $s[$k] = "state=" . $sel1; $k++; }
   if ($sel2 == 1)       { $s[$k] = "id like '%".$text1."%'"; $k++; }
   elseif ($sel2==2)   { $s[$k] = "o_name like '%".$text1."%'"; $k++; }
   elseif ($sel2==3)   { $s[$k] = "product_names like '%".$text1."%'"; $k++; }
   
   if ($k> 0)
   {
	   $tmp=implode(" and ", $s); 
	   $tmp = " where " . $tmp;
   }

    $sql="select * from jumun " . $tmp . " order by id desc";
	$result = mypagination($sql, $args, $count, $pagebar); // 함수 호출
	if (!$result) exit("에러:$sql");
	$total_count=mysqli_num_rows($result);    // 레코드개수

?>
<!doctype html>
<html lang="kr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>INDUK Mall</title>
	<link  href="../css/bootstrap.min.css" rel="stylesheet">
	<link  href="../css/my.css" rel="stylesheet">
	<script src="..js/jquery-3.7.1.min.js"></script>
	<script src="../js/bootstrap.bundle.min.js"></script>
	<script src="../js/my.js"></script>
</head>
<body>

<div class="container">
<!-------------------------------------------------------------------------------------------->	
<script> document.write(admin_menu());</script>
<!-------------------------------------------------------------------------------------------->	

<script>
	function go_update(id,pos)
	{
		var state=form1.state[pos].value;
		console.log(state);
		location.href="jumun_update.php?id="+id+"&state="+state+"&page="+form1.page.value+
			"&sel1="+form1.sel1.value+"&sel2="+form1.sel2.value+"&text1="+form1.text1.value+
			"&day1="+form1.day1.value+"&day2="+form1.day2.value;
	}
</script>

<div class="row mx-1 justify-content-center">
	<div class="col" align="center">

		<h4 class="m-0 mb-3">주문</h4>

		<form name="form1" method="post" action="jumun.php">
		<input type="hidden" name="state">	
		<input type="hidden" name="page" value="<?=$page?>">	
		<table class="table table-sm table-borderless m-0 p-0">
			<tr>
				<td width="20%" align="left" style="padding-top:8px">
					주문수 : <font color="red"><?=$total_count;?></font>
				</td>
				<td align="right">
				
					기간:
					<div class="d-inline-flex">
						<input type="date" name="day1" value="<?=$day1;?>" 
							class="form-control form-control-sm"  style="width:120px" >~
						<input type="date" name="day2" value="<?=$day2;?>" 
							class="form-control form-control-sm" style="width:120px" >
					</div>
					<div class="d-inline-flex">
						<?
							echo("<select name='sel1' class='form-select form-select-sm bg-light myfs12' style='width:100px'>");
							for($i=0;$i<$n_state;$i++){
								$tmp = ($i==$sel1) ? "selected" : "";
								echo("<option value='$i' $tmp>$a_state[$i]</option>");
							}
						?></select>&nbsp;
						<?
							echo("<select name='sel2' class='form-select bg-light myfs12' style='width:105px'>");
							for($i=0;$i<$n_text1;$i++){
								$tmp = ($i==$sel2) ? "selected" : "";
								echo("<option value='$i' $tmp>$a_text1[$i]</option>");
							}
						?></select>
					</div>
					<div class="d-inline-flex">
						<div class="input-group input-group-sm">
							<input type="text" name="text1" value="<?=$text1;?>" 
								class="form-control myfs12" style="width:100px" 
								onKeydown="if (event.keyCode == 13) { form1.submit(); }"> 
							<button class="btn mycolor1 myfs12" type="button" 
								onClick="form1.submit();">검색</button>
						</div>
					</div>
				</td>
			</tr>
		</table>
		
		<table class="table table-sm table-bordered table-hover my-1">
			<tr class="bg-light">
				<td >주문번호</td>
				<td >주문일</td>
				<td >제품명</td>
				<td width="5%">제품수</td>
				<td>금액</td>
				<td>주문자</td>
				<td width="5%">결제</td>
				<td width="25%">주문상태</td>
				<td width="5%">삭제</td>
			</tr>
			<tr>
			<?
				foreach ($result as $key=>$row){
				$id=$row["id"];
			?>
				<td class="mywordwrap">
					<a href="jumun_info.php?id=<?=$row["id"];?>" style="color:#0085dd"><?=$row["id"];?></a>
				</td>
				<td><?=$row["jumunday"];?></td>
				<td align="left" class="mywordwrap"><?=$row["product_names"];?></td>	
				<td><?=$row["product_nums"];?></td>	
				<td align="right" class="mywordwrap"><?=number_format($row["total_cash"]);?></td>	
				<td><?=$row["r_name"];?></td>	
				<td><? if($row["pay_kind"]==0) echo "카드"; else echo "무통장";?></td>	
				<td>
					<div class="d-sm-inline-flex">
						<? //주문신청
						    $color="black";
							if ($row["state"]==5)  $color="blue";  // 주문완료 
							if ($row["state"]==6)  $color="red";   // 주문취소	
							echo("<select name='state' class='form-select form-select-sm myfs12 me-1' style='color:$color'>");
							for ($i=1;$i<$n_state;$i++){
								$tmp = ($i==$row["state"]) ? "selected" : "";
								echo("<option value='$i' $tmp>$a_state[$i]</option>");
							}
						?>
						</select>
						<a href="javascript:go_update('<?=$row["id"];?>',<?=$key+1?>);" 
							class="btn btn-sm mybutton-blue" style="width:50px;">수정</a>
					</div>
				</td>
				<td>
					<a href="jumun_delete.php?id=<?=$id;?>" 
						class="btn btn-sm mybutton-red" 
						onclick="javascript:return confirm('삭제할까요 ?');">삭제</a>				
				</td>
			</tr>
			<?
				}
			?>
		</table>
		
		</form>

<?
    echo  $pagebar;            // pagination bar 표시
?>

	</div>
</div>
<!-------------------------------------------------------------------------------------------->	
</div>

</body>
</html>
