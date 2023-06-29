import Chart from "chart.js/auto";
import axios from 'axios';

//表示する日数
const days = 30;

let lastWeek = [];
for(let i=0; i<days; i++){
  let date = new Date();
  
  date.setDate(date.getDate() - i);
  lastWeek.unshift((date.getMonth() + 1 )+'/'+date.getDate());
}

//体重のグラフ
const ctx = document.getElementById("myChart").getContext("2d");
const myChart = new Chart(ctx, {
    type: "line",
    data: {
        labels: lastWeek,
        
        datasets: [
            {
                label: "体重",
                borderColor: "rgb(246, 109, 109)",
                backgroundColor: "rgba(246, 109, 109, 0.5)",
            },
        ],
    }
});

//体脂肪率のグラフ
const ctx2 = document.getElementById("myChart2").getContext("2d");
const myChart2 = new Chart(ctx2, {
    type: "line",
    data: {
        labels: lastWeek,
        datasets: [
            {
                label: "体脂肪",
                borderColor: "rgb(85, 202, 227)",
                backgroundColor: "rgba(85, 202, 227, 0.5)",
            },

        ],
    }
});

axios
  .get("/chart-get")
  .then((response) => {
    myChart.data.datasets[0].data = response.data.data1;
    console.log(response.data.data1);
    myChart2.data.datasets[0].data = response.data.data2;
    myChart.update();
    myChart2.update();
  })
  .catch(() => {
    alert("データの取得に失敗しました");
  });

