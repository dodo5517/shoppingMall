<?
$cart = $_COOKIE["cart"];
$n_cart = $_COOKIE["n_cart"];
$kind = $_REQUEST ["kind"];
$pos =$_REQUEST["pos"];

$id = $_REQUEST["id"];
$num = $_REQUEST["num"];
$opts_id1=$_REQUEST["opts1"];
$opts_id2=$_REQUEST["opts2"];
if(!$opts_id2) $opts_id2=0;

if (!$n_cart) $n_cart=0;   // 제품개수 0으로 초기화
switch ($kind) {
     case "insert":      // 장바구니 담기
          $n_cart++; //제품개수 1 증가 
          $cart[$n_cart] = implode("^", array($id, $num, $opts_id1, $opts_id2)); //제품정보 합치기
          setcookie("cart[$n_cart]", $cart[$n_cart]); // 제품정보, 개수($cart[$n_cart], $n_cart) 쿠키로 저장.
          setcookie("n_cart", $n_cart);
          break;
     case "order":      // 바로 구매하기
         $n_cart++; //제품개수 1 증가 
         $cart[$n_cart] = implode("^", array($id, $num, $opts_id1, $opts_id2)); //제품정보 합치기
         setcookie("cart[$n_cart]", $cart[$n_cart]); // 제품정보, 개수($cart[$n_cart], $n_cart) 쿠키로 저장.
         setcookie("n_cart", $n_cart);
         break;
     case "delete":      // 제품삭제.
         setcookie("cart[$pos]",""); //쿠키 삭제.
         break;
     case "update":     // 수량 수정
          list($id, $old_num, $opts_id1, $opts_id2)=explode("^",$cart[$pos]); //값에서 제품번호, 옵션값들 알아내기.
          $cart[$pos] = implode("^", array($id, $num, $opts_id1, $opts_id2));//수정된 수량으로 제품정보 다시 합치기.
          setcookie("cart[$pos]", $cart[$pos]);//수정된 제품정보를 $cart[$pos] 쿠키에 다시 저장.
          break;
     case "deleteall":    // 장바구니 전체 비우기
          for($i=1;$i<=$n_cart;$i++)
             { if ($cart[$i]) setcookie("cart[$i]",""); }//i번째 제품이 있는 경우 cookie값 삭제.
          setcookie("n_cart",""); // 쿠키값을 0으로 초기화
 }
 
 if ($kind=="order")
     echo("<script>location.href='order.php'</script>");//주문/배송지 입력 화면(order.php)으로 이동.
 else
     echo("<script>location.href='cart.php'</script>");//장바구니 화면(cart.php)으로 이동.

?>