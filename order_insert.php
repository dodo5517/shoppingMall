<?
    include "./common.php";

    $cookie_id=$_COOKIE["cookie_id"];
    $cart = $_COOKIE["cart"];
    $n_cart = $_COOKIE["n_cart"];

    $o_name=$_REQUEST["o_name"];
    $o_tel=$_REQUEST["o_tel"];
	$o_email=$_REQUEST["o_email"];
	$o_zip=$_REQUEST["o_zip"];
	$o_juso=$_REQUEST["o_juso"];

	$r_name=$_REQUEST["r_name"];
	$r_tel=$_REQUEST["r_tel"];
	$r_email=$_REQUEST["r_email"];
	$r_zip=$_REQUEST["r_zip"];
	$r_juso=$_REQUEST["r_juso"];
	$memo=$_REQUEST["memo"];
    $memo=addslashes($memo); //작은 따옴표 처리.

    // $card_no1=$_REQUEST["card_no1"];
    // $card_no2=$_REQUEST["card_no2"];
    // $card_no3=$_REQUEST["card_no3"];
    // $card_no4=$_REQUEST["card_no4"];
    $pay_kind=$_REQUEST["pay_kind"];
    // if($card_no1) $card_okno=$card_no1.$card_no2.$card_no3.$card_no4;
    // else $card_okno=""; //무통장
    $card_halbu=$_REQUEST["card_halbu"];
    $card_kind=$_REQUEST["card_kind"];
    $bank_kind=$_REQUEST["bank_kind"];
    $bank_sender=$_REQUEST["bank_sender"];

    $total=0;
    $product_nums=0;
    $product_names="";

    $member_id = $cookie_id ? $cookie_id : 0 ; //회원 비회원 구분

    //jumun 테이블에서 오늘 주문 중, 가장 큰 주문번호 값 조사.
    $sql="select id from jumun where jumunday=curdate() order by id desc limit 1";
    $result=mysqli_query($db,$sql);
    if (!$result) exit("에러:$sql");
    $row=mysqli_fetch_array($result); //1레코드 읽기

    $count=mysqli_num_rows($result); //result에 담긴 레코드 개수

    if ($count>0)      // 주문번호가 있으면
    {
       $jumun_id=date("ymd").(str_pad((substr($row["id"],6,4))+1, "4", "0", STR_PAD_LEFT));//새주문번호 = 오늘날짜 . (조사한 주문번호 뒷4자리+1);
    }
    else
    {
        $jumun_id=date("ymd")."0001";//새주문번호 = 오늘날짜 . "0001";
    }

    $jumunday=date("ymd"); //주문일

    $sql="set foreign_key_checks=0";
    mysqli_query($db, $sql);

    for ($i=1;  $i<=$n_cart;  $i++)
    {
        if ($cart[$i]) // 제품정보가 있는 경우만
        {
            //제품정보 알아내기
            list($product_id, $num, $opts_id1, $opts_id2)=explode("^", $cart[$i]); 

            //$opts_id1, $opts_id2에 대한 소옵션이름 알아내기 
            $sql="select * from opts where id=$opts_id1";
            $result=mysqli_query($db,$sql);
            if (!$result) exit("에러:$sql");
            $opts1=mysqli_fetch_array($result);

            $sql="select * from opts where id=$opts_id2";
            $result=mysqli_query($db,$sql);
            if (!$result) exit("에러:$sql");
            $opts2=mysqli_fetch_array($result);

            // $product_id 제품에 대한 정보 알아내기 
            $sql="select * from product where id=$product_id";     // product_id번째 자료 읽기, 상품 불러오기.
            $result=mysqli_query($db,$sql); 
            if (!$result) exit("에러:$sql");
            $row=mysqli_fetch_array($result);    // 1레코드 읽기

            //단가
            if(!$row['discount']) { //discount가 존재하지 않으면
                $price=($row["price"]);
                $discount="NULL";
            }
            else {
                $price=round(($row['price'])*(100-$row['discount'])/100, -3);
                $discount=$row['discount'];
            }

            //금액
            $prices=($price*$num);

            //insert SQL문을 이용하여 jumuns 테이블에 저장.
            $sql="insert into jumuns (jumun_id, product_id, num, price, prices, discount, opts_id1, opts_id2) 
                                values ('$jumun_id', $product_id, $num, $price, $prices, $discount, $opts_id1, $opts_id2)";
            $result=mysqli_query($db, $sql);	
            if (!$result) exit("에러: $sql");

            //장바구니에서 제품 정보 삭제.
            setcookie("cart[$i]","");

            //총금액 = 총금액 + 금액;
            $total=$total+$prices;

            $product_nums=$product_nums+1;
            if($product_nums==1) $product_names = $row['name'];
        }
    }
    if($product_nums>1){ //제품수가 2개 이상인 경우만, "외 ?" 추가
        $tmp=$product_nums;
        $product_names=$product_names." 외 ".$tmp;
    }
    $product_names=addslashes($product_names); //작은 따옴표 처리.

    if ($total < $max_baesongbi) //배송비가 있는 경우 
    {
        //insert SQL문을 이용하여 jumuns테이블에 배송비 정보 저장. (주문_번호, 0, 1, 배송비, 배송비, 0, 0, 0,)
        $sql="insert into jumuns (jumun_id, product_id, num, price, prices, discount, opts_id1, opts_id2) 
                            values ('$jumun_id', 0, 1, $baesongbi, $baesongbi, NULL, 0, 0)"; 
        $result=mysqli_query($db, $sql);	
        if (!$result) exit("에러: $sql"); 
        //총금액 = 총금액 + 배송비;
        $total= $total+$baesongbi;
    }

    //insert SQL문을 이용하여 jumun 테이블에 주문 전체정보 저장.
    $sql= "insert into jumun (id, member_id, jumunday, product_names, product_nums, o_name, o_tel, o_email,
    o_zip, o_juso, r_name, r_tel, r_email, r_zip, r_juso, memo, pay_kind, card_halbu, card_kind, 
    bank_kind, bank_sender, total_cash, state) 
    values ('$jumun_id', $member_id, '$jumunday', '$product_names', $product_nums, '$o_name', '$o_tel', '$o_email',
    '$o_zip', '$o_juso', '$r_name', '$r_tel', '$r_email', '$r_zip', '$r_juso', '$memo', $pay_kind,
    $card_halbu, $card_kind, $bank_kind, '$bank_sender', $total, 1)";
    $result=mysqli_query($db, $sql);
    if (!$result) exit("에러: $sql");

    $sql="set foreign_key_checks=1";
    mysqli_query($db, $sql);
   
    setcookie("n_cart",""); //장바구니에서 제품 수 삭제.
    echo("<script>location.href='order_ok.php'</script>");

?>