<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Highcharts Example</title>

    <script type="text/javascript" src="../JS/jquery-1.9.1.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#container').highcharts({
                data: {
                    table: document.getElementById('datatable')
                },
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Data extracted from a HTML table in the page'
                },
                yAxis: {
                    allowDecimals: false,
                    title: {
                        text: 'Units'
                    }
                },
                tooltip: {
                    formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                            this.y +' '+ this.x.toLowerCase();
                    }
                }
            });
        });
    </script>
</head>
<body>
<script src="../JS/highcharts.js"></script>
<script src="../JS/data.js"></script>
<script src="../JS/exporting.js"></script>

<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>

<table id="datatable">
    <thead>
    <tr>
        <th></th>
        <th>Jane</th>
        <th>John</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th>Apples<br/>1<br/>2</th>
        <td>3</td>
        <td>4</td>
    </tr>
    <tr>
        <th>Pears<br/>1<br/>2</th>
        <td>2</td>
        <td>0</td>
    </tr>
    <tr>
        <th>Plums<br/>1<br/>2</th>
        <td>5</td>
        <td>11</td>
    </tr>
    <tr>
        <th>Bananas<br/>1<br/>2</th>
        <td>1</td>
        <td>1</td>
    </tr>
    <tr>
        <th>Oranges<br/>1<br/>2</th>
        <td>2</td>
        <td>4</td>
    </tr>
    </tbody>
</table>
</body>
</html>
