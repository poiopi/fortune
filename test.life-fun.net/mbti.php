<?php
declare(strict_types=1);
?>
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
<link rel="canonical" href="https://life-fun.net/mbti.php" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="MBTI×星座で導く性格診断。10の質問に答えてあなたの本質タイプと星座の組み合わせ運勢を診断します。">
<title>MBTI×星座 性格診断｜三星統合鑑定</title>
<link rel="icon" type="image/png" href="/favicon.png">
<link rel="apple-touch-icon" href="/favicon.png">

<!-- AdSense -->
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6979913482925873" crossorigin="anonymous"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500&family=DM+Mono:wght@300;400&display=swap" rel="stylesheet">

<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --void:    #08060f;
  --card:    #1e1738;
  --card2:   #251d42;
  --border:  rgba(160,130,220,.18);
  --border2: rgba(160,130,220,.32);
  --gold:    #c9a84c;
  --gold-lt: #e8c96a;
  --violet:  #9b72ef;
  --violet-lt:#c4a8f5;
  --rose:    #e8719a;
  --teal:    #4ecdc4;
  --text:    #e8e2f5;
  --muted:   #8a7db5;
  --ff-serif:'Shippori Mincho',serif;
  --ff-sans: 'Zen Kaku Gothic New',sans-serif;
  --ff-mono: 'DM Mono',monospace;
}
html{font-size:16px;scroll-behavior:smooth}
body{
  background:var(--void);
  color:var(--text);
  font-family:var(--ff-sans);
  font-weight:300;
  line-height:1.8;
  min-height:100vh;
}
body::before{
  content:'';position:fixed;inset:0;
  background:
    radial-gradient(ellipse at 20% 20%,rgba(90,50,180,.22) 0%,transparent 55%),
    radial-gradient(ellipse at 80% 80%,rgba(180,50,100,.14) 0%,transparent 55%);
  pointer-events:none;z-index:0;
}
.wrap{position:relative;z-index:1;max-width:900px;margin:0 auto;padding:0 1.2rem}

/* ── HEADER ── */
header{
  border-bottom:1px solid var(--border);padding:0 1.2rem;
  position:sticky;top:0;z-index:100;
  background:rgba(8,6,15,.9);backdrop-filter:blur(12px);
}
.header-inner{max-width:900px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;height:54px}
.logo{font-family:var(--ff-serif);font-size:1.1rem;font-weight:700;color:var(--text);text-decoration:none;letter-spacing:.08em}
.logo em{font-style:italic;color:var(--gold)}
.header-nav{display:flex;gap:1.5rem}
.header-nav a{font-family:var(--ff-mono);font-size:.72rem;color:var(--muted);text-decoration:none;letter-spacing:.08em;transition:color .2s}
.header-nav a:hover{color:var(--gold-lt)}

/* ── HERO ── */
.hero{text-align:center;padding:3rem 1rem 2rem;border-bottom:1px solid var(--border);margin-bottom:2rem}
.hero-eyebrow{font-family:var(--ff-mono);font-size:.68rem;letter-spacing:.25em;color:var(--gold);text-transform:uppercase;margin-bottom:1rem;display:block}
.hero h1{font-family:var(--ff-serif);font-size:clamp(1.8rem,5vw,2.8rem);font-weight:700;line-height:1.2;letter-spacing:.06em;background:linear-gradient(135deg,var(--gold-lt) 0%,var(--violet-lt) 50%,var(--teal) 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;margin-bottom:.5rem}
.hero-sub{font-size:.9rem;color:var(--muted);letter-spacing:.04em;line-height:1.7}

/* ── 診断カード ── */
.shindan-card{
  background:var(--card);
  border:1px solid var(--border);
  border-radius:16px;
  padding:2rem;
  margin-bottom:2rem;
  position:relative;
  overflow:hidden;
}
.shindan-card::before{
  content:'';position:absolute;top:0;left:0;right:0;height:2px;
  background:linear-gradient(90deg,var(--violet),var(--gold),var(--teal));
}

/* ── プログレスバー ── */
.progress-wrap{margin-bottom:1.5rem}
.progress-label{display:flex;justify-content:space-between;font-family:var(--ff-mono);font-size:.65rem;color:var(--muted);margin-bottom:.5rem;letter-spacing:.08em}
.progress-bar{height:3px;background:rgba(160,130,220,.15);border-radius:2px}
.progress-fill{height:3px;background:linear-gradient(90deg,var(--violet),var(--gold));border-radius:2px;transition:width .4s ease}

/* ── 質問 ── */
.q-text{font-family:var(--ff-serif);font-size:1.2rem;font-weight:600;line-height:1.6;color:var(--text);margin-bottom:1.5rem}
.choices{display:flex;flex-direction:column;gap:.75rem}
.choice-btn{
  background:rgba(155,114,239,.06);
  border:1px solid var(--border);
  border-radius:10px;
  padding:1rem 1.25rem;
  text-align:left;
  font-family:var(--ff-sans);
  font-size:.95rem;
  color:var(--text);
  cursor:pointer;
  transition:background .2s,border-color .2s;
  line-height:1.6;
}
.choice-btn:hover{background:rgba(155,114,239,.14);border-color:var(--border2)}
.choice-btn.selected{background:rgba(155,114,239,.2);border-color:var(--violet);color:var(--violet-lt)}

/* ── ナビ ── */
.nav-row{display:flex;justify-content:space-between;align-items:center;margin-top:1.5rem}
.back-btn{
  font-family:var(--ff-mono);font-size:.72rem;color:var(--muted);
  background:none;border:1px solid var(--border);border-radius:6px;
  padding:.4rem .9rem;cursor:pointer;letter-spacing:.06em;transition:color .2s,border-color .2s;
}
.back-btn:hover{color:var(--text);border-color:var(--border2)}
.next-btn{
  font-family:var(--ff-mono);font-size:.75rem;letter-spacing:.08em;
  background:linear-gradient(135deg,var(--violet),rgba(155,114,239,.7));
  border:none;border-radius:8px;padding:.55rem 1.5rem;
  color:#fff;cursor:pointer;transition:opacity .2s;
}
.next-btn:disabled{opacity:.3;cursor:default}
.next-btn:not(:disabled):hover{opacity:.85}
.skip-link{font-family:var(--ff-mono);font-size:.65rem;color:var(--muted);text-align:center;margin-top:1rem;cursor:pointer;letter-spacing:.06em;text-decoration:underline;text-underline-offset:3px}
.skip-link:hover{color:var(--gold)}

/* ── 星座・MBTIグリッド ── */
.select-title{font-family:var(--ff-serif);font-size:1.1rem;font-weight:600;color:var(--gold-lt);margin-bottom:1.2rem}
.seiza-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:.6rem;margin-bottom:1.5rem}
.seiza-btn{
  background:rgba(155,114,239,.06);
  border:1px solid var(--border);
  border-radius:8px;
  padding:.65rem .3rem;
  text-align:center;
  font-family:var(--ff-sans);
  font-size:.82rem;
  color:var(--muted);
  cursor:pointer;
  transition:background .2s,border-color .2s,color .2s;
}
.seiza-btn:hover{background:rgba(155,114,239,.12);color:var(--text)}
.seiza-btn.selected{background:rgba(201,168,76,.15);border-color:var(--gold);color:var(--gold-lt)}
.mbti-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:.5rem;margin-bottom:1.5rem}
.mbti-btn{
  background:rgba(155,114,239,.06);
  border:1px solid var(--border);
  border-radius:8px;
  padding:.6rem .2rem;
  text-align:center;
  font-family:var(--ff-mono);
  font-size:.8rem;
  color:var(--muted);
  cursor:pointer;
  transition:background .2s,border-color .2s,color .2s;
  letter-spacing:.04em;
}
.mbti-btn:hover{background:rgba(155,114,239,.12);color:var(--text)}
.mbti-btn.selected{background:rgba(155,114,239,.2);border-color:var(--violet);color:var(--violet-lt)}
.full-btn{width:100%}

/* ── 結果 ── */
.result-hero{text-align:center;padding:1.5rem 0;border-bottom:1px solid var(--border);margin-bottom:1.5rem}
.result-badge{
  display:inline-block;
  font-family:var(--ff-mono);font-size:.68rem;letter-spacing:.2em;
  color:var(--violet-lt);background:rgba(155,114,239,.15);
  border:1px solid rgba(155,114,239,.3);border-radius:20px;
  padding:.25rem .9rem;margin-bottom:.75rem;
}
.result-type{font-family:var(--ff-serif);font-size:2.2rem;font-weight:700;color:var(--gold-lt);margin-bottom:.25rem;letter-spacing:.06em}
.result-name{font-family:var(--ff-serif);font-size:1.1rem;color:var(--violet-lt);margin-bottom:.75rem}
.result-desc{font-size:.9rem;color:var(--muted);line-height:1.8}

.combo-section{
  background:linear-gradient(135deg,rgba(201,168,76,.08),rgba(155,114,239,.06));
  border:1px solid rgba(201,168,76,.2);
  border-radius:12px;padding:1.25rem 1.5rem;margin-bottom:1.25rem;
}
.combo-eyebrow{font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.15em;color:var(--gold);margin-bottom:.4rem}
.combo-title{font-family:var(--ff-serif);font-size:1.2rem;font-weight:700;color:var(--gold-lt);margin-bottom:.6rem}
.combo-desc{font-size:.88rem;color:var(--text);line-height:1.8}

.lucky-grid{display:grid;grid-template-columns:1fr 1fr;gap:.75rem;margin-top:1rem}
.lucky-item{
  background:var(--card2);border:1px solid var(--border);
  border-radius:10px;padding:.9rem 1rem;
}
.lucky-cat{font-family:var(--ff-mono);font-size:.6rem;letter-spacing:.14em;color:var(--muted);text-transform:uppercase;margin-bottom:.3rem}
.lucky-val{font-family:var(--ff-serif);font-size:1rem;font-weight:600;color:var(--gold-lt)}

.type-list{margin-top:1.25rem}
.type-list-title{font-family:var(--ff-mono);font-size:.65rem;letter-spacing:.12em;color:var(--muted);margin-bottom:.6rem}
.type-tags{display:flex;flex-wrap:wrap;gap:.4rem}
.type-tag{
  font-family:var(--ff-mono);font-size:.7rem;color:var(--muted);
  background:rgba(160,130,220,.08);border:1px solid var(--border);
  border-radius:4px;padding:.2rem .6rem;letter-spacing:.04em;
}

.retry-btn{
  width:100%;font-family:var(--ff-mono);font-size:.72rem;letter-spacing:.1em;
  background:none;border:1px solid var(--border2);border-radius:8px;
  padding:.65rem;color:var(--muted);cursor:pointer;margin-top:.75rem;
  transition:color .2s,border-color .2s;
}
.retry-btn:hover{color:var(--text);border-color:var(--violet)}

/* ── ステップ表示切り替え ── */
.step{display:none}
.step.active{display:block}

/* ── AdSense ── */
.adsense-space{min-height:90px;background:rgba(255,255,255,.02);border:1px dashed rgba(255,255,255,.07);border-radius:8px;margin:1.5rem 0;display:flex;align-items:center;justify-content:center;font-family:var(--ff-mono);font-size:.6rem;color:rgba(255,255,255,.08);letter-spacing:.1em}
.adsense-space::after{content:'AD SPACE'}

/* ── フッター ── */
footer{border-top:1px solid var(--border);padding:2rem;text-align:center;font-family:var(--ff-mono);font-size:.68rem;color:var(--muted);letter-spacing:.08em;margin-top:2rem}
footer a{color:var(--muted);text-decoration:none}
footer a:hover{color:var(--gold)}

@media(max-width:600px){
  .shindan-card{padding:1.25rem}
  .seiza-grid{grid-template-columns:repeat(3,1fr)}
  .mbti-grid{grid-template-columns:repeat(4,1fr)}
  .lucky-grid{grid-template-columns:1fr}
}
/* ======================
   三星鑑定について
====================== */
.about-box{
    max-width:900px;
    margin:2rem auto 3rem;
    padding:2rem;
    background:rgba(255,255,255,.04);
    border:1px solid rgba(255,255,255,.1);
    border-radius:24px;
    backdrop-filter:blur(8px);
}

.about-box h2{
    text-align:center;
    margin-bottom:1.8rem;
    font-size:1.5rem;
    color:#ffe6a8;
}

.about-item{
    display:flex;
    align-items:flex-start;
    gap:1rem;
    margin-bottom:1.5rem;
}

.about-item:last-child{
    margin-bottom:0;
}

.about-item span{
    font-size:1.5rem;
    flex-shrink:0;
}

.about-item p{
    margin:0;
    line-height:1.9;
    color:#ddd;
}

@media(max-width:768px){

    .about-box{
        margin:1.5rem 1rem 2rem;
        padding:1.5rem;
    }

    .about-item{
        gap:.8rem;
    }

    .about-item span{
        font-size:1.3rem;
    }

    .about-box h2{
        font-size:1.2rem;
    }

}
/* ── スマホメニュー ── */
.sp-menu-btn{display:none}
.sp-dropdown{display:none}
@media(max-width:768px){
  .header-nav{display:none}
  .sp-menu-btn{
    display:flex;align-items:center;gap:.4rem;
    font-family:var(--ff-mono);font-size:.75rem;letter-spacing:.08em;
    color:var(--muted);background:none;
    border:1px solid var(--border);border-radius:6px;
    padding:.35rem .8rem;cursor:pointer;transition:color .2s,border-color .2s;
  }
  .sp-menu-btn:hover{color:var(--text);border-color:var(--border2)}
  .sp-dropdown{
    display:none;position:absolute;top:54px;right:1.2rem;
    background:rgba(8,6,15,.97);border:1px solid var(--border2);
    border-radius:12px;overflow:hidden;z-index:200;min-width:180px;
    backdrop-filter:blur(16px);
  }
  .sp-dropdown.open{display:block}
  .sp-dropdown a{
    display:block;padding:.85rem 1.25rem;
    font-family:var(--ff-mono);font-size:.78rem;letter-spacing:.08em;
    color:var(--muted);text-decoration:none;
    border-bottom:1px solid var(--border);transition:color .2s,background .2s;
  }
  .sp-dropdown a:last-child{border-bottom:none}
  .sp-dropdown a:hover{color:var(--gold-lt);background:rgba(201,168,76,.08)}
  .sp-dropdown span{
    display:block;padding:.85rem 1.25rem;
    font-family:var(--ff-mono);font-size:.78rem;letter-spacing:.08em;
    color:var(--text);border-bottom:1px solid var(--border);
  }
  .sp-dropdown span:last-child{border-bottom:none}
}
#google_translate_element{font-size:.65rem;flex-shrink:0}
#google_translate_element .goog-te-gadget{color:transparent;white-space:nowrap}
#google_translate_element .goog-te-gadget select{background:rgba(8,6,15,.9);color:#8a7db5;border:1px solid rgba(160,130,220,.3);border-radius:6px;font-size:.65rem;padding:.15rem .3rem;cursor:pointer}
.goog-te-banner-frame{display:none!important}
body{top:0!important}
</style>
<!-- Google Translate -->
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</head>
<body>

<?php $currentPage='mbti'; require __DIR__.'/inc/header.php'; ?>

<div class="wrap">

  <section class="hero">
    <span class="hero-eyebrow">MBTI × Zodiac</span>
    <h1>MBTI×星座 性格タイプ診断</h1>
    <p class="hero-sub">10の質問であなたのMBTIタイプを導き出し、<br>星座との組み合わせで運命の性格像を映し出します。</p>

  </section>

  <div class="adsense-space"><!-- AdSenseコードをここに --></div>

  <div class="shindan-card">

    <!-- ステップ1：質問 -->
    <div class="step active" id="step-q">
      <div class="progress-wrap">
        <div class="progress-label">
          <span id="q-num">質問 1 / 10</span>
          <span id="q-pct">10%</span>
        </div>
        <div class="progress-bar"><div class="progress-fill" id="prog" style="width:10%"></div></div>
      </div>
      <div class="q-text" id="q-text"></div>
      <div class="choices" id="choices"></div>
      <div class="nav-row">
        <button class="back-btn" id="back-btn" onclick="goBack()">← 戻る</button>
        <button class="next-btn" id="next-btn" onclick="goNext()" disabled>次へ →</button>
      </div>
      <div class="skip-link" onclick="showMbtiSelect()">▸ すでにMBTIを知っている方はこちら</div>
    </div>

    <!-- ステップ2：MBTIタイプ直接選択 -->
    <div class="step" id="step-mbti">
      <div class="select-title">あなたのMBTIタイプを選んでください</div>
      <div class="mbti-grid" id="mbti-grid"></div>
      <button class="next-btn full-btn" id="mbti-next" onclick="goSeizaFromMbti()" disabled>次へ（星座選択）→</button>
    </div>

    <!-- ステップ3：星座選択 -->
    <div class="step" id="step-seiza">
      <div class="select-title">あなたの星座を選んでください</div>
      <div class="seiza-grid" id="seiza-grid"></div>
      <button class="next-btn full-btn" id="seiza-next" onclick="showResult()" disabled>診断結果を見る →</button>
    </div>

    <!-- ステップ4：結果 -->
    <div class="step" id="step-result">
      <div class="result-hero">
        <div class="result-badge" id="r-badge"></div>
        <div class="result-type" id="r-type"></div>
        <div class="result-name" id="r-name"></div>
        <div class="result-desc" id="r-desc"></div>
      </div>

      <div class="combo-section">
        <div class="combo-eyebrow" id="r-combo-eyebrow"></div>
        <div class="combo-title" id="r-combo-title"></div>
        <div class="combo-desc" id="r-combo-desc"></div>
        <div class="lucky-grid">
          <div class="lucky-item">
            <div class="lucky-cat">Lucky Color</div>
            <div class="lucky-val" id="r-color"></div>
          </div>
          <div class="lucky-item">
            <div class="lucky-cat">今月のキーワード</div>
            <div class="lucky-val" id="r-keyword"></div>
          </div>
          <div class="lucky-item">
            <div class="lucky-cat">相性のよい星座</div>
            <div class="lucky-val" id="r-compat"></div>
          </div>
          <div class="lucky-item">
            <div class="lucky-cat">今月の運気</div>
            <div class="lucky-val" id="r-luck"></div>
          </div>
        </div>
      </div>

      <div class="type-list">
        <div class="type-list-title">同じMBTIタイプの有名人</div>
        <div class="type-tags" id="r-famous"></div>
      </div>

      <?php require __DIR__.'/inc/share-btns.php'; ?>
      <button class="retry-btn" onclick="restart()">もう一度診断する</button>
      <div class="nav-cards-section" style="padding:2rem 0 0">
        <h3>✦ 次はこれを試してみては？ ✦</h3>
        <?php require_once __DIR__.'/inc/nav-cards.php'; echo _nav_cards(3,'mbti'); ?>
      </div>
    </div>

  </div><!-- /.shindan-card -->

  <div class="adsense-space"><!-- AdSenseコードをここに --></div>

</div><!-- /.wrap -->
  <div class="about-box">
    <h2>MBTI×星座診断について</h2>
    <div class="about-item">
      <span>🌟</span>
    <p>MBTI（16性格タイプ）と12星座を組み合わせた性格診断です。10の質問に答えるか、MBTIタイプを直接選んで星座と組み合わせることで、あなたの性格像を読み解きます。</p>
  </div>
  <div class="about-item">
    <span>✨</span>
    <p>質問に順番に答えてタイプを判定する方法と、すでにご存じのMBTIタイプを選ぶ方法があります。最後に星座を選ぶと、診断結果が表示されます。</p>
  </div>
  <div class="about-item">
    <span>🌙</span>
    <p>本サービスはエンターテインメントを目的としています。結果は自己理解の参考としてお楽しみください。医学・法律・投資などの専門的な助言を行うものではありません。</p>
  </div>
</div>
<?php require __DIR__.'/inc/footer.php'; ?>

<script>
const questions = [
  {q:'パーティーや集まりの後、あなたはどう感じる？',a:['元気になる。もっと話し続けたい','少し疲れる。一人の時間で充電したい'],dim:'EI'},
  {q:'新しい情報を得るとき、どちらが自然？',a:['具体的な事実や実際の経験から学ぶ','全体の意味やパターン・可能性を捉えたい'],dim:'SN'},
  {q:'重要な決断をするとき、何を重視する？',a:['論理・客観的な分析・一貫性','人への影響・自分の価値観や気持ち'],dim:'TF'},
  {q:'日常生活のスタイルは？',a:['計画を立てて着実に進めるのが好き','流れに合わせて柔軟に対応したい'],dim:'JP'},
  {q:'友人からどう見られていると思う？',a:['社交的・話しかけやすい・エネルギッシュ','落ち着いている・深く考えている・神秘的'],dim:'EI'},
  {q:'問題を解くとき、どちらに引かれる？',a:['実績や過去の方法を参考にする','新しいアプローチや独自の方法を試す'],dim:'SN'},
  {q:'誰かと意見が食い違ったとき',a:['正しいかどうかを最優先に考える','相手の気持ちを傷つけないようにしたい'],dim:'TF'},
  {q:'予定が急に変わったら？',a:['少し困る。事前に知っておきたかった','まあいっか。なんとかなる'],dim:'JP'},
  {q:'休日の理想の過ごし方は？',a:['友人や家族と賑やかに過ごしたい','自分のペースで静かに過ごしたい'],dim:'EI'},
  {q:'未来について考えるとき',a:['現実的に、着実に計画を立てる','夢や可能性を大きく広げて考える'],dim:'SN'},
];

const mbtiData = {
  INTJ:{name:'建築家',desc:'戦略的思考と強い意志を持つ完璧主義者。独自のビジョンで物事を構築する天才肌。',famous:['レオナルド・ダ・ヴィンチ','スティーブン・ホーキング','マーク・ザッカーバーグ']},
  INTP:{name:'論理学者',desc:'知識への飽くなき探求心を持つ思想家。独創的なアイデアで問題を解く分析の達人。',famous:['アルベルト・アインシュタイン','ビル・ゲイツ','ソクラテス']},
  ENTJ:{name:'指揮官',desc:'天性のリーダーシップで目標を達成する。カリスマ性と決断力で組織を動かす。',famous:['スティーブ・ジョブズ','ナポレオン・ボナパルト','マーガレット・サッチャー']},
  ENTP:{name:'討論者',desc:'アイデアの探求と議論を楽しむ革新者。常識に挑戦し新しい視点を生み出す。',famous:['ベンジャミン・フランクリン','マーク・トウェイン','トーマス・エジソン']},
  INFJ:{name:'提唱者',desc:'深い洞察力と理想主義を持つ。人を助けることに使命感を覚える稀有な存在。',famous:['マハトマ・ガンジー','マーティン・ルーサー・キング','ネルソン・マンデラ']},
  INFP:{name:'仲介者',desc:'感受性が豊かで理想主義的な詩人。価値観に従い静かに世界をより良くしようとする。',famous:['ウィリアム・シェイクスピア','宮沢賢治','オードリー・ヘプバーン']},
  ENFJ:{name:'主人公',desc:'人を鼓舞し導く天性の教育者。共感力と説得力で周囲に自然とポジティブな影響を与える。',famous:['バラク・オバマ','オプラ・ウィンフリー','ネルソン・マンデラ']},
  ENFP:{name:'運動家',desc:'情熱と創造性あふれる自由な魂。あらゆる可能性を見出し、人と深くつながる。',famous:['ロビン・ウィリアムズ','マーク・トウェイン','エレン・デジェネレス']},
  ISTJ:{name:'管理者',desc:'誠実で責任感が強い実務家。伝統と秩序を重んじ、着実に物事を進める信頼の柱。',famous:['アンジェラ・メルケル','ウォーレン・バフェット','クイーン・エリザベス2世']},
  ISFJ:{name:'擁護者',desc:'献身的で温かく思いやり深い守護者。大切な人を静かに、しかし力強く支え続ける。',famous:['マザー・テレサ','ケイト・ミドルトン','ビヨンセ']},
  ESTJ:{name:'幹部',desc:'秩序と規則を重んじる管理者。実務能力と統率力で組織を動かすリーダーシップの体現者。',famous:['山本五十六','ヒラリー・クリントン','フランク・シナトラ']},
  ESFJ:{name:'領事',desc:'社交的で思いやり深い協調者。周囲の調和を保ちながら、皆を気にかける温かな存在。',famous:['テイラー・スウィフト','ビル・クリントン','ホイットニー・ヒューストン']},
  ISTP:{name:'巨匠',desc:'冷静な観察眼と器用な手を持つ職人。問題を黙々と解決する実践的な達人。',famous:['宮本武蔵','クリント・イーストウッド','マイケル・ジョーダン']},
  ISFP:{name:'冒険家',desc:'穏やかで好奇心旺盛なアーティスト。今この瞬間の美しさと自由を大切にする。',famous:['マイケル・ジャクソン','ブリトニー・スピアーズ','ボブ・ディラン']},
  ESTP:{name:'起業家',desc:'エネルギッシュで行動力抜群の問題解決者。リスクを楽しみ、瞬時に状況を読んで動く。',famous:['ドナルド・トランプ','エルネスト・チェ・ゲバラ','マドンナ']},
  ESFP:{name:'エンターテイナー',desc:'陽気で自発的な楽しさの発信源。その場を明るくし、皆を笑顔にする天性のパフォーマー。',famous:['マリリン・モンロー','エルトン・ジョン','アデル']},
};

const seizaData = [
  {name:'牡羊座',key:'aries',  color:'情熱レッド',    keyword:'新しい挑戦',compat:'射手座',luck:'★★★★☆',combo:'火のエネルギーがあなたの行動力をさらに後押し。直感を信じて躊躇なく前進することで道が開ける。'},
  {name:'牡牛座',key:'taurus', color:'エメラルドグリーン',keyword:'安定と豊かさ',compat:'山羊座',luck:'★★★★★',combo:'大地の力が安心感と持続力をもたらす。コツコツ積み上げることで確かな運気が花開く。'},
  {name:'双子座',key:'gemini', color:'イエロー',       keyword:'コミュニケーション',compat:'天秤座',luck:'★★★☆☆',combo:'風のように自由な発想とMBTIの知性が輝く。多様な人との出会いが新たな扉を開く。'},
  {name:'蟹座', key:'cancer',  color:'シルバーホワイト',keyword:'家庭と絆',compat:'蠍座', luck:'★★★★☆',combo:'月の守護のもと感受性と共感力が高まる。大切な人との絆を深めることで運気が上昇。'},
  {name:'獅子座',key:'leo',    color:'ゴールド',       keyword:'自己表現',compat:'牡羊座',luck:'★★★★★',combo:'太陽の輝きが個性と存在感を際立たせる。堂々と自分を表現することで幸運が引き寄せられる。'},
  {name:'乙女座',key:'virgo',  color:'ネイビーブルー',  keyword:'細部への注意',compat:'山羊座',luck:'★★★★☆',combo:'地のエネルギーで分析力と洞察力が冴える。丁寧さと誠実さが周囲の信頼を集める。'},
  {name:'天秤座',key:'libra',  color:'ローズピンク',   keyword:'調和と美',compat:'双子座',luck:'★★★☆☆',combo:'金星の加護で対人運が大幅上昇。バランス感覚が光り、新たな良縁が訪れる予感。'},
  {name:'蠍座', key:'scorpio', color:'ディープパープル',keyword:'変容と再生',compat:'魚座', luck:'★★★★☆',combo:'水のパワーで洞察力と直感が増す。深く潜れば潜るほど、真の宝が見えてくる。'},
  {name:'射手座',key:'sagittarius',color:'ロイヤルブルー',keyword:'冒険と哲学',compat:'牡羊座',luck:'★★★★★',combo:'木星の拡大エネルギーが強力な追い風。遠くを見据えた大きな目標が実現に近づく。'},
  {name:'山羊座',key:'capricorn',color:'ダークブラウン',keyword:'野心と忍耐',compat:'牡牛座',luck:'★★★★☆',combo:'土星の試練が真の強さを育む。長期的な視点と着実な行動が大きな成果をもたらす。'},
  {name:'水瓶座',key:'aquarius',color:'エレクトリックブルー',keyword:'革新と自由',compat:'双子座',luck:'★★★☆☆',combo:'天王星の革命的エネルギーが閃きをもたらす。型破りな発想が時代を動かす力となる。'},
  {name:'魚座', key:'pisces',  color:'オーシャンブルー',keyword:'直感と慈悲',compat:'蟹座', luck:'★★★★☆',combo:'海王星の神秘が感性を研ぎ澄ます。夢と現実の境界で奇跡のような出来事が起きる予感。'},
];

let scores = {E:0,I:0,S:0,N:0,T:0,F:0,J:0,P:0};
let current = 0;
let answers = [];
let selectedMbti = null;
let selectedSeiza = null;

function showStep(id) {
  document.querySelectorAll('.step').forEach(s => s.classList.remove('active'));
  document.getElementById(id).classList.add('active');
}

function renderQ() {
  const q = questions[current];
  const pct = Math.round(((current + 1) / questions.length) * 100);
  document.getElementById('q-num').textContent = `質問 ${current + 1} / ${questions.length}`;
  document.getElementById('q-pct').textContent = `${pct}%`;
  document.getElementById('prog').style.width = `${pct}%`;
  document.getElementById('q-text').textContent = q.q;
  const c = document.getElementById('choices');
  c.innerHTML = '';
  q.a.forEach((txt, i) => {
    const b = document.createElement('button');
    b.className = 'choice-btn' + (answers[current] === i ? ' selected' : '');
    b.textContent = txt;
    b.onclick = () => selectChoice(i);
    c.appendChild(b);
  });
  document.getElementById('next-btn').disabled = answers[current] === undefined;
  document.getElementById('back-btn').style.visibility = current === 0 ? 'hidden' : 'visible';
}

function selectChoice(i) {
  answers[current] = i;
  document.querySelectorAll('.choice-btn').forEach((b, j) => b.classList.toggle('selected', j === i));
  document.getElementById('next-btn').disabled = false;
}

function goNext() {
  if (answers[current] === undefined) return;
  if (current < questions.length - 1) {
    current++;
    renderQ();
  } else {
    calcMbti();
    showSeizaStep();
  }
}

function goBack() {
  if (current > 0) { current--; renderQ(); }
}

function calcMbti() {
  scores = {E:0,I:0,S:0,N:0,T:0,F:0,J:0,P:0};
  questions.forEach((q, i) => {
    if (answers[i] === undefined) return;
    const dims = q.dim.split('');
    scores[dims[answers[i]]]++;
  });
  selectedMbti = (scores.E >= scores.I ? 'E' : 'I')
               + (scores.S >= scores.N ? 'S' : 'N')
               + (scores.T >= scores.F ? 'T' : 'F')
               + (scores.J >= scores.P ? 'J' : 'P');
}

function showMbtiSelect() {
  showStep('step-mbti');
  const g = document.getElementById('mbti-grid');
  g.innerHTML = '';
  Object.keys(mbtiData).forEach(type => {
    const b = document.createElement('button');
    b.className = 'mbti-btn' + (selectedMbti === type ? ' selected' : '');
    b.textContent = type;
    b.onclick = () => {
      selectedMbti = type;
      document.querySelectorAll('.mbti-btn').forEach(x => x.classList.remove('selected'));
      b.classList.add('selected');
      document.getElementById('mbti-next').disabled = false;
    };
    g.appendChild(b);
  });
}

function goSeizaFromMbti() { showSeizaStep(); }

function showSeizaStep() {
  showStep('step-seiza');
  const g = document.getElementById('seiza-grid');
  g.innerHTML = '';
  seizaData.forEach(s => {
    const b = document.createElement('button');
    b.className = 'seiza-btn' + (selectedSeiza === s.key ? ' selected' : '');
    b.textContent = s.name;
    b.onclick = () => {
      selectedSeiza = s.key;
      document.querySelectorAll('.seiza-btn').forEach(x => x.classList.remove('selected'));
      b.classList.add('selected');
      document.getElementById('seiza-next').disabled = false;
    };
    g.appendChild(b);
  });
}

function showResult() {
  if (!selectedMbti || !selectedSeiza) return;
  const m = mbtiData[selectedMbti];
  const s = seizaData.find(x => x.key === selectedSeiza);
  document.getElementById('r-badge').textContent = selectedMbti + ' × ' + s.name;
  document.getElementById('r-type').textContent = selectedMbti;
  document.getElementById('r-name').textContent = '── ' + m.name + ' ──';
  document.getElementById('r-desc').textContent = m.desc;
  document.getElementById('r-combo-eyebrow').textContent = selectedMbti + '（' + m.name + '）× ' + s.name + ' の組み合わせ';
  document.getElementById('r-combo-title').textContent = m.name + 'の' + s.name + ' ── 星が照らす本質';
  document.getElementById('r-combo-desc').textContent = s.combo;
  document.getElementById('r-color').textContent = s.color;
  document.getElementById('r-keyword').textContent = s.keyword;
  document.getElementById('r-compat').textContent = s.compat;
  document.getElementById('r-luck').textContent = s.luck;
  const tags = document.getElementById('r-famous');
  tags.innerHTML = '';
  m.famous.forEach(f => {
    const span = document.createElement('span');
    span.className = 'type-tag';
    span.textContent = f;
    tags.appendChild(span);
  });
  window._shareText = `MBTI診断結果：${selectedMbti}（${m.name}）× ${s.name} でした！✨`;
  showStep('step-result');
}

function restart() {
  scores = {E:0,I:0,S:0,N:0,T:0,F:0,J:0,P:0};
  current = 0; answers = []; selectedMbti = null; selectedSeiza = null;
  showStep('step-q');
  renderQ();
}

renderQ();
</script>
<script>
function googleTranslateElementInit(){
  new google.translate.TranslateElement({pageLanguage:'ja',includedLanguages:'en,zh-TW,zh-CN,ko',layout:google.translate.TranslateElement.InlineLayout.SIMPLE},'google_translate_element');
}
function toggleSpMenu(){
  document.getElementById('spDropdown').classList.toggle('open');
}
document.addEventListener('click',function(e){
  if(!e.target.closest('.sp-menu-btn')&&!e.target.closest('.sp-dropdown')){
    document.getElementById('spDropdown').classList.remove('open');
  }
});
</script>
</body>
</html>
