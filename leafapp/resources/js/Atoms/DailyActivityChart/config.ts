export interface Dataset {
    backgroundColor: string[];
    data: number[];
    borderWidth: number;
}

export const getData = (
    data:number[],
) => {
 
    return {
    labels: ["登録数", "削除数"],
    datasets: [
        {
            backgroundColor: ["red","blue"],
            data: data, // 数値型に修正
            borderWidth: 0
        }
    ],
    }
};

export const options: {
    cutout: string;
    plugins: {
        legend: {
            display: boolean;
        };
        borderWidth: number;
    };
} = {
    cutout: '70%',
    plugins: {
        legend: {
            display: true
        },
        borderWidth: 0
    }
};
