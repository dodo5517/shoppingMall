<!---------------------------------------------------------------------------------------------
	제목 : 내 손으로 만드는 PHP 쇼핑몰 (실습용 디자인 HTML)

	소속 : 인덕대학교 컴퓨터소프트웨어학과
	이름 : 교수 윤형태 (2024.02)
---------------------------------------------------------------------------------------------->
<?
	include "../common.php";

	$id=$_REQUEST["id"];

    $sql="select * from jumun where id=$id ";     // id번째 자료 읽기
    $result=mysqli_query($db,$sql); 
    if (!$result) exit("에러:$sql");

    $row=mysqli_fetch_array($result);    // 1레코드 읽기
	$total_cash=$row["total_cash"];

	$o_tel1=trim(substr($row["o_tel"],0,3));        // 0번 위치에서 3자리 문자열 추출
    $o_tel2=trim(substr($row["o_tel"],3,4));        // 3번 위치에서 4자리
    $o_tel3=trim(substr($row["o_tel"],7,4));        // 7번 위치에서 4자리

	$r_tel1=trim(substr($row["r_tel"],0,3));        // 0번 위치에서 3자리 문자열 추출
    $r_tel2=trim(substr($row["r_tel"],3,4));        // 3번 위치에서 4자리
    $r_tel3=trim(substr($row["r_tel"],7,4));        // 7번 위치에서 4자리

	$card_kind =$row["card_kind"];
	$card_halbu=$row["card_halbu"];
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

<div class="row mx-1 justify-content-center">
	<div class="col-sm-10" align="center">

	<h4 class="m-0 mb-3">주문 ( </b><?=$row["id"];?><b> )</h4>

	<table class="table table-sm table-bordered mb-3">
		<tr>
			<td width="15%" class="bg-light">상태</td>
			<td width="35%"><?=$a_state[$row["state"]];?></td>
			<td width="15%" class="bg-light">주문일</td>
			<td width="35%"><?=$row["jumunday"];?></td>
		</tr>
	</table>

	<table class="table table-sm table-bordered mb-2">
		<tr>
			<td width="15%" class="bg-light"><b>주문자</b></td>
			<td width="35%"><?=$row["o_name"];?></td>
			<td width="15%" class="bg-light">구분</td>
			<td width="35%"><? if($row["member_id"]==0) echo "비회원"; else echo "회원";?></td>
		</tr>
		<tr>
			<td class="bg-light">전화</td><td><?=$o_tel1."-".$o_tel2."-".$o_tel3;?></td>
			<td class="bg-light">E-Mail</td><td><?=$row["o_email"];?></td>
		</tr>
		<tr>
			<td class="bg-light">주소</td>
			<td align="left" colspan="3">&nbsp;<?="(".$row["o_zip"].")".$row["o_juso"];?></td>
		</tr>
	</table>

	<table class="table table-sm table-bordered mb-3">
		<tr>
			<td width="15%" class="bg-light"><b>수신자</b></td>
			<td width="35%"><?=$row["r_name"];?></td>
			<td width="15%" class="bg-light"></td>
			<td></td>
		</tr>
		<tr>
			<td class="bg-light">전화</td>
			<td><?=$r_tel1."-".$r_tel2."-".$r_tel3;?></td>
			<td class="bg-light">E-Mail</td>
			<td><?=$row["r_email"];?></td>
		</tr>
		<tr>
			<td class="bg-light">주소</td>
			<td align="left" colspan="3">&nbsp;<?="(".$row["r_zip"].")".$row["r_juso"];?></td>
		</tr>
		<tr height="50">
			<td class="bg-light">메모</td>
			<td align="left" valign="top" colspan="3">&nbsp;<?=$row["memo"];?></td>
		</tr>
	</table>

	<table class="table table-sm table-bordered mb-3">
		<tr>
			<td width="15%" class="bg-light"><b>카드</b></td>
			<td width="35%"><?if($card_kind==1)echo"국민카드";elseif($card_kind==2)echo"신한카드";elseif($card_kind==3)echo"우리카드";elseif($card_kind==4)"하나카드";?></td>
			<td width="15%" class="bg-light">승인</td>
			<td width="35%"><?=$row["card_okno"];?></td>
		</tr>
		<tr>
			<td class="bg-light">할부</td><td><?if($card_halbu==0)echo"일시불";else echo $card_halbu."개월";?></td>
			<td class="bg-light"></td><td></td>
		</tr>
		<tr>
			<td class="bg-light"><b>무통장</b></td><td><?if($row["bank_kind"]==1)echo"국민은행 111-00000-0000";elseif($row["bank_kind"]==2)echo "신한은행 222-00000-0000";?></td>
			<td class="bg-light">입금자</td><td><?=$row["bank_sender"];?></td>
		</tr>
	</table>
	<table class="table table-sm table-bordered mb-3">
		<tr class="bg-light">
			<td>제품명</td>
			<td width="10%">수량</td>
			<td width="10%">단가</td>
			<td width="10%">금액</td>
			<td width="10%">할인</td>
			<td width="20%">옵션</td>
		</tr>
<?
	$sql="select jumuns.*, opts1.name as name1, opts2.name as name2, product.name as name3
    		from ((jumuns left join product on jumuns.product_id=product.id)
           left join opts as opts1 on jumuns.opts_id1=opts1.id)
           left join opts as opts2 on jumuns.opts_id2=opts2.id
   			 where jumuns.jumun_id='$id';";

	$result=mysqli_query($db,$sql); 
	if (!$result) exit("에러:$sql");

	foreach ($result as $row){
?>
		<tr>
			<td align="left"><?if($row["name3"]==0) echo "배송비"; else echo $row["name3"];?></td>
			<td><?=$row["num"];?></td>
			<td align="right"><?=number_format($row["price"]);?></td>
			<td align="right"><?=number_format($row["prices"]);?></td>
			<td><?if($row["discount"]==Null) echo ""; else echo $row["discount"];?></td>
			<td><?if($row["name3"]==0) echo ""; else if ($row["name2"]==0) echo $row["name1"]; else echo $row["name1"]." / ".$row["name2"];?></td>
		</tr>
<?
	}
?>
	</table>
	<table class="table table-sm table-bordered mb-3 p-2">
		<tr>
			<td width="15%" class="bg-light">총금액</td>
			<td width="85%" align="right" style="font-size:18px"><b><?=number_format($total_cash);?> 원</b>&nbsp;</td>
		</tr>
	</table>

	<a href="javascript:print();"  class="btn btn-sm btn-dark text-white my-2">&nbsp;프린트&nbsp;</a>&nbsp;
	<a href="javascript:history.back();"  class="btn btn-sm btn-outline-dark my-2">&nbsp;돌아가기&nbsp;</a>

	</div>
</div>
<!-------------------------------------------------------------------------------------------->	
</div>

</body>
</html>
