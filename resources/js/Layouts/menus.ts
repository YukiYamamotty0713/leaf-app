interface Route {
    title: string;
    route: string;
    href: string;
}

export const routes: Route[] = [
    { title: "TOP", route: 'dashboard.index', href:"/dashboard" },
    { title: "単語を登録", route: 'register-words.index', href:"/register-words" },
    { title: "単語帳", route: 'mywords.index', href:"/mywords" },
    { title:"達成語録", route: 'accomplished-words.index', href:"/accomplished-words"},
];