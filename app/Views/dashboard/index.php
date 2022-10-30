<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('dashboard') ?>

<?php 
    while($item = mysqli_fetch_array($retorno)){
        $data[] = $item;
    }
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        let rows=[
          ['Date', 'input', 'output'],
          <?php
            $rows="";
            foreach($data AS $item){
                $rows.="['{$item['date']}',{$item['input']} ,{$item['output']}],";
            }
            ?>
         
        ];
        
        var data = google.visualization.arrayToDataTable([
          ['Date', 'input', 'output'],
          <?php  echo substr($rows, 0, -1); ?>
          
        ]);

        var options = {
          title: 'Moviments',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
    <div id="curve_chart" style="width:90vw; height:80vh"></div>

<?= $this->endSection() ?>