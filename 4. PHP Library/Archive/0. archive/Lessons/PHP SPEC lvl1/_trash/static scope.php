<!DOCTYPE html>
<html lang="ru">
 <head>
  <meta charset="utf-8" />
  <title>  </title>
  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <style>
   article,aside,details,figcaption,figure,
   footer,header,hgroup,menu,nav,section { 
   display:block; 
   }

   
   
  </style>   
 </head>
 <body>

<?php
// info
// => статические переменные не исчезают после конца функции
function myStaticFunc() {
    static $x = 0;
    echo $x;
    $x++;
}
myStaticFunc();
myStaticFunc();
myStaticFunc();


?> 

 </body>
</html>
