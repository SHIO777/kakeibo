import Chart from "chart.js/auto";

const ctx = document.getElementById("myChart").getContext("2d");
// const myChart = new Chart(ctx, {
//     type: "bar",
//     data: {
//         labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
//         datasets: [
//             {
//                 label: "# of Votes",
//                 data: [12, 19, 3, 5, 2, 3],
//                 backgroundColor: [
//                     "rgba(255, 99, 132, 0.2)",
//                     "rgba(54, 162, 235, 0.2)",
//                     "rgba(255, 206, 86, 0.2)",
//                     "rgba(75, 192, 192, 0.2)",
//                     "rgba(153, 102, 255, 0.2)",
//                     "rgba(255, 159, 64, 0.2)",
//                 ],
//                 borderColor: [
//                     "rgba(255, 99, 132, 1)",
//                     "rgba(54, 162, 235, 1)",
//                     "rgba(255, 206, 86, 1)",
//                     "rgba(75, 192, 192, 1)",
//                     "rgba(153, 102, 255, 1)",
//                     "rgba(255, 159, 64, 1)",
//                 ],
//                 borderWidth: 1,
//             },
//         ],
//     },
//     options: {
//         scales: {
//             y: {
//                 beginAtZero: true,
//             },
//         },
//     },
// });

// Laravelのチャートデータ取得処理の呼び出し
// axios
//     .get("/chart-get")
//     .then((response) => {
//         // Chartの更新
//         myChart.data.datasets[0].data = response.data;
//         myChart.update();
//     })
//     .catch(() => {
//         alert("失敗しました");
//     });

function getChart() {
    $.ajax({
        type: "get",
        url: "/getdata",
        dataType: "json",
    })
        // success
        .done((res) => {
            //something
            console.log(res);
        })
        // fail
        .fail((error) => {
            console.log(error.statusText);
        });
};