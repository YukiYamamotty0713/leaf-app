import {
    faHome,
    faPlus,
    faBook,
    faTrophy
  } from '@fortawesome/free-solid-svg-icons';

  interface Route {
      title: string;
      name: string;
      route: string; // route 関数が文字列を返す想定
      icon: any; // Font Awesome アイコンのため
  }

export const routes: Route[]= [
        { title: "TOP", name: "dashboard.index", route: route("dashboard.index"), icon: faHome },
        { title: "単語を登録", name: "register-words.index", route: route("register-words.index"), icon: faPlus },
        { title: "単語帳", name: "mywords.index", route: route("mywords.index"), icon: faBook },
        { title: "達成語録", name: "accomplished-words.index", route: route("accomplished-words.index"), icon: faTrophy },
];

  // ログアウト用の情報（必要な場合に使用）
  export const logoutInfo = {
      title: "ログアウト",
      href: "/logout",
      icon: faHome // import した faRightFromBracket などを使用できます
  };
