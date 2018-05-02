
<?php
$numdays = $_GET["days"];
?>
<head>
  <!-- Plotly.js -->
  <script src="lib/plotly/plotly.min.js"></script>
  <script src="getavgdistgraph.php?days=<?php echo($numdays); ?>"></script>
</head>

<body>
  <div id="myDiv"></div>
  <script>
      var data = [twentytwohundred, sixthirty, onesixty, eighty, forty, thirty, twenty, seventeen, fifteen, twelve, ten];
      var layout = {
          title: "Daily Average Distance - Last <?php echo($numdays); ?> Days",
          xaxis: {
              tickangle: -45
          },
          yaxis: {
              title: "Avg. Distance (mi)"
          },
          barmode: 'group',
      };
      
      Plotly.newPlot('myDiv', data, layout);
  </script>
</body>

