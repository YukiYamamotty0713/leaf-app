interface Route {
    title: string;
    route: string;
    href: string;
}

export const routes: Route[] = [
    { title: "ダッシュボード", route: 'dashboard.index', href:"/dashboard" },
    { title: "単語を登録", route: 'register-words.index', href:"/register-words" },
    { title: "マイ単語帳", route: 'mywords.index', href:"/mywords" },
];