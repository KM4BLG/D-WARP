<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="scripts/ajax.js"></script>
        <link rel="stylesheet" href="css/tabledisplay.css" />
        <link rel="stylesheet" href="css/common.css" />
    </head>
    <body>
        <form onsubmit="getFilterByGrid(); return false;">
            Grid:
            <input type="text" id="grid" />
            <input type="submit" value="Search" />
        </form>
        <p><div id="tableArea"></div></p>
    </body>
</html>
