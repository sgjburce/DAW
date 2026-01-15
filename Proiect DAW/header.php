<?php
include("config.php");
?>

<html>
<head>
  <title>Catalog Digital</title>
  <style type="text/css">
    h1 {color:white; font-size:24pt; text-align:center;
        font-family:arial,sans-serif}
    .menu {color:white; font-size:12pt; text-align:center;
           font-family:arial,sans-serif; font-weight:bold}
    td {background:black;
        color:white;
    }
    p {color:black; font-size:12pt; text-align:justify;
       font-family:arial,sans-serif}
    p.foot {color:white; font-size:9pt; text-align:center;
            font-family:arial,sans-serif; font-weight:bold}
    a:link,a:visited,a:active {color:white}
  </style>
</head>
<body>

  <!-- page header -->
  <table width="100%" cellpadding="12" cellspacing="0" border="0">
  <tr bgcolor="black">
    <td align="left"><img src="logo.png" alt="logo" height=70 width=70></td>
    <td>
        <h1>Catalog Digital</h1>
    </td>
    <td align="right"><img src="logo.png" alt="logo" height=70 width=70></td>
  </tr>
  </table>

  <!-- menu -->
  <table width="100%" bgcolor="white" cellpadding="4" cellspacing="4">
  <tr >
    <td width="25%">
    <span class="menu"><a href="hit.php">Statistici Website</a></span></td>
    <td width="25%">
    <span class="menu"><a href="Contact.php">Contact</a></span></td>
    <td width="25%">
    <span class="menu"><a href="clasa.php">Clase</a></span></td>
    <td width="25%">
    <span class="menu"><a href="logout.php">Log Out</a></span></td>
  </tr>
  </table>
</body>
</html>