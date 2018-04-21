<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <link rel="stylesheet" href="css/main.css" />
        <link rel="stylesheet" href="css/common.css" />
        <meta charset="UTF-8">
        <script src="scripts/navigation.js"></script>
        <title></title>
    </head>
    <body>
        <table id="blocks">
            <tr>
                <td id="navArea">
                    <img src="images/logo.png" id="logo" alt="D-WARP" />
                    <h2>Navigation</h2>
                    <h4>Queries</h4>
                    <ul>
                        <li>
                            <a href="javascript:navFrame('showall.php')">Show Full Log</a>
                        </li>
                        <li>
                            <a href="javascript:navFrame('searchcall.php')">Search By Call Sign</a>
                        </li>
                        <li>
                            <a href="javascript:navFrame('searchgrid.php')">Search By Grid Square</a>
                        </li>
                    </ul>
                    <h4>Analyze</h4>
                    <ul>
                        <li>
                            <a href="javascript:navFrame('statoverview.php')">Overview</a>
                        </li>
                        <li>
                            <a href="javascript:navFrame('graphbuilder.php')">Generate Graphs</a>
                        </li>
                    </ul>
                    <h4>Settings</h4>
                    <ul>
                        <li>
                            <a href="javascript:navFrame('csvexport.php')">Export Data As CSV</a>
                        </li>
                        <li>
                            <a href="javascript:navFrame('about.php')">About D-WARP</a>
                        </li>
                    </ul>
                </td>
                <td id="contentArea">
                    <iframe id="contentFrame"></iframe>
                </td>
            </tr>
        </table>
        <?php
        // put your code here
        ?>
    </body>
</html>
