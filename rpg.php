<?php declare(strict_types=1); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-P1EKB3WWX8"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-P1EKB3WWX8');
</script>
<meta charset="UTF-8">
<link rel="canonical" href="https://life-fun.net/rpg.php" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="RPG風の村を歩いてキャラクターに話しかけ、あなたの隠されたジョブ・クラスを占います。">
<title>RPG占い｜あなたの隠されたジョブを探せ</title>
<link rel="icon" type="image/png" href="/favicon.png">
<link rel="apple-touch-icon" href="/favicon.png">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6979913482925873" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DotGothic16&family=Shippori+Mincho:wght@400;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500&family=DM+Mono:wght@300;400&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --void:#08060f;--card:#1e1738;--card2:#251d42;
  --border:rgba(160,130,220,.18);--border2:rgba(160,130,220,.32);
  --gold:#c9a84c;--gold-lt:#e8c96a;--violet:#9b72ef;--violet-lt:#c4a8f5;
  --rose:#e8719a;--teal:#4ecdc4;--text:#e8e2f5;--muted:#8a7db5;
  --ff-serif:'Shippori Mincho',serif;--ff-sans:'Zen Kaku Gothic New',sans-serif;
  --ff-mono:'DM Mono',monospace;--ff-rpg:'DotGothic16',monospace;
}
html{font-size:16px;scroll-behavior:smooth}
body{background:var(--void);color:var(--text);font-family:var(--ff-sans);font-weight:300;line-height:1.8;min-height:100vh}
body::before{content:'';position:fixed;inset:0;background:radial-gradient(ellipse at 20% 20%,rgba(90,50,180,.22) 0%,transparent 55%),radial-gradient(ellipse at 80% 80%,rgba(180,50,100,.14) 0%,transparent 55%);pointer-events:none;z-index:0}
.wrap{position:relative;z-index:1;max-width:900px;margin:0 auto;padding:0 1.2rem}
header{border-bottom:1px solid var(--border);padding:0 1.2rem;position:sticky;top:0;z-index:100;background:rgba(8,6,15,.9);backdrop-filter:blur(12px)}
.header-inner{max-width:900px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;height:54px}
.logo{font-family:var(--ff-serif);font-size:1.1rem;font-weight:700;color:var(--text);text-decoration:none;letter-spacing:.08em}
.logo em{font-style:italic;color:var(--gold)}
.header-nav{display:flex;gap:1.5rem}
.header-nav a{font-family:var(--ff-mono);font-size:.72rem;color:var(--muted);text-decoration:none;letter-spacing:.08em;transition:color .2s}
.header-nav a:hover{color:var(--gold-lt)}
.hero{text-align:center;padding:3rem 1rem 2rem;border-bottom:1px solid var(--border);margin-bottom:2rem}
.hero-eyebrow{font-family:var(--ff-mono);font-size:.68rem;letter-spacing:.25em;color:var(--gold);text-transform:uppercase;margin-bottom:1rem;display:block}
.hero h1{font-family:var(--ff-rpg);font-size:clamp(1.4rem,4vw,2.2rem);font-weight:400;line-height:1.4;letter-spacing:.06em;background:linear-gradient(135deg,var(--gold-lt) 0%,var(--violet-lt) 50%,var(--teal) 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;margin-bottom:.5rem}
.hero-sub{font-size:.9rem;color:var(--muted);letter-spacing:.04em;line-height:1.7}

/* ── RPGゲームエリア ── */
.game-wrap{background:var(--card);border:1px solid var(--border);border-radius:16px;overflow:hidden;margin-bottom:2rem;position:relative}
.game-wrap::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,var(--gold),var(--violet),var(--teal))}

/* ── ステータスバー ── */
.status-bar{background:rgba(0,0,0,.4);padding:.75rem 1.5rem;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid var(--border);flex-wrap:wrap;gap:.5rem}
.status-name{font-family:var(--ff-rpg);font-size:.85rem;color:var(--gold-lt)}
.status-count{font-family:var(--ff-rpg);font-size:.78rem;color:var(--teal)}
.progress-dots{display:flex;gap:.3rem}
.dot{width:10px;height:10px;border-radius:50%;border:1px solid var(--border2);background:transparent;transition:background .3s}
.dot.filled{background:var(--gold)}
.dot.active{background:var(--teal);box-shadow:0 0 6px var(--teal)}

/* ── マップ ── */
.map-area{padding:1.5rem;display:grid;grid-template-columns:repeat(2,1fr);gap:.75rem}
.char-btn{
  background:rgba(155,114,239,.06);border:1px solid var(--border);
  border-radius:10px;padding:1rem;cursor:pointer;
  transition:background .2s,border-color .2s,transform .1s;
  text-align:left;position:relative;
}
.char-btn:hover{background:rgba(155,114,239,.14);border-color:var(--border2);transform:translateY(-1px)}
.char-btn.visited{border-color:var(--gold);background:rgba(201,168,76,.08)}
.char-btn.disabled{opacity:.4;cursor:default;pointer-events:none}
.char-btn.final-btn{border-color:var(--teal);background:rgba(78,205,196,.08);grid-column:1/-1}
.char-btn.final-btn:hover{background:rgba(78,205,196,.15)}
.char-icon{font-size:1.8rem;margin-bottom:.4rem;display:block}
.char-name{font-family:var(--ff-rpg);font-size:.85rem;color:var(--gold-lt);margin-bottom:.2rem}
.char-loc{font-family:var(--ff-mono);font-size:.6rem;color:var(--muted);letter-spacing:.08em}
.char-badge{
  position:absolute;top:.5rem;right:.5rem;
  font-family:var(--ff-rpg);font-size:.6rem;
  background:var(--gold);color:#000;
  border-radius:4px;padding:.1rem .4rem;
}
.char-badge.visited-badge{background:var(--teal)}

/* ── ダイアログウィンドウ ── */
.dialog-area{display:none;border-top:1px solid var(--border);background:rgba(0,0,0,.5);padding:1.5rem}
.dialog-area.show{display:block}
.dialog-box{
  background:#0a0818;border:2px solid var(--violet);
  border-radius:4px;padding:1.25rem 1.5rem;margin-bottom:1rem;
  position:relative;min-height:80px;
}
.dialog-box::before{content:'▼';position:absolute;bottom:-.8rem;left:50%;transform:translateX(-50%);color:var(--violet);font-size:.8rem}
.dialog-speaker{font-family:var(--ff-rpg);font-size:.75rem;color:var(--gold);margin-bottom:.5rem}
.dialog-text{font-family:var(--ff-rpg);font-size:.85rem;color:var(--text);line-height:1.9;letter-spacing:.05em}
.dialog-choices{display:flex;flex-direction:column;gap:.5rem}
.choice-btn{
  background:rgba(155,114,239,.1);border:1px solid var(--border2);
  border-radius:6px;padding:.65rem 1rem;
  font-family:var(--ff-rpg);font-size:.8rem;color:var(--violet-lt);
  cursor:pointer;text-align:left;transition:background .2s,border-color .2s;
}
.choice-btn:hover{background:rgba(155,114,239,.25);border-color:var(--violet)}
.choice-btn::before{content:'▶ ';color:var(--gold)}
.close-dialog-btn{
  width:100%;background:none;border:1px solid var(--border);
  border-radius:6px;padding:.55rem;
  font-family:var(--ff-rpg);font-size:.75rem;color:var(--muted);
  cursor:pointer;margin-top:.5rem;transition:color .2s;
}
.close-dialog-btn:hover{color:var(--text)}

/* ── 結果 ── */
.result-area{display:none;padding:2rem}
.result-area.show{display:block}
.result-fanfare{text-align:center;margin-bottom:1.5rem}
.result-fanfare-text{font-family:var(--ff-rpg);font-size:.75rem;color:var(--gold);letter-spacing:.2em;margin-bottom:.5rem}
.result-job-badge{display:inline-block;font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.2em;color:var(--violet-lt);background:rgba(155,114,239,.15);border:1px solid rgba(155,114,239,.3);border-radius:20px;padding:.25rem .9rem;margin-bottom:.75rem}
.result-job-icon{font-size:4rem;display:block;margin-bottom:.5rem}
.result-job-name{font-family:var(--ff-rpg);font-size:1.8rem;color:var(--gold-lt);margin-bottom:.25rem;letter-spacing:.1em}
.result-job-en{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.15em;color:var(--muted);margin-bottom:1rem}
.result-desc-box{background:rgba(0,0,0,.4);border:1px solid var(--border);border-radius:8px;padding:1.25rem;margin-bottom:1.25rem}
.result-desc{font-family:var(--ff-rpg);font-size:.82rem;line-height:2;color:var(--text)}
.result-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:.6rem;margin-bottom:1.25rem}
.stat-item{background:var(--card2);border:1px solid var(--border);border-radius:8px;padding:.75rem;text-align:center}
.stat-label{font-family:var(--ff-rpg);font-size:.6rem;color:var(--muted);margin-bottom:.3rem}
.stat-bar-wrap{height:6px;background:rgba(160,130,220,.15);border-radius:3px;margin-bottom:.3rem;overflow:hidden}
.stat-bar{height:6px;border-radius:3px;background:linear-gradient(90deg,var(--violet),var(--teal))}
.stat-val{font-family:var(--ff-rpg);font-size:.75rem;color:var(--gold-lt)}
.rare-badge{display:inline-block;font-family:var(--ff-rpg);font-size:.65rem;color:#000;background:linear-gradient(90deg,var(--gold),var(--gold-lt));border-radius:4px;padding:.2rem .6rem;margin-left:.5rem;vertical-align:middle}
.retry-btn{width:100%;background:none;border:1px solid var(--border2);border-radius:8px;padding:.65rem;font-family:var(--ff-rpg);font-size:.78rem;color:var(--muted);cursor:pointer;margin-top:.75rem;transition:color .2s,border-color .2s}
.retry-btn:hover{color:var(--text);border-color:var(--violet)}

/* ── ヒント ── */
.hint-box{background:rgba(78,205,196,.06);border:1px solid rgba(78,205,196,.2);border-radius:10px;padding:.9rem 1.2rem;margin:0 1.5rem 1.5rem;font-family:var(--ff-rpg);font-size:.75rem;color:var(--teal);line-height:1.8}

/* ── AdSense ── */
.adsense-space{min-height:90px;background:rgba(255,255,255,.02);border:1px dashed rgba(255,255,255,.07);border-radius:8px;margin:1.5rem 0;display:flex;align-items:center;justify-content:center;font-family:var(--ff-mono);font-size:.6rem;color:rgba(255,255,255,.08);letter-spacing:.1em}
.adsense-space::after{content:'AD SPACE'}
footer{border-top:1px solid var(--border);padding:2rem;text-align:center;font-family:var(--ff-mono);font-size:.68rem;color:var(--muted);letter-spacing:.08em;margin-top:2rem}
footer a{color:var(--muted);text-decoration:none}
footer a:hover{color:var(--gold)}
.sp-menu-btn{display:none}
.sp-dropdown{display:none}
@media(max-width:768px){
  .header-nav{display:none}
  .sp-menu-btn{display:flex;align-items:center;gap:.4rem;font-family:var(--ff-mono);font-size:.75rem;letter-spacing:.08em;color:var(--muted);background:none;border:1px solid var(--border);border-radius:6px;padding:.35rem .8rem;cursor:pointer;transition:color .2s,border-color .2s}
  .sp-menu-btn:hover{color:var(--text);border-color:var(--border2)}
  .sp-dropdown{display:none;position:absolute;top:54px;right:1.2rem;background:rgba(8,6,15,.97);border:1px solid var(--border2);border-radius:12px;overflow:hidden;z-index:200;min-width:180px;backdrop-filter:blur(16px)}
  .sp-dropdown.open{display:block}
  .sp-dropdown a{display:block;padding:.85rem 1.25rem;font-family:var(--ff-mono);font-size:.78rem;letter-spacing:.08em;color:var(--muted);text-decoration:none;border-bottom:1px solid var(--border);transition:color .2s,background .2s}
  .sp-dropdown a:last-child{border-bottom:none}
  .sp-dropdown a:hover{color:var(--gold-lt);background:rgba(201,168,76,.08)}
  .sp-dropdown span{display:block;padding:.85rem 1.25rem;font-family:var(--ff-mono);font-size:.78rem;letter-spacing:.08em;color:var(--text);border-bottom:1px solid var(--border)}
  .sp-dropdown span:last-child{border-bottom:none}
  .map-area{grid-template-columns:1fr}
  .result-stats{grid-template-columns:1fr 1fr}
}
</style>
</head>
<body>

<header>
  <div class="header-inner">
    <a href="/" class="logo">占い<em>Portal</em></a>
    <nav class="header-nav">
      <a href="/">トップ</a>
      <a href="/tarot.php">タロット</a>
      <a href="/calendar.php">カレンダー</a>
      <a href="/mbti.php">MBTI×星座</a>
      <a href="/numerology.php">数秘術</a>
      <a href="/kyusei.php">九星気学</a>
      RPG占い
    </nav>
    <button class="sp-menu-btn" onclick="toggleSpMenu()">☰ メニュー</button>
    <div class="sp-dropdown" id="spDropdown">
      <a href="/">トップ</a>
      <a href="/tarot.php">タロット</a>
      <a href="/calendar.php">開運カレンダー</a>
      <a href="/mbti.php">MBTI×星座診断</a>
      <a href="/numerology.php">数秘術診断</a>
      <a href="/kyusei.php">九星気学</a>
      <span>RPG占い</span>
    </div>
  </div>
</header>

<div class="wrap">
  <section class="hero">
    <span class="hero-eyebrow">RPG Fortune</span>
    <h1>あなたの隠されたジョブを探せ</h1>
    <p class="hero-sub">村のキャラクターに話しかけながら冒険し、<br>教会の神父にあなたの真の職業を占ってもらおう。</p>
  </section>

  <div class="adsense-space"><!-- AdSenseコードをここに --></div>

  <div class="game-wrap">
    <!-- ステータスバー -->
    <div class="status-bar">
      <span class="status-name">🗺 ソラリス村</span>
      <div style="display:flex;align-items:center;gap:.75rem">
        <span class="status-count" id="visitCount">0 / 10人に話しかけた</span>
        <div class="progress-dots" id="progressDots"></div>
      </div>
    </div>

    <!-- ヒント -->
    <div class="hint-box" id="hintBox">
      ▶ 村人たちに話しかけよう。最低5人に話しかけると、教会の神父が占いをしてくれる。
    </div>

    <!-- マップ（キャラクター一覧） -->
    <div class="map-area" id="mapArea"></div>

    <!-- ダイアログ -->
    <div class="dialog-area" id="dialogArea">
      <div class="dialog-box">
        <div class="dialog-speaker" id="dialogSpeaker"></div>
        <div class="dialog-text" id="dialogText"></div>
      </div>
      <div class="dialog-choices" id="dialogChoices"></div>
      <button class="close-dialog-btn" onclick="closeDialog()">▶ 話を終える</button>
    </div>

    <!-- 結果 -->
    <div class="result-area" id="resultArea">
      <div class="result-fanfare">
        <div class="result-fanfare-text">✦ 神父の占い結果 ✦</div>
        <div class="result-job-badge" id="rJobBadge"></div>
        <span class="result-job-icon" id="rIcon"></span>
        <div class="result-job-name" id="rName"></div>
        <div class="result-job-en" id="rEn"></div>
      </div>
      <div class="result-desc-box">
        <div class="result-desc" id="rDesc"></div>
      </div>
      <div class="result-stats" id="rStats"></div>
      <button class="retry-btn" onclick="resetGame()">▶ もう一度占う</button>
    </div>
  </div>

  <div class="adsense-space"><!-- AdSenseコードをここに --></div>
</div>

<footer>
  <a href="/">占いポータル トップ</a> &nbsp;/&nbsp;
  <a href="/tarot.php">タロット占い</a> &nbsp;/&nbsp;
  <a href="/calendar.php">開運カレンダー</a> &nbsp;/&nbsp;
  <a href="/mbti.php">MBTI×星座診断</a> &nbsp;/&nbsp;
  <a href="/numerology.php">数秘術診断</a> &nbsp;/&nbsp;
  <a href="/kyusei.php">九星気学</a> &nbsp;/&nbsp;
  RPG占い &nbsp;/&nbsp;
  <a href="/privacy.php">プライバシーポリシー</a> &nbsp;/&nbsp;
  <a href="/profile.php">運営者情報</a> &nbsp;/&nbsp;
  <a href="/contact.php">お問い合わせ</a><br>
  &copy; <?= date('Y') ?> 三星統合鑑定
</footer>

<script>
// ═══════════════════════════════════════════════
// キャラクターデータ
// ═══════════════════════════════════════════════
const CHARS = [
  {
    id:'villager1', name:'村の老婆', icon:'👵', loc:'村の入り口',
    attr:'wisdom',
    dialogs:[
      {text:'お前さん、見かけない顔だね。この村に何の用かい？',
       choices:[
         {text:'強くなりたくてやってきました',score:{battle:2}},
         {text:'知恵を借りたくて',score:{wisdom:2}},
         {text:'ただの旅の途中です',score:{free:2}},
       ]},
      {text:'ふむ、なるほど。お前さんの目には芯の強さがある。きっと大きな使命があるんじゃろう。'},
    ]
  },
  {
    id:'blacksmith', name:'鍛冶屋のゴルド', icon:'⚒️', loc:'鍛冶屋',
    attr:'battle',
    dialogs:[
      {text:'おう！剣でも買いにきたか？それとも防具か？',
       choices:[
         {text:'最強の剣をください！',score:{battle:3}},
         {text:'軽くて動きやすい装備がいい',score:{agility:2}},
         {text:'道具より知恵の方が大事です',score:{wisdom:2}},
       ]},
      {text:'いい目をしてるな。戦場で生き残るのは力だけじゃないが、力なくして守れるものも何もない。'},
    ]
  },
  {
    id:'witch', name:'魔女のシルヴィア', icon:'🧙‍♀️', loc:'森の小屋',
    attr:'magic',
    dialogs:[
      {text:'珍しい来客ね。あなたから不思議なオーラを感じるわ。',
       choices:[
         {text:'魔法を教えてください',score:{magic:3}},
         {text:'占いをしてください',score:{wisdom:2}},
         {text:'薬草が欲しいんです',score:{nature:2}},
       ]},
      {text:'魔力は心の鏡よ。あなたが何を信じるかで、使える力が変わってくる。'},
    ]
  },
  {
    id:'merchant', name:'商人のリカルド', icon:'🪙', loc:'市場',
    attr:'free',
    dialogs:[
      {text:'いらっしゃい！何でも揃ってるよ。今日は何が必要かな？',
       choices:[
         {text:'情報が欲しいです',score:{wisdom:2}},
         {text:'一番高い物を見せてください',score:{battle:1,magic:1}},
         {text:'値切り交渉しましょう',score:{free:3}},
       ]},
      {text:'賢い客は価値がわかる。モノの本当の値段がわかる人間は、世の中をうまく渡れるもんだ。'},
    ]
  },
  {
    id:'knight', name:'騎士団長のアルス', icon:'⚔️', loc:'詰所',
    attr:'battle',
    dialogs:[
      {text:'貴様、何者だ。この村に何の用だ？',
       choices:[
         {text:'仲間になりたいのです',score:{battle:3}},
         {text:'旅の冒険者です',score:{agility:2}},
         {text:'守るべきものがあります',score:{heal:2}},
       ]},
      {text:'その目、気に入った。真の騎士は力だけでなく、守る心を持つ者だ。'},
    ]
  },
  {
    id:'scholar', name:'学者のアルヴィン', icon:'📚', loc:'図書館',
    attr:'wisdom',
    dialogs:[
      {text:'む、本に興味があるのかね？どんな分野が好きかね？',
       choices:[
         {text:'歴史と哲学が好きです',score:{wisdom:3}},
         {text:'魔法の本はありますか',score:{magic:2}},
         {text:'あまり本は読みません',score:{battle:1,agility:1}},
       ]},
      {text:'知識は武器にも盾にもなる。学ぶことをやめた者は、成長することもやめた者だ。'},
    ]
  },
  {
    id:'healer', name:'癒し手のルナ', icon:'💚', loc:'診療所',
    attr:'heal',
    dialogs:[
      {text:'怪我はない？心の傷でも診てあげるわ。',
       choices:[
         {text:'疲れた心を癒してほしい',score:{heal:3}},
         {text:'強くなりたい',score:{battle:2}},
         {text:'仲間のために強くなりたい',score:{heal:2,battle:1}},
       ]},
      {text:'人を癒す力は、誰の心にも眠っている。大切なのは、その力を誰かのために使おうとする気持ちよ。'},
    ]
  },
  {
    id:'bard', name:'吟遊詩人のフィン', icon:'🎸', loc:'酒場',
    attr:'agility',
    dialogs:[
      {text:'ヤァ！旅人さん！一曲聴いていかないかい？',
       choices:[
         {text:'ぜひ！聴かせてください',score:{free:2,agility:1}},
         {text:'今は急いでいます',score:{battle:1,agility:2}},
         {text:'一緒に歌いましょう',score:{agility:3}},
       ]},
      {text:'旅は歌と笑いで軽くなる。君の足取りには、どこか楽しそうな軽さがあるね。'},
    ]
  },
  {
    id:'king', name:'村の王様', icon:'👑', loc:'小さなお城',
    attr:'wisdom',
    dialogs:[
      {text:'余の城へようこそ。そなた、何か願いがあってきたのであろう？',
       choices:[
         {text:'民のために力を貸してください',score:{heal:2,wisdom:1}},
         {text:'強力な力を授けてください',score:{battle:2,magic:1}},
         {text:'真実を知りたいのです',score:{wisdom:3}},
       ]},
      {text:'賢者は力を求めず、力は賢者を求める。そなたにはその素質がある。'},
    ]
  },
  {
    id:'priest', name:'教会の神父', icon:'⛪', loc:'教会', isFinal:true,
    dialogs:[
      {text:'よく来たな、旅人よ。\n神はすべてを見ておられる。\nあなたが歩んできた道を映し出し、\n真の姿を示してくれるだろう。\n\n占いを始めてよいか？',
       choices:[
         {text:'はい、お願いします',score:{}},
       ]},
    ]
  },
];

// ═══════════════════════════════════════════════
// ジョブデータ
// ═══════════════════════════════════════════════
const JOBS = [
  {id:'hero',     name:'勇者',       en:'HERO',          icon:'⚔️',  rare:false, primary:'battle',  secondary:'wisdom',
   desc:'すべての属性をバランスよく持つ伝説の存在。\n困難を恐れず、仲間のために剣を振るう。\n時代が英雄を必要とするとき、あなたは現れる。',
   stats:{力:90,知:70,速:75,癒:65,運:80}},
  {id:'mage',     name:'魔法使い',   en:'MAGE',          icon:'🔮',  rare:false, primary:'magic',   secondary:'wisdom',
   desc:'古代の知識と強大な魔力を操る学者。\n言葉ひとつで世界を変える力を秘めている。\n知識こそが最大の武器と信じて疑わない。',
   stats:{力:40,知:95,速:60,癒:50,運:85}},
  {id:'warrior',  name:'戦士',       en:'WARRIOR',       icon:'🛡️',  rare:false, primary:'battle',  secondary:'agility',
   desc:'圧倒的な力と鉄壁の守りで前線を支える。\n傷つくことを恐れない鋼の意志を持つ。\n戦場に立つ限り、仲間は倒れない。',
   stats:{力:95,知:50,速:65,癒:45,運:60}},
  {id:'healer',   name:'聖職者',     en:'CLERIC',        icon:'✨',  rare:false, primary:'heal',    secondary:'wisdom',
   desc:'神に仕え、仲間の傷を癒す光の使者。\n戦わずして多くの命を救う真の強さを持つ。\n その優しさが、世界を変える力になる。',
   stats:{力:45,知:80,速:55,癒:95,運:75}},
  {id:'thief',    name:'盗賊',       en:'ROGUE',         icon:'🗡️',  rare:false, primary:'agility', secondary:'free',
   desc:'闇に溶け込み、素早い動きで翻弄する。\nルールより自分の信念で行動する自由人。\n誰も知らない道を、誰より早く走り抜ける。',
   stats:{力:70,知:65,速:95,癒:40,運:90}},
  {id:'bard',     name:'吟遊詩人',   en:'BARD',          icon:'🎵',  rare:false, primary:'free',    secondary:'agility',
   desc:'歌と言葉で仲間を鼓舞し、敵を惑わす。\nどんな場所でも笑顔を絶やさない太陽の存在。\n旅そのものが、あなたの人生の物語になる。',
   stats:{力:55,知:70,速:80,癒:70,運:95}},
  {id:'druid',    name:'ドルイド',   en:'DRUID',         icon:'🌿',  rare:false, primary:'nature',  secondary:'heal',
   desc:'大地と森の精霊と語らう自然の守護者。\n生命の循環を理解し、万物と調和して生きる。\n自然の力を借りて、世界の均衡を守る。',
   stats:{力:60,知:80,速:65,癒:85,運:70}},
  {id:'paladin',  name:'聖騎士',     en:'PALADIN',       icon:'🌟',  rare:false, primary:'battle',  secondary:'heal',
   desc:'剣と祈りを両立させる正義の具現者。\n光の力で悪を断ち、傷ついた者を救う。\n信念と力、どちらも最高水準を誇る。',
   stats:{力:85,知:65,速:60,癒:80,運:75}},
  {id:'summoner', name:'召喚師',     en:'SUMMONER',      icon:'🐉',  rare:false, primary:'magic',   secondary:'free',
   desc:'異界の存在を呼び出し、従わせる変わり者。\nこの世のものではない力を自在に操る。\n孤独に見えて、常に多くの仲間と共にいる。',
   stats:{力:55,知:90,速:65,癒:60,運:80}},
  {id:'ninja',    name:'忍者',       en:'NINJA',         icon:'🥷',  rare:false, primary:'agility', secondary:'battle',
   desc:'影のように素早く、音もなく任務を遂行する。\n感情を見せず、ただ目的のために動く孤高の存在。\nその姿は、見た者の記憶からも消える。',
   stats:{力:80,知:70,速:98,癒:35,運:75}},
  // レアジョブ（特定の組み合わせで出現）
  {id:'sage',     name:'賢者',       en:'SAGE',          icon:'🌙',  rare:true, primary:'wisdom',  secondary:'magic',
   desc:'すべての知識と経験を統合した伝説の存在。\n過去・現在・未来を見通す神の瞳を持つ。\n賢者は語らず、ただ存在するだけで世界を変える。',
   stats:{力:70,知:99,速:65,癒:80,運:90}},
  {id:'darkKnight',name:'暗黒騎士',  en:'DARK KNIGHT',   icon:'🖤',  rare:true, primary:'battle',  secondary:'magic',
   desc:'光を失った場所で生まれた力の体現者。\n憎しみすら力に変えて戦う禁断の存在。\n最も暗い闇の中にこそ、最も強い光が宿る。',
   stats:{力:99,知:70,速:70,癒:30,運:65}},
  {id:'oracle',   name:'神託者',     en:'ORACLE',        icon:'🔯',  rare:true, primary:'wisdom',  secondary:'heal',
   desc:'神の言葉を人々に伝える橋渡しの存在。\n過去の痛みを癒し、未来への道を照らす。\nあなたの言葉には、見えない力が宿っている。',
   stats:{力:50,知:90,速:60,癒:95,運:85}},
  {id:'trickster',name:'トリックスター',en:'TRICKSTER',  icon:'🃏',  rare:true, primary:'free',    secondary:'agility',
   desc:'予測不能な行動で世界をかき回す混沌の使者。\n常識の外側から物事を変える唯一無二の存在。\n誰も予想しない方法で、誰も達成できない奇跡を起こす。',
   stats:{力:70,知:75,速:90,癒:55,運:99}},
  {id:'archmage', name:'大魔導士',   en:'ARCHMAGE',      icon:'⚡',  rare:true, primary:'magic',   secondary:'wisdom',
   desc:'古代魔法の粋を極めた究極の魔術師。\n星々の運行すら操ると言われる伝説の存在。\n千年に一人と言われる才能が、あなたの中に眠っている。',
   stats:{力:55,知:99,速:70,癒:65,運:88}},
];

// ═══════════════════════════════════════════════
// レアジョブ解禁条件
// ═══════════════════════════════════════════════
const RARE_CONDITIONS = [
  {job:'sage',      required:['scholar','witch','king'],    desc:'学者・魔女・王様全員に話しかけた'},
  {job:'darkKnight',required:['blacksmith','knight','witch'],desc:'鍛冶屋・騎士団長・魔女に話しかけた'},
  {job:'oracle',    required:['healer','priest','villager1'],desc:'癒し手・村の老婆に話しかけた'},
  {job:'trickster', required:['merchant','bard','thief'],   desc:'商人・吟遊詩人に話しかけた'},
  {job:'archmage',  required:['witch','scholar','priest'],  desc:'魔女・学者に話しかけた'},
];

// ═══════════════════════════════════════════════
// ゲーム状態
// ═══════════════════════════════════════════════
let visited = new Set();
let scores = {battle:0,magic:0,wisdom:0,heal:0,agility:0,free:0,nature:0};
let currentChar = null;
let currentDialogIdx = 0;

// ═══════════════════════════════════════════════
// 初期化
// ═══════════════════════════════════════════════
function init(){
  visited = new Set();
  scores = {battle:0,magic:0,wisdom:0,heal:0,agility:0,free:0,nature:0};
  currentChar = null;
  currentDialogIdx = 0;
  renderMap();
  updateStatus();
  document.getElementById('dialogArea').classList.remove('show');
  document.getElementById('resultArea').classList.remove('show');
  document.getElementById('mapArea').style.display='grid';
  document.getElementById('hintBox').style.display='block';
}

function renderMap(){
  const map = document.getElementById('mapArea');
  map.innerHTML = '';
  const dots = document.getElementById('progressDots');
  dots.innerHTML = '';
  for(let i=0;i<10;i++){
    const d=document.createElement('div');
    d.className='dot'+(i<visited.size?' filled':'')+(i===visited.size?' active':'');
    dots.appendChild(d);
  }
  CHARS.forEach(c=>{
    const btn=document.createElement('button');
    const isVisited=visited.has(c.id);
    const isFinal=c.isFinal;
    const canFinal=isFinal&&visited.size>=5;
    btn.className='char-btn'+(isVisited?' visited':'')+(isFinal?' final-btn':'')+(isFinal&&!canFinal?' disabled':'');
    btn.innerHTML=`
      <span class="char-icon">${c.icon}</span>
      <div class="char-name">${c.name}${c.rare?'<span class="rare-badge">RARE</span>':''}</div>
      <div class="char-loc">📍 ${c.loc}</div>
      ${isVisited?'<span class="char-badge visited-badge">話した</span>':''}
      ${isFinal&&!canFinal?'<span class="char-badge" style="background:var(--muted)">5人以上必要</span>':''}
    `;
    if((!isFinal||canFinal)&&!isVisited||isFinal&&canFinal){
      btn.onclick=()=>openDialog(c);
    } else if(!isVisited){
      btn.onclick=()=>openDialog(c);
    }
    map.appendChild(btn);
  });
}

function updateStatus(){
  document.getElementById('visitCount').textContent=`${visited.size} / 10人に話しかけた`;
  const dots=document.getElementById('progressDots');
  dots.innerHTML='';
  for(let i=0;i<10;i++){
    const d=document.createElement('div');
    d.className='dot'+(i<visited.size?' filled':'')+(i===visited.size&&visited.size<10?' active':'');
    dots.appendChild(d);
  }
  const hint=document.getElementById('hintBox');
  if(visited.size>=5&&!visited.has('priest')){
    hint.textContent='▶ 5人以上に話しかけた！教会の神父に話しかけて占ってもらおう。';
  } else if(visited.size<5){
    hint.textContent=`▶ あと${5-visited.size}人に話しかけると神父の占いが解放される。`;
  }
}

// ═══════════════════════════════════════════════
// ダイアログ
// ═══════════════════════════════════════════════
function openDialog(char){
  currentChar=char;
  currentDialogIdx=0;
  showDialogStep(0);
  document.getElementById('dialogArea').classList.add('show');
  document.getElementById('dialogArea').scrollIntoView({behavior:'smooth',block:'nearest'});
}

function showDialogStep(idx){
  const dialog=currentChar.dialogs[idx];
  if(!dialog)return;
  document.getElementById('dialogSpeaker').textContent=currentChar.icon+' '+currentChar.name;
  document.getElementById('dialogText').textContent=dialog.text;
  const choicesEl=document.getElementById('dialogChoices');
  choicesEl.innerHTML='';
  if(dialog.choices){
    dialog.choices.forEach(ch=>{
      const btn=document.createElement('button');
      btn.className='choice-btn';
      btn.textContent=ch.text;
      btn.onclick=()=>selectChoice(ch);
      choicesEl.appendChild(btn);
    });
  }
}

function selectChoice(choice){
  if(choice.score){
    Object.entries(choice.score).forEach(([k,v])=>{scores[k]=(scores[k]||0)+v;});
  }
  visited.add(currentChar.id);
  updateStatus();
  if(currentChar.isFinal){
    closeDialog();
    showResult();
    return;
  }
  const nextIdx=currentDialogIdx+1;
  if(nextIdx<currentChar.dialogs.length){
    currentDialogIdx=nextIdx;
    const nextDialog=currentChar.dialogs[nextIdx];
    document.getElementById('dialogText').textContent=nextDialog.text;
    document.getElementById('dialogChoices').innerHTML='';
  } else {
    closeDialog();
    renderMap();
  }
}

function closeDialog(){
  document.getElementById('dialogArea').classList.remove('show');
  renderMap();
}

// ═══════════════════════════════════════════════
// 結果算出
// ═══════════════════════════════════════════════
function showResult(){
  // レアジョブチェック
  let job=null;
  for(const cond of RARE_CONDITIONS){
    if(cond.required.every(id=>visited.has(id))){
      job=JOBS.find(j=>j.id===cond.job);
      break;
    }
  }
  // 通常ジョブ（スコア最大の属性で決定）
  if(!job){
    const topAttr=Object.entries(scores).sort((a,b)=>b[1]-a[1])[0][0];
    const secondAttr=Object.entries(scores).sort((a,b)=>b[1]-a[1])[1][0];
    const candidates=JOBS.filter(j=>!j.rare&&j.primary===topAttr);
    if(candidates.length>0){
      // 2位属性でさらに絞る
      const refined=candidates.find(j=>j.secondary===secondAttr);
      job=refined||candidates[0];
    } else {
      job=JOBS.find(j=>j.id==='hero');
    }
  }
  renderResult(job);
}

function renderResult(job){
  document.getElementById('mapArea').style.display='none';
  document.getElementById('hintBox').style.display='none';
  document.getElementById('dialogArea').classList.remove('show');
  document.getElementById('resultArea').classList.add('show');
  document.getElementById('resultArea').scrollIntoView({behavior:'smooth'});
  document.getElementById('rJobBadge').innerHTML=job.rare?'✦ レアジョブ解禁 ✦':'✦ あなたのジョブ ✦';
  document.getElementById('rIcon').textContent=job.icon;
  document.getElementById('rName').innerHTML=job.name+(job.rare?'<span class="rare-badge">RARE</span>':'');
  document.getElementById('rEn').textContent=job.en;
  document.getElementById('rDesc').textContent=job.desc;
  const statsEl=document.getElementById('rStats');
  statsEl.innerHTML='';
  Object.entries(job.stats).forEach(([label,val])=>{
    const item=document.createElement('div');
    item.className='stat-item';
    item.innerHTML=`
      <div class="stat-label">${label}</div>
      <div class="stat-bar-wrap"><div class="stat-bar" style="width:${val}%"></div></div>
      <div class="stat-val">${val}</div>
    `;
    statsEl.appendChild(item);
  });
}

function resetGame(){
  document.getElementById('resultArea').classList.remove('show');
  document.getElementById('mapArea').style.display='grid';
  document.getElementById('hintBox').style.display='block';
  init();
}

// ═══════════════════════════════════════════════
// スマホメニュー
// ═══════════════════════════════════════════════
function toggleSpMenu(){
  document.getElementById('spDropdown').classList.toggle('open');
}
document.addEventListener('click',function(e){
  if(!e.target.closest('.sp-menu-btn')&&!e.target.closest('.sp-dropdown')){
    document.getElementById('spDropdown').classList.remove('open');
  }
});

init();
</script>
</body>
</html>
