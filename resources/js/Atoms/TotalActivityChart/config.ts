export interface Dataset {
    backgroundColor: string[];
    data: number[];
    borderWidth: number;
}

export const getData:object = (
    data:number[],
) => {
    return {
    labels: [
        "登録数", "達成数"
    ],
    datasets: [
        {
            backgroundColor: ["rgba(255, 99, 132, 0.75)", "rgba(54, 162, 235, 0.75)"],
            data: data, // 数値型に修正
            borderWidth: 0
        }
    ],
    }
};

export const options:object = {
    cutout: '70%',
    plugins: {
        legend: {
            display: false,
        },
        borderWidth: 0,
    },
    scales: {
        x: {
            grid: {
                display: false, // X軸のグリッドを非表示
            },
        },
        y: {
            grid: {
                display: false, // Y軸のグリッドを非表示
            },
            ticks: {
                callback: (value:number) => {
                    // 値が整数の場合はそのまま表示、そうでない場合は非表示
                    return Number.isInteger(value) 
                           ? value.toString() 
                           : '';
                },
            },
        },
    },
};


