export interface Dataset {
    backgroundColor: string[];
    data: number[];
    borderWidth: number;
}
// 折れ線グラフのデータ設定
export const getData = (labels: string[], registerCounts: number[],deleteCounts:number[]) => {
    return {
      labels: labels,
      datasets: [
        {
          label: '登録数',  // ラベル
          data: registerCounts,     // 活動データ
          borderColor: 'rgb(75, 192, 192)',  // 線の色
          backgroundColor: 'rgba(75, 192, 192, 0.2)',  // 塗りつぶしの色
          fill: true,  // 塗りつぶし
          tension: 0.4,  // 曲線の滑らかさ
        },
        {
          label: '達成数',  // ラベル
          data: deleteCounts,     // 活動データ
          borderColor: 'rgb(255, 99, 132)',  // 線の色
          backgroundColor: 'rgba(255, 99, 132, 0.2)',  // 塗りつぶしの色
          fill: true,  // 塗りつぶし
          tension: 0.4,  // 曲線の滑らかさ
        },
      ],
    };
  };


    // グラフのオプション設定
    export const options = {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: 'Weekly Activity',  // タイトル
          },
          tooltip: {
            mode: 'index' as const,
            intersect: false,
          },
        },
        scales: {
          x: {
            type: 'category' as const,
            reverse: true,
            ticks: {
                maxRotation: 60,// ラベルの最大回転角度を45度に設定
                minRotation: 60, // ラベルの最小回転角度を45度に設定
              },
              grid: {
                display: false, // x軸のグリッド線を非表示
              },
          },
          y: {
            beginAtZero: true,
            grid: {
                display: false, // x軸のグリッド線を非表示
              },
          },
        },
      };
