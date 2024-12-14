export interface Dataset {
    backgroundColor: string[];
    data: number[];
    borderWidth: number;
}

export const getData = (
    labels:string[],
    data:number[],
    colors:string[],
) => {
 
    return {
    labels: labels,
    datasets: [
        {
            backgroundColor: colors,
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
            display: false
        },
        borderWidth: 0
    }
};
