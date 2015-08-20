<nav><?php
	require_once("traer_opciones_menu.php");
	echo traer_opciones_menu();
?>
</nav>
<style type="text/css">
* {
font-family:sans-serif;
list-style:none;
text-decoration:none;
margin:0;
padding:0;
}
 
.nav > li {
float:left;
}
 
.nav li a {
background:#0c9ba0;
color:#FFF;
display:block;
border:1px solid;
padding:10px 12px;
}
 
.nav li a:hover {
background:#0fbfc6;
}
.nav li ul {
display:none;
position:absolute;
min-width:140px;
}
.nav li:hover > ul {
display:block;
}
.nav li ul li {
position:relative;
}
 
.nav li ul li ul {
right:-140px;
top:0;
}
</style>
