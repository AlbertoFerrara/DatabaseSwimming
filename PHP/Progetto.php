<HTML>
<head>
<style type="text/css"> 
 h1{color:black;}
 #benvenuti{position:absolute;
 top:20%; 
 left:30%; 
 width:500px;
 height:200px;
 padding:0; 
 margin-left:-250px; 
 margin-top: -100px;}
body {background-image:url("swimming.jpg"); text-align:center; }
 p {color: black;}
  @font-face {
   font-family: 'BlackRose';
   src: url('BLACKR~1.ttf') format('truetype');}
#login_form{
    position: absolute;
    top: 25%;
    left: 67%;
    bottom: 20%;
    font-size: 18px;
    text-align: center;
}

</style>

</head>
<body style="margin: 0px;">
<div id="benvenuti" style="width: 40%; float: left;">
<h1> <font face="BlackRose" size=30>Benvenuti nel<br> Gestionale della </font></h1>
<img src="piscina.png" />
</div>
<div id="login_form" width: 20% >   <form name="f1" method="post" action="login.php" id="f1">
                <table >
                   <h1> <font face="BlackRose" size=30> Accedi </font></h1>
                     <tr>
                        <td><input type="text"  name="username" autofocus required />
                        </td>
                    </tr>
                    <tr>
                        <td><input type="password" name="password" required />
                        </td>
                    </tr>
                    <tr >
                        <td>
                        <input type="submit"  name="login" value="Login" style="font-size:18px; " />
                        </td>
                    </tr>
                </table>
            </form> 
</div>

</body>
</HTML>

