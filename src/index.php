<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SSE Test</title>
    <script src="https://cdn.jsdelivr.net/npm/moment"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment"></script>
</head>
<body>
    <h1>サーバー負荷</h1>
    <canvas id="myChart"style="max-height: 300px;"></canvas>
    <script>
        const es = new EventSource("./events.php")
        
        const ctx = document.getElementById("myChart");
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'サーバー負荷',
                    data: [],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'second', // 秒単位で表示
                            displayFormats: {
                                second: 'h:mm:ss a'
                            }
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        es.addEventListener("message", (e) => {
            const data = JSON.parse(e.data);
            
            const timeStamp = moment(data.time).toDate();

            // チャートのデータを更新
            myChart.data.labels.push(timeStamp);
            myChart.data.datasets[0].data.push(data.load);

            myChart.update(); // チャートを更新
        });
    </script>
</body>
</html>
