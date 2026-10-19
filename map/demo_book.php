<!--[if !IE]><!--><script>  
if (/*@cc_on!@*/false) {  
document.documentElement.className+=' ie10';  
}  
</script><!--<![endif]-->   

<?php
header('Content-Type: text/html; charset=utf-8');
include("db.inc.php");



?>
<?php 
    $conn = mysql_connect("localhost", getenv("DB_USER"), getenv("DB_PASS"));
    //定義每次顯示的數量
    $listnum = 25 ;
    
    if(@mysql_select_db("storybook", $conn))
     {
      //指定提取資料的校對字元表
      mysql_query("set character set utf-8");
      //資料庫存在,建立SQL命令字串
      $SQL="SELECT * FROM book WHERE book_level2 = '{$_GET['category']}' ";
      //將回傳結果存放於變數中
      $datalist=mysql_query($SQL);
      //取得欄位數量
      $fieldnum=mysql_num_fields($datalist);
      //取得資料錄數量
      $rowsnum=mysql_num_rows($datalist);
      //計算總共有多少分頁
      if (($rowsnum / $listnum) >intval($rowsnum / $listnum))
       {
        $TotalPage=intval($rowsnum / $listnum)+1;
       }
      else
       {
        $TotalPage=intval($rowsnum / $listnum);
       }
      

//決定開始顯示的分頁
//若未指定分頁則預設顯示第一頁
if (! isset($_REQUEST["ToPage"])) 
{
  $GoPage=1;
}
//若指定分頁數小於1則預設顯示第一頁
else if ($_REQUEST["ToPage"]<1) 
{
  $GoPage=1;
}
//若指定指定的分頁超過總分頁數則顯示最後一頁
else if ($_REQUEST["ToPage"]>$TotalPage)
{
  $GoPage=$TotalPage;
}
else
{
$GoPage=$_REQUEST["ToPage"];
}
//將作用中資料錄位置移到分頁的第一筆資料錄上來開始顯示內容
  mysql_data_seek($datalist,($GoPage-1)*$listnum);      
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>書籍管理</title>
    <link rel="stylesheet" href="css/tree.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/panel.css" >  
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,400italic'>
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css'>
    <script src="js/prefixfree.min.js"></script>
  </head>

  <body>
    <header role="banner">
  <h1>圓夢繪本網</h1>
  <ul class="utilities">
    <li class="users"><a href="#">My Account</a></li>
    <li class="logout warn"><a href="">Log Out</a></li>
  </ul>
</header>

<nav role='navigation'>
<?php include("_menu_tree.php"); ?>
</nav>

<main role="main">


  <section class="panel important">
    <h2>書籍管理</h2>
    <p>&nbsp;</p>
     <div id="btn_bookadd"><a href='book_add.html'>回場館</a></div> 
     <ul>
      <li><?php  echo "共$rowsnum 筆資料;共$TotalPage 張分頁";?></li>
    </ul>
      
    <hr />  
   
  

<p></p>

<?php 
echo "<div>";
echo "<ul class='clearfix'>";
 for ($y=0;$y<$rowsnum;$y++)  
          {   //將資料錄轉換為欄位陣列集合
            $fielddatas=mysql_fetch_array($datalist);
             //輸出欄位資料
echo "<li class='item'>";
echo "<span>
	  <img src='../img/books/{$fielddatas['info_id']}/{$fielddatas['info_id']}_P01.jpg' width='150' height=120'></span><br/>
	  
	  <span class='itembox'>{$fielddatas['book_name']}</span>
	  <a></a>
	  </li>";
  	  }	  
echo "</ul>";
echo "</div>";
?>


<center>
  <?php 
for ($I=1; $I<=$TotalPage; $I++)
{
//如果非正在顯示的分頁則建立頁碼連結
   IF ($I != $GoPage )
      { 
      $myURL=$_SERVER["PHP_SELF"] . "?ToPage=";
      echo "<a href=" . $myURL . $I . ">" . $I . "</a>|" ;
      }
//如果是正在顯示的方頁則單純顯示頁碼
   else
      { 
      echo $I . "|" ;
      }
}
?>
</center>
<br/>
<?php 
     }
    else
     {
      echo "資料庫不存在";
     } 
?>

  </section>

</main>

<footer role="contentinfo">隱私/著作權聲明｜訂閱/取消電子報｜聯絡我們 版權聲明Copyright © 2016 NTUT ixd. All Rights Reserved</footer>
    
 <p>&nbsp;  </p>
 <p>
   <script src="js/index.js"></script>
 </p>
    
  </body>
</html>

 <script>
function check()
{
if (!confirm("確認刪除!"))
return false;
}
</script>