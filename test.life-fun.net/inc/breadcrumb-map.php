<?php
/* パンくずの中間階層の表示名辞書 BREADCRUMB_MAP（定数。パス => 表示名）。inc/breadcrumb.php が読み込む。
   ・値は表示パンくず（.breadcrumb）とJSON-LD（BreadcrumbList）の両方に使われる
   ・各ページ自身の名前は辞書ではなく、ページ側の $bcName で渡す
   ・新しいセクション（中間階層）を追加したら、ここにも追記する
     （辞書に無い祖先パスがあると breadcrumb.php が E_USER_WARNING を出す） */
if (!defined("BREADCRUMB_MAP")) {
    define("BREADCRUMB_MAP", [
        '/articles/'                       => '占い解説ガイド',
        '/articles/calendar/'              => '開運カレンダーとは',
        '/articles/calendar/birthflower/'  => '誕生花とは',
        '/articles/calendar/birthflower/jan/' => '1月の誕生花とは',
        '/articles/calendar/birthflower/feb/' => '2月の誕生花とは',
        '/articles/calendar/birthflower/mar/' => '3月の誕生花とは',
        '/articles/calendar/birthflower/apr/' => '4月の誕生花とは',
        '/articles/calendar/birthflower/may/' => '5月の誕生花とは',
        '/articles/calendar/birthflower/jun/' => '6月の誕生花とは',
        '/articles/calendar/birthflower/jul/' => '7月の誕生花とは',
        '/articles/calendar/birthflower/aug/' => '8月の誕生花とは',
        '/articles/calendar/birthflower/sep/' => '9月の誕生花とは',
        '/articles/calendar/birthflower/oct/' => '10月の誕生花とは',
        '/articles/calendar/birthflower/nov/' => '11月の誕生花とは',
        '/articles/calendar/birthflower/dec/' => '12月の誕生花とは',
        '/articles/calendar/birthstone/'   => '誕生石とは',
        '/articles/calendar/gogyo/'        => '陰陽五行とは',
        '/articles/calendar/kichijitsu/'   => '特別な吉日とは',
        '/articles/calendar/moon/'         => '月の満ち欠けとは',
        '/articles/calendar/rokuyo/'       => '六曜とは',
        '/articles/guardian/'              => '守護霊ガイド',
        '/articles/kyusei/'                => '九星気学',
        '/articles/love/'                  => '恋愛傾向診断',
        '/articles/love/blood/'            => '血液型×恋愛',
        '/articles/love/bundle/'           => '恋愛タイプ（Bundle）',
        '/articles/love/guide/'            => '使い方ガイド',
        '/articles/love/mbti-blood/'       => 'MBTI×血液型',
        '/articles/love/mbti/'             => 'MBTI×恋愛',
        '/articles/love/seiza/'            => '星座×恋愛',
        '/articles/love/style/'            => '恋愛スタイル指標',
        '/articles/love/tendency/'         => '推定傾向指標',
        '/articles/mbti/'                  => 'MBTI×星座の組み合わせとは',
        '/articles/numerology/'            => '数秘術解説',
        '/articles/sanmei/'                => '算命学とは',
        '/articles/seiza/'                 => '西洋占星術とは',
        '/articles/shichu/'                => '四柱推命解説',
        '/articles/tarot/'                 => 'タロット解説',
    ]);
}
