
<?php
$numdays = $_GET["days"];
?>
<head>
  <!-- Plotly.js -->
  <script src="lib/plotly/plotly.min.js"></script>
  <script src="gettotalsgraph.php?days=<?php echo($numdays); ?>"></script>
</head>

<body>
  <div id="myDiv"><!-- Plotly chart will be drawn inside this DIV --></div>
  <script>
      var data = [twentytwohundred, sixthirty, onesixty, eighty, forty, thirty, twenty, seventeen, fifteen, twelve, ten];
      var layout = {
          title: "Daily Number of Reports - Last <?php echo($numdays); ?> Days",
          xaxis: {
              tickangle: -45
          },
          yaxis: {
              title: "Number of Reports"
          },
          barmode: 'group',
      };
      
      Plotly.newPlot('myDiv', data, layout);
  </script>
</body>

