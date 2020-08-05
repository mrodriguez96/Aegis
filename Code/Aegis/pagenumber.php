<!--
Webpage Name:pagenumber.php
Main Developer: CJ Conti
Primary Function:This function is used to handle page numbers on different pages.
-->
<?php
require("sessionstart.php");
$page=1;
$offset=0;
if(isset($_GET["page"]))
{
  $page=$_GET["page"];
  if($page<1)
  {
    $page=1;
  }
  $offset=($page-1)*10;
}
function showpages($page,$numberobjects)
{
  $numfunctioninputs=func_num_args();
  if($numfunctioninputs==2)
  {
    $pagesshown=0;
    if($numberobjects>10)
    {
      print("<table><tbody><tr>");
      print("<td>Page</td>");
      print("<td><form>");
      print("<input type='hidden' name='page' value='1'>");
      print("<button>1</button>");
      print("</form></td>");
      $i=0;
      while($pagesshown<5&&($pagesshown+1)*10<$numberobjects)
      {
        if($page+$i-2>1)
        {
          $curpage=($page)+$i-2;
          print("<td><form>");
          print("<input type='hidden' name='page' value='$curpage'>");
          print("<button>$curpage</button>");
          print("</form></td>");
          $pagesshown+=1;
        }
        $i=$i+1;
      }
      print("<td><form>");
      $lastpage=ceil($numberobjects/10);
      print("<input type='hidden' name='page' value='$lastpage'>");
      print("<button>$lastpage</button>");
      print("</form></td>");
      print("<td>Select Page</td>");
      print("<td><form>");
      print("<input type='number' maxlength='3' size='3' min='1' max='$lastpage' name='page'>");
      print("</td>");
      print("<td>");
      print("<button>Go</button>");
      print("</form></td>");
      print("</tr></tbody></table>");
    }
  }
  else if($numfunctioninputs==4)
  {
    $inputname=func_get_arg(2);
    $inputval=func_get_arg(3);
    $pagesshown=0;
    if($numberobjects>10)
    {
      print("<table><tbody><tr>");
      print("<td>Page</td>");
      print("<td><form>");
      print("<input type='hidden' name='page' value='1'>");
      print("<input type='hidden' name='$inputname' value='$inputval'>");
      print("<button>1</button>");
      print("</form></td>");
      $i=0;
      while($pagesshown<5&&($pagesshown+1)*10<$numberobjects)
      {
          if($page+$i-2>1)
          {
            $curpage=($page)+$i-2;
            print("<td><form>");
            print("<input type='hidden' name='page' value='$curpage'>");
            print("<input type='hidden' name='$inputname' value='$inputval'>");
            print("<button>$curpage</button>");
            print("</form></td>");
            $pagesshown+=1;
          }
          $i=$i+1;
      }
      $lastpage=ceil($numberobjects/10);
      print("<td><form>");
      print("<input type='hidden' name='page' value='$lastpage'>");
      print("<input type='hidden' name='$inputname' value='$inputval'>");
      print("<button>$lastpage</button>");
      print("</form></td>");
      print("<td>Select Page</td>");
      print("<td><form>");
      print("<input type='number' maxlength='3' size='3' min='1' max='$lastpage' name='page'>");
      print("</td>");
      print("<td>");
      print("<button>Go</button>");
      print("</form></td>");
      print("</tr></tbody></table>");

    }
  }
}
?>
