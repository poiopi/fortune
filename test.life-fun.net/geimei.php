<?php declare(strict_types=1);
if ($_SERVER['REQUEST_METHOD']==='POST' && ($_POST['action']??'')==='save_answer') {
    header('Content-Type: application/json');
    $answer = trim($_POST['answer'] ?? '');
    $cat    = trim($_POST['cat']    ?? '');
    $qid    = trim($_POST['qid']    ?? '');
    if (mb_strlen($answer)<3||mb_strlen($answer)>50||!in_array($cat,['boke','tsukkomi','pin'],true)){
        echo json_encode(['ok'=>false,'msg'=>'文字数エラー']); exit;
    }
    session_start();
    $skey = "gm_{$cat}_{$qid}";
    if (!empty($_SESSION[$skey])&&time()-$_SESSION[$skey]<600){
        echo json_encode(['ok'=>false,'msg'=>'少し待ってください']); exit;
    }
    $_SESSION[$skey] = time();
    $ng = ['死ね','殺す','差別','障害者','きちがい'];
    foreach($ng as $w){ if(mb_stripos($answer,$w)!==false){echo json_encode(['ok'=>false,'msg'=>'NG']);exit;} }
    $dir  = __DIR__.'/data';
    $file = "$dir/geimei_pool.json";
    if(!is_dir($dir)) @mkdir($dir,0755,true);
    $pool = file_exists($file)?(json_decode(file_get_contents($file),true)??[]):[];
    $pool[$cat][$qid] = $pool[$cat][$qid]??[];
    if(!in_array($answer,$pool[$cat][$qid],true)&&count($pool[$cat][$qid])<300){
        $pool[$cat][$qid][] = $answer;
        file_put_contents($file,json_encode($pool,JSON_UNESCAPED_UNICODE));
    }
    echo json_encode(['ok'=>true]); exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="大喜利ゲームで芸風を判定！生年月日の画数から大吉の芸名をフルネーム＋コンビ名で3パターン提案。ボケ・ツッコミ・ピン芸人から選んでチャレンジ。">
<title>芸名診断｜大喜利で見つける最強の芸名</title>
<link rel="canonical" href="https://life-fun.net/geimei" />
<link rel="icon" type="image/png" href="/favicon.png">
<link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500&family=DM+Mono:wght@300;400&display=swap" rel="stylesheet">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6979913482925873" crossorigin="anonymous"></script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<style>
#google_translate_element{font-size:.65rem;flex-shrink:0}
#google_translate_element .goog-te-gadget{color:transparent;white-space:nowrap}
#google_translate_element .goog-te-gadget select{background:rgba(8,6,15,.9);color:#8a7db5;border:1px solid rgba(160,130,220,.3);border-radius:6px;font-size:.65rem;padding:.15rem .3rem;cursor:pointer}
.goog-te-banner-frame{display:none!important}
body{top:0!important}
:root{
  --bg:#0d0b18;--surface:#1a1630;--surface2:#221e36;
  --border:rgba(155,114,239,.15);--border2:rgba(155,114,239,.3);
  --text:#e8e6f0;--muted:#7a6fa8;--gold:#c9a84c;--gold-lt:#e8d48a;
  --violet:#9b72ef;--rose:#e8719a;--teal:#4ecdc4;
  --ff-serif:'Shippori Mincho',serif;--ff-sans:'Zen Kaku Gothic New',sans-serif;
  --ff-mono:'DM Mono',monospace;
}
*{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{background:var(--bg);color:var(--text);font-family:var(--ff-sans);min-height:100vh;line-height:1.7}
a{color:inherit;text-decoration:none}
header{border-bottom:1px solid var(--border);padding:0 1.2rem;position:sticky;top:0;z-index:100;background:rgba(8,6,15,.9);backdrop-filter:blur(12px)}
.header-inner{max-width:900px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;height:54px}
.logo{font-family:var(--ff-serif);font-size:1.1rem;font-weight:700;color:var(--text);text-decoration:none;letter-spacing:.08em}
.logo em{font-style:italic;color:var(--gold)}
.header-nav{display:flex;gap:1.5rem}
.header-nav a,.header-nav span{font-family:var(--ff-mono);font-size:.72rem;color:var(--muted);text-decoration:none;letter-spacing:.08em;transition:color .2s}
.header-nav a:hover{color:var(--gold-lt)}
.sp-menu-btn{display:none}
.sp-dropdown{display:none}
@media(max-width:768px){
  .header-nav{display:none}
  .sp-menu-btn{display:flex;align-items:center;gap:.4rem;font-family:var(--ff-mono);font-size:.75rem;letter-spacing:.08em;color:var(--muted);background:none;border:1px solid var(--border);border-radius:6px;padding:.35rem .8rem;cursor:pointer}
  .sp-dropdown{display:none;position:absolute;top:54px;right:1.2rem;background:rgba(8,6,15,.97);border:1px solid var(--border2);border-radius:12px;overflow:hidden;z-index:200;min-width:180px;backdrop-filter:blur(16px)}
  .sp-dropdown.open{display:block}
  .sp-dropdown a{display:block;padding:.85rem 1.25rem;font-family:var(--ff-mono);font-size:.78rem;letter-spacing:.08em;color:var(--muted);text-decoration:none;border-bottom:1px solid var(--border);transition:color .2s,background .2s}
  .sp-dropdown a:last-child{border-bottom:none}
  .sp-dropdown a:hover{color:var(--gold-lt);background:rgba(201,168,76,.08)}
}
footer{border-top:1px solid var(--border);padding:2rem;text-align:center;font-family:var(--ff-mono);font-size:.68rem;color:var(--muted);letter-spacing:.08em;margin-top:2rem}
footer a{color:var(--muted);text-decoration:none}
footer a:hover{color:var(--gold)}
.wrap{max-width:700px;margin:0 auto;padding:0 1.2rem 4rem}
.hero{text-align:center;padding:2.5rem 0 2rem}
.hero-eyebrow{font-family:var(--ff-mono);font-size:.6rem;letter-spacing:.22em;color:var(--muted);display:block;margin-bottom:.6rem}
.hero h1{font-family:var(--ff-serif);font-size:1.6rem;font-weight:700;line-height:1.4;letter-spacing:.06em;margin-bottom:.8rem}
.hero h1 em{color:var(--gold);font-style:normal}
.hero-sub{font-size:.8rem;color:var(--muted);line-height:1.8}
.form-card{background:var(--surface);border:1px solid var(--border);border-radius:16px;padding:1.8rem 1.6rem;margin-bottom:1.5rem}
.form-section-label{font-family:var(--ff-mono);font-size:.6rem;letter-spacing:.2em;color:var(--gold);text-align:center;margin-bottom:1.5rem}
.form-group{margin-bottom:1.2rem}
.form-label{display:block;font-size:.75rem;color:var(--muted);margin-bottom:.4rem;letter-spacing:.06em}
.form-input{width:100%;background:rgba(8,6,15,.7);border:1px solid var(--border2);border-radius:8px;padding:.6rem .9rem;color:var(--text);font-family:var(--ff-serif);font-size:.9rem;outline:none;transition:border-color .2s;color-scheme:dark}
.form-input:focus{border-color:var(--violet)}
.role-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:.6rem;margin-top:.4rem}
.role-btn{background:var(--surface2);border:1px solid var(--border);border-radius:10px;padding:.8rem .5rem;text-align:center;cursor:pointer;transition:border-color .2s,background .2s;font-family:var(--ff-sans)}
.role-btn:hover{border-color:var(--violet);background:rgba(155,114,239,.08)}
.role-btn.selected{border-color:var(--gold);background:rgba(201,168,76,.1)}
.role-icon{font-size:1.5rem;display:block;margin-bottom:.3rem}
.role-name{font-size:.8rem;font-weight:600;color:var(--text);display:block}
.role-desc{font-size:.62rem;color:var(--muted);display:block;margin-top:.15rem}
.btn-row{display:flex;gap:.8rem;margin-top:1.5rem;flex-wrap:wrap}
.calc-btn{flex:1;min-width:140px;padding:.85rem;border:none;border-radius:10px;font-family:var(--ff-serif);font-size:.9rem;font-weight:700;cursor:pointer;letter-spacing:.06em;transition:opacity .2s}
.btn-game{background:linear-gradient(135deg,var(--violet),var(--rose));color:#fff;box-shadow:0 4px 20px rgba(155,114,239,.3)}
.btn-skip{background:transparent;border:1px solid var(--border2);color:var(--muted)}
.btn-game:hover,.btn-skip:hover{opacity:.8}
.time-note{font-family:var(--ff-mono);font-size:.62rem;color:var(--muted);text-align:center;margin-top:.8rem}
#gameSection{display:none}
.game-card{background:var(--surface);border:1px solid var(--border);border-radius:16px;padding:1.8rem 1.6rem}
.game-progress{display:flex;align-items:center;gap:.8rem;margin-bottom:1.2rem}
.progress-bar{flex:1;height:4px;background:var(--surface2);border-radius:2px;overflow:hidden}
.progress-fill{height:100%;background:linear-gradient(90deg,var(--violet),var(--gold));border-radius:2px;transition:width .3s}
.progress-text{font-family:var(--ff-mono);font-size:.65rem;color:var(--muted);white-space:nowrap}
.game-role-badge{font-family:var(--ff-mono);font-size:.58rem;padding:.2rem .6rem;border-radius:10px;background:rgba(155,114,239,.15);color:var(--violet);border:1px solid rgba(155,114,239,.2);display:inline-block;margin-bottom:.8rem}
.game-q{font-family:var(--ff-serif);font-size:1rem;font-weight:600;line-height:1.7;margin-bottom:1.2rem;color:var(--text)}
.choices{display:flex;flex-direction:column;gap:.6rem;margin-bottom:1rem}
.choice-btn{background:var(--surface2);border:1px solid var(--border);border-radius:10px;padding:.85rem 1rem;text-align:left;cursor:pointer;font-family:var(--ff-sans);font-size:.83rem;color:var(--text);transition:border-color .2s,background .2s;line-height:1.5}
.choice-btn:hover{border-color:var(--violet);background:rgba(155,114,239,.08)}
.choice-btn.selected{border-color:var(--gold);background:rgba(201,168,76,.1);color:var(--gold-lt)}
.free-input-area{margin-top:.5rem}
.free-input-toggle{font-family:var(--ff-mono);font-size:.62rem;color:var(--muted);cursor:pointer;text-decoration:underline;display:inline-block;margin-bottom:.4rem}
.free-input-wrap{display:none;gap:.5rem;align-items:center}
.free-input-wrap.show{display:flex}
.free-input{flex:1;background:rgba(8,6,15,.7);border:1px solid var(--border2);border-radius:8px;padding:.5rem .8rem;color:var(--text);font-family:var(--ff-sans);font-size:.82rem;outline:none;color-scheme:dark}
.free-input:focus{border-color:var(--violet)}
.free-submit-btn{background:var(--surface2);border:1px solid var(--border2);border-radius:8px;padding:.5rem .9rem;color:var(--muted);font-family:var(--ff-mono);font-size:.62rem;cursor:pointer;white-space:nowrap}
.free-submit-btn:hover{border-color:var(--violet);color:var(--text)}
.next-btn{width:100%;padding:.8rem;background:linear-gradient(135deg,var(--violet),var(--teal));border:none;border-radius:10px;font-family:var(--ff-serif);font-size:.9rem;font-weight:700;color:#fff;cursor:pointer;margin-top:1rem;transition:opacity .2s}
.next-btn:hover{opacity:.85}
.next-btn:disabled{opacity:.35;cursor:default}
#resultSection{display:none}
.result-title{font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.2em;color:var(--muted);text-align:center;margin-bottom:1rem}
.personality-card{background:var(--surface);border:1px solid var(--border);border-radius:14px;padding:1.2rem 1.4rem;margin-bottom:1.5rem;text-align:center}
.personality-type{font-family:var(--ff-serif);font-size:1.3rem;font-weight:700;color:var(--gold);margin-bottom:.3rem}
.personality-desc{font-size:.75rem;color:var(--muted);line-height:1.7}
.name-cards{display:flex;flex-direction:column;gap:1rem;margin-bottom:1.5rem}
.name-card{background:var(--surface);border:1px solid var(--border);border-radius:14px;overflow:hidden}
.name-card-header{background:var(--surface2);padding:.6rem 1rem;display:flex;align-items:center;gap:.5rem;border-bottom:1px solid var(--border)}
.name-card-badge{font-family:var(--ff-mono);font-size:.58rem;padding:.15rem .5rem;border-radius:8px;border:1px solid}
.badge-impact{background:rgba(239,83,80,.1);color:#ef5350;border-color:rgba(239,83,80,.3)}
.badge-friendly{background:rgba(78,205,196,.1);color:var(--teal);border-color:rgba(78,205,196,.3)}
.badge-pro{background:rgba(201,168,76,.1);color:var(--gold);border-color:rgba(201,168,76,.3)}
.name-card-title{font-size:.72rem;color:var(--muted)}
.name-card-body{padding:1rem 1.2rem}
.fullname{font-family:var(--ff-serif);font-size:2rem;font-weight:700;letter-spacing:.12em;color:var(--text);margin-bottom:.15rem}
.fullname-read{font-family:var(--ff-mono);font-size:.62rem;color:var(--muted);letter-spacing:.1em;margin-bottom:.5rem}
.jinkaku-badge{display:inline-block;font-family:var(--ff-mono);font-size:.6rem;padding:.1rem .5rem;border-radius:8px;background:rgba(201,168,76,.12);color:var(--gold);border:1px solid rgba(201,168,76,.2);margin-bottom:.6rem}
.name-reason{font-size:.72rem;color:var(--muted);line-height:1.75;margin-bottom:.8rem}
.konbi-section{border-top:1px solid var(--border);padding-top:.8rem;margin-top:.2rem}
.konbi-label{font-family:var(--ff-mono);font-size:.58rem;color:var(--muted);letter-spacing:.1em;margin-bottom:.3rem}
.konbi-name{font-family:var(--ff-serif);font-size:1.3rem;font-weight:700;color:var(--violet);letter-spacing:.08em;margin-bottom:.5rem}
.seimei-btn{display:inline-block;padding:.4rem 1rem;background:linear-gradient(135deg,var(--gold),#8b5e00);color:#fff;border-radius:20px;font-family:var(--ff-mono);font-size:.62rem;letter-spacing:.06em;transition:opacity .2s;margin-top:.3rem}
.seimei-btn:hover{opacity:.8}
.kata-note{font-family:var(--ff-mono);font-size:.58rem;color:var(--muted);margin-top:.3rem;display:block}
.seimei-guide{background:rgba(201,168,76,.06);border:1px solid rgba(201,168,76,.2);border-radius:12px;padding:1rem 1.2rem;margin-bottom:1.5rem;text-align:center}
.seimei-guide p{font-size:.75rem;color:var(--muted);line-height:1.7;margin-bottom:.6rem}
.seimei-link{display:inline-block;padding:.5rem 1.2rem;background:linear-gradient(135deg,var(--gold),#8b5e00);color:#fff;border-radius:8px;font-family:var(--ff-serif);font-size:.8rem;font-weight:700}
.retry-wrap{text-align:center;margin:2rem 0}
.retry-btn{background:none;border:1px solid var(--border2);border-radius:20px;padding:.6rem 1.6rem;font-family:var(--ff-mono);font-size:.72rem;color:var(--muted);cursor:pointer;transition:color .2s,border-color .2s}
.retry-btn:hover{color:var(--text);border-color:var(--violet)}
.disclaimer{max-width:700px;margin:0 auto 1.5rem;text-align:center;font-size:.68rem;color:var(--muted);line-height:1.8}
#loadingOverlay{display:none;position:fixed;inset:0;background:rgba(8,6,15,.85);z-index:9999;align-items:center;justify-content:center;flex-direction:column;gap:1rem}
#loadingOverlay.show{display:flex}
.loading-text{font-family:var(--ff-mono);font-size:.75rem;letter-spacing:.2em;color:var(--gold)}
.loading-ring{width:50px;height:50px;border:2px solid rgba(155,114,239,.2);border-top-color:var(--violet);border-radius:50%;animation:spin .8s linear infinite}
@keyframes spin{to{transform:rotate(360deg)}}
.rf-retry-btn{display:block;width:100%;padding:.9rem;background:#7c4dce;color:#fff;border:none;border-radius:10px;font-family:var(--ff-sans,sans-serif);font-size:.9rem;font-weight:500;cursor:pointer;text-align:center;text-decoration:none;margin-top:1.5rem;transition:background .2s;letter-spacing:.04em}
.rf-retry-btn:hover{background:#6a3fc2}
</style>
</head>
<body>
<?php $currentPage='geimei'; require __DIR__.'/inc/header.php'; ?>

<div id="loadingOverlay"><div class="loading-ring"></div><div class="loading-text">芸名を鑑定中...</div></div>

<div class="wrap">
  <section class="hero">
    <span class="hero-eyebrow">GEIMEI SHINDAN · 芸名診断</span>
    <h1>大喜利で見つける<br><em>最強の芸名</em></h1>
    <p class="hero-sub">あなたの芸風を大喜利で判定。<br>生年月日の画数から<em style="color:var(--gold)">大吉</em>の芸名を3パターン提案します。</p>
  </section>

  <div id="formSection">
    <div class="form-card">
      <div class="form-section-label">✦ 基本情報を入力 ✦</div>
      <div class="form-group">
        <label class="form-label" for="gName">お名前（任意）</label>
        <input type="text" id="gName" class="form-input" placeholder="例：山田 太郎">
      </div>
      <div class="form-group">
        <label class="form-label" for="gDate">生年月日 <span style="color:var(--rose)">*</span></label>
        <input type="date" id="gDate" class="form-input" min="1900-01-01" max="2099-12-31">
      </div>
      <div class="form-group">
        <label class="form-label">芸風を選んでください <span style="color:var(--rose)">*</span></label>
        <div class="role-grid">
          <div class="role-btn" data-role="boke" onclick="selectRole('boke',this)">
            <span class="role-icon">🤡</span>
            <span class="role-name">ボケ</span>
            <span class="role-desc">天然・ズレ・笑いを生む</span>
          </div>
          <div class="role-btn" data-role="tsukkomi" onclick="selectRole('tsukkomi',this)">
            <span class="role-icon">👊</span>
            <span class="role-name">ツッコミ</span>
            <span class="role-desc">切れ味・テンポが命</span>
          </div>
          <div class="role-btn" data-role="pin" onclick="selectRole('pin',this)">
            <span class="role-icon">🎤</span>
            <span class="role-name">ピン芸</span>
            <span class="role-desc">一人で世界をつくる</span>
          </div>
        </div>
      </div>
      <div class="btn-row">
        <button class="calc-btn btn-game" onclick="startGame()">🎯 大喜利で診断する</button>
        <button class="calc-btn btn-skip" onclick="skipToResult()">⚡ すぐ芸名を見る</button>
      </div>
      <p class="time-note">「すぐ芸名を見る」の場合、芸名の説明は省略されます</p>
    </div>
  </div>

  <div id="gameSection">
    <div class="game-card">
      <div class="game-progress">
        <div class="progress-bar"><div class="progress-fill" id="progressFill" style="width:0%"></div></div>
        <span class="progress-text" id="progressText">1 / 10</span>
      </div>
      <div class="game-role-badge" id="roleBadge">ボケ</div>
      <div class="game-q" id="gameQ"></div>
      <div class="choices" id="choicesWrap"></div>
      <div class="free-input-area">
        <span class="free-input-toggle" onclick="toggleFree()">✏️ 自分で入力する</span>
        <div class="free-input-wrap" id="freeWrap">
          <input type="text" class="free-input" id="freeInput" placeholder="自由に回答（3〜50文字）" maxlength="50">
          <button class="free-submit-btn" onclick="submitFree()">送信</button>
        </div>
      </div>
      <button class="next-btn" id="nextBtn" onclick="nextQuestion()" disabled>次へ →</button>
    </div>
  </div>

  <div id="resultSection">
    <div class="result-title">✦ 芸名鑑定結果 ✦</div>
    <div class="personality-card" id="personalityCard" style="display:none"></div>
    <div class="name-cards" id="nameCards"></div>
    <div class="seimei-guide">
      <p>自分で考えた芸名の画数・運勢を調べたい方は<br>姓名判断ページをご利用ください。</p>
      <a href="/seimei" class="seimei-link">✍️ 姓名判断で調べる →</a>
    </div>
    <div class="retry-wrap">
      <button class="rf-retry-btn" onclick="resetAll()">もう一度診断する</button>
    </div>
  </div>

  <?php
  require_once __DIR__.'/inc/nav-cards.php';
  ?>
  <div id="inlineNavCards" style="display:none">
    <div class="nav-cards-section"><h3>✦ 次はこれを試してみては？ ✦</h3><?= _nav_cards(3,'geimei') ?></div>
  </div>

  <p class="disclaimer">※ 本サービスはエンターテインメント目的のコンテンツです。提案された芸名の使用は自己責任でお願いします。</p>
</div>

<?php require __DIR__.'/inc/footer.php'; ?>

<script>
function googleTranslateElementInit(){new google.translate.TranslateElement({pageLanguage:'ja',includedLanguages:'en,ko,zh-CN,zh-TW,es,fr,de',layout:google.translate.TranslateElement.InlineLayout.SIMPLE},'google_translate_element')}
function toggleSpMenu(){document.getElementById('spDropdown').classList.toggle('open')}

const LUCKY = new Set([1,3,5,6,7,8,11,13,15,16,17,21,23,24,25,31,32,33,35,37,38,41,45,47,48,52,57,58,63,65,67,68,81]);

// ── 苗字プール（漢字:約30語レア, カタカナ:約100語 高確率） ──
// type: 'kanji' | 'kata'
const MYOJI = [
  // 漢字（レア: weight=1）
  {t:'山田',r:'やまだ',s:8,w:1,st:['インパクト','親しみ'],pt:['天然','体育会系']},
  {t:'田中',r:'たなか',s:9,w:1,st:['親しみ'],pt:['天然','知性系']},
  {t:'松本',r:'まつもと',s:13,w:1,st:['インパクト','本格'],pt:['体育会系','知性系']},
  {t:'中村',r:'なかむら',s:11,w:1,st:['親しみ','本格'],pt:['天然']},
  {t:'木村',r:'きむら',s:11,w:1,st:['親しみ','インパクト'],pt:['体育会系','天然']},
  {t:'鈴木',r:'すずき',s:17,w:1,st:['本格','インパクト'],pt:['知性系','毒舌']},
  {t:'吉田',r:'よしだ',s:11,w:1,st:['本格','親しみ'],pt:['知性系','天然']},
  {t:'加藤',r:'かとう',s:23,w:1,st:['本格'],pt:['知性系','毒舌']},
  {t:'春風',r:'はるかぜ',s:18,w:1,st:['親しみ','インパクト'],pt:['天然']},
  {t:'天野',r:'あまの',s:15,w:1,st:['インパクト','本格'],pt:['天然','知性系']},
  {t:'月野',r:'つきの',s:15,w:1,st:['親しみ','インパクト'],pt:['天然']},
  {t:'星野',r:'ほしの',s:20,w:1,st:['本格','インパクト'],pt:['知性系']},
  {t:'吉本',r:'よしもと',s:11,w:1,st:['インパクト'],pt:['体育会系']},
  {t:'東野',r:'ひがしの',s:19,w:1,st:['本格'],pt:['知性系']},
  {t:'喜多',r:'きた',s:18,w:1,st:['インパクト','親しみ'],pt:['体育会系','天然']},
  {t:'太田',r:'おおた',s:9,w:1,st:['親しみ','インパクト'],pt:['体育会系','天然']},
  {t:'夏川',r:'なつかわ',s:13,w:1,st:['親しみ'],pt:['天然']},
  {t:'高橋',r:'たかはし',s:26,w:1,st:['本格'],pt:['知性系','毒舌']},
  {t:'岡田',r:'おかだ',s:13,w:1,st:['本格','親しみ'],pt:['知性系','天然']},
  {t:'林田',r:'はやしだ',s:13,w:1,st:['インパクト','親しみ'],pt:['体育会系','天然']},
  {t:'花岡',r:'はなおか',s:16,w:1,st:['親しみ'],pt:['天然']},
  {t:'黒木',r:'くろき',s:19,w:1,st:['インパクト','本格'],pt:['毒舌','知性系']},
  {t:'白石',r:'しらいし',s:18,w:1,st:['本格'],pt:['知性系']},
  {t:'金城',r:'きんじょう',s:16,w:1,st:['インパクト'],pt:['体育会系']},
  {t:'龍崎',r:'りゅうざき',s:21,w:1,st:['インパクト','本格'],pt:['知性系','毒舌']},
  {t:'桐島',r:'きりしま',s:18,w:1,st:['本格','インパクト'],pt:['知性系']},
  {t:'宇治',r:'うじ',s:10,w:1,st:['親しみ','本格'],pt:['天然']},
  {t:'西村',r:'にしむら',s:16,w:1,st:['親しみ'],pt:['天然','知性系']},
  {t:'藤原',r:'ふじわら',s:21,w:1,st:['本格'],pt:['知性系']},
  {t:'今井',r:'いまい',s:10,w:1,st:['親しみ'],pt:['天然','体育会系']},

  // カタカナ（高確率: weight=4）
  // 外国人苗字系
  {t:'マーク',r:'まーく',s:8,w:4,st:['インパクト','本格'],pt:['知性系','体育会系']},
  {t:'フランク',r:'ふらんく',s:8,w:4,st:['インパクト'],pt:['体育会系','天然']},
  {t:'ミラー',r:'みらー',s:6,w:4,st:['本格','インパクト'],pt:['知性系']},
  {t:'ブラック',r:'ぶらっく',s:8,w:4,st:['インパクト'],pt:['毒舌']},
  {t:'ホワイト',r:'ほわいと',s:8,w:4,st:['親しみ'],pt:['天然']},
  {t:'グレイ',r:'ぐれい',s:6,w:4,st:['本格','インパクト'],pt:['知性系','毒舌']},
  {t:'ロス',r:'ろす',s:4,w:4,st:['インパクト','親しみ'],pt:['体育会系','天然']},
  {t:'ジャクソン',r:'じゃくそん',s:9,w:4,st:['インパクト'],pt:['体育会系']},
  {t:'ウィルソン',r:'うぃるそん',s:9,w:4,st:['本格'],pt:['知性系']},
  {t:'ブラウン',r:'ぶらうん',s:7,w:4,st:['親しみ','インパクト'],pt:['天然','体育会系']},
  {t:'グリーン',r:'ぐりーん',s:7,w:4,st:['親しみ'],pt:['天然']},
  {t:'スミス',r:'すみす',s:5,w:4,st:['インパクト','本格'],pt:['知性系']},
  {t:'ジョーンズ',r:'じょーんず',s:9,w:4,st:['本格'],pt:['知性系','毒舌']},
  {t:'テイラー',r:'ていらー',s:7,w:4,st:['親しみ','本格'],pt:['天然','知性系']},
  {t:'アンダーソン',r:'あんだーそん',s:11,w:4,st:['インパクト'],pt:['体育会系']},
  {t:'ムーア',r:'むーあ',s:5,w:4,st:['親しみ'],pt:['天然']},
  {t:'クラーク',r:'くらーく',s:7,w:4,st:['本格','インパクト'],pt:['知性系']},
  {t:'ルイス',r:'るいす',s:5,w:4,st:['親しみ','インパクト'],pt:['天然','体育会系']},
  {t:'ロビンソン',r:'ろびんそん',s:9,w:4,st:['インパクト','親しみ'],pt:['体育会系','天然']},
  {t:'ウォーカー',r:'うぉーかー',s:8,w:4,st:['インパクト'],pt:['体育会系']},
  {t:'ハリス',r:'はりす',s:5,w:4,st:['本格'],pt:['知性系']},
  {t:'マーティン',r:'まーてぃん',s:8,w:4,st:['インパクト','本格'],pt:['知性系','体育会系']},
  {t:'ノワール',r:'のわーる',s:7,w:4,st:['本格','インパクト'],pt:['知性系','毒舌']},
  {t:'ブレア',r:'ぶれあ',s:5,w:4,st:['インパクト','本格'],pt:['毒舌']},
  {t:'デイビス',r:'でいびす',s:6,w:4,st:['本格'],pt:['知性系']},
  // かっこいい英単語系
  {t:'ブレイブ',r:'ぶれいぶ',s:7,w:4,st:['インパクト'],pt:['体育会系']},
  {t:'ダーク',r:'だーく',s:5,w:4,st:['インパクト'],pt:['毒舌','知性系']},
  {t:'スター',r:'すたー',s:5,w:4,st:['インパクト','親しみ'],pt:['体育会系','天然']},
  {t:'ドーン',r:'どーん',s:5,w:4,st:['インパクト'],pt:['体育会系']},
  {t:'ナイツ',r:'ないつ',s:5,w:4,st:['本格','インパクト'],pt:['知性系']},
  {t:'ビート',r:'びーと',s:5,w:4,st:['インパクト'],pt:['体育会系']},
  {t:'ロック',r:'ろっく',s:5,w:4,st:['インパクト'],pt:['体育会系','毒舌']},
  {t:'フラッシュ',r:'ふらっしゅ',s:8,w:4,st:['インパクト'],pt:['体育会系']},
  {t:'サンダー',r:'さんだー',s:7,w:4,st:['インパクト'],pt:['体育会系']},
  {t:'ライトニング',r:'らいとにんぐ',s:11,w:4,st:['インパクト'],pt:['体育会系','知性系']},
  {t:'シャドウ',r:'しゃどう',s:6,w:4,st:['インパクト','本格'],pt:['毒舌','知性系']},
  {t:'フェニックス',r:'ふぇにっくす',s:10,w:4,st:['インパクト','本格'],pt:['知性系']},
  // 食べ物・物系（親しみ・天然寄り）
  {t:'タコス',r:'たこす',s:5,w:4,st:['親しみ','インパクト'],pt:['天然']},
  {t:'パフェ',r:'ぱふぇ',s:4,w:4,st:['親しみ'],pt:['天然']},
  {t:'マロン',r:'まろん',s:5,w:4,st:['親しみ'],pt:['天然']},
  {t:'カプリ',r:'かぷり',s:5,w:4,st:['親しみ'],pt:['天然']},
  {t:'ナポリ',r:'なぽり',s:5,w:4,st:['親しみ','インパクト'],pt:['天然','体育会系']},
  {t:'ビスケット',r:'びすけっと',s:8,w:4,st:['親しみ'],pt:['天然']},
  {t:'アーモンド',r:'あーもんど',s:8,w:4,st:['親しみ','インパクト'],pt:['天然']},
  {t:'チョコ',r:'ちょこ',s:4,w:4,st:['親しみ'],pt:['天然']},
  {t:'クレープ',r:'くれーぷ',s:6,w:4,st:['親しみ'],pt:['天然']},
  {t:'ミルク',r:'みるく',s:5,w:4,st:['親しみ'],pt:['天然']},
  // 動物系
  {t:'パンダ',r:'ぱんだ',s:5,w:4,st:['親しみ','インパクト'],pt:['天然']},
  {t:'フラミンゴ',r:'ふらみんご',s:8,w:4,st:['インパクト'],pt:['天然','体育会系']},
  {t:'コアラ',r:'こあら',s:5,w:4,st:['親しみ'],pt:['天然']},
  {t:'ジャガー',r:'じゃがー',s:6,w:4,st:['インパクト'],pt:['体育会系']},
  {t:'コンドル',r:'こんどる',s:6,w:4,st:['インパクト'],pt:['体育会系','知性系']},
  {t:'イグアナ',r:'いぐあな',s:6,w:4,st:['インパクト','親しみ'],pt:['天然']},
  {t:'カピバラ',r:'かぴばら',s:6,w:4,st:['親しみ'],pt:['天然']},
  {t:'アルパカ',r:'あるぱか',s:6,w:4,st:['親しみ'],pt:['天然']},
  // 地名・人名外来語系
  {t:'ダラス',r:'だらす',s:5,w:4,st:['インパクト'],pt:['体育会系']},
  {t:'ロマン',r:'ろまん',s:5,w:4,st:['親しみ','本格'],pt:['知性系','天然']},
  {t:'シド',r:'しど',s:3,w:4,st:['インパクト'],pt:['毒舌']},
  {t:'リオ',r:'りお',s:3,w:4,st:['親しみ','インパクト'],pt:['天然','体育会系']},
  {t:'ベガス',r:'べがす',s:5,w:4,st:['インパクト'],pt:['体育会系']},
  {t:'モナコ',r:'もなこ',s:5,w:4,st:['本格','インパクト'],pt:['知性系']},
  {t:'バンコク',r:'ばんこく',s:7,w:4,st:['インパクト'],pt:['体育会系','天然']},
  {t:'マカオ',r:'まかお',s:5,w:4,st:['インパクト','親しみ'],pt:['天然','体育会系']},
  {t:'ソウル',r:'そうる',s:5,w:4,st:['インパクト'],pt:['体育会系']},
  {t:'マドリード',r:'まどりーど',s:8,w:4,st:['本格','インパクト'],pt:['知性系']},
  // その他おもしろ系
  {t:'デラックス',r:'でらっくす',s:8,w:4,st:['インパクト'],pt:['体育会系','毒舌']},
  {t:'プレミアム',r:'ぷれみあむ',s:8,w:4,st:['本格','インパクト'],pt:['知性系']},
  {t:'ゴールド',r:'ごーるど',s:6,w:4,st:['インパクト','本格'],pt:['体育会系','知性系']},
  {t:'シルバー',r:'しるばー',s:6,w:4,st:['本格'],pt:['知性系']},
  {t:'プラチナ',r:'ぷらちな',s:6,w:4,st:['本格'],pt:['知性系']},
  {t:'ダイヤモンド',r:'だいやもんど',s:11,w:4,st:['インパクト','本格'],pt:['知性系']},
  {t:'エース',r:'えーす',s:5,w:4,st:['インパクト'],pt:['体育会系']},
  {t:'キング',r:'きんぐ',s:5,w:4,st:['インパクト'],pt:['体育会系','知性系']},
  {t:'クイーン',r:'くいーん',s:6,w:4,st:['インパクト','本格'],pt:['毒舌','知性系']},
  {t:'ジョーカー',r:'じょーかー',s:7,w:4,st:['インパクト'],pt:['天然','毒舌']},
];

// ── 名前プール（漢字:約20語レア, カタカナ:約100語 高確率） ──
const NAMAE = [
  // 漢字（レア: weight=1）
  {t:'太郎',r:'たろう',s:13,w:1,pt:['体育会系','天然']},
  {t:'恵太',r:'けいた',s:16,w:1,pt:['天然']},
  {t:'光',r:'ひかる',s:6,w:1,pt:['知性系','本格']},
  {t:'恵',r:'めぐみ',s:12,w:1,pt:['親しみ','天然']},
  {t:'勝',r:'まさる',s:12,w:1,pt:['体育会系']},
  {t:'達也',r:'たつや',s:15,w:1,pt:['体育会系','インパクト']},
  {t:'陽',r:'よう',s:12,w:1,pt:['天然','親しみ']},
  {t:'花子',r:'はなこ',s:10,w:1,pt:['天然','親しみ']},
  {t:'正人',r:'まさと',s:7,w:1,pt:['知性系','本格']},
  {t:'翔',r:'しょう',s:12,w:1,pt:['体育会系','インパクト']},
  {t:'明',r:'あきら',s:8,w:1,pt:['親しみ','知性系']},
  {t:'空',r:'そら',s:8,w:1,pt:['天然','親しみ']},
  {t:'勇気',r:'ゆうき',s:11,w:1,pt:['体育会系','インパクト']},
  {t:'美智子',r:'みちこ',s:15,w:1,pt:['知性系','本格']},
  {t:'一郎',r:'いちろう',s:10,w:1,pt:['本格','知性系']},
  {t:'健',r:'けん',s:11,w:1,pt:['体育会系','親しみ']},
  {t:'幸子',r:'さちこ',s:11,w:1,pt:['親しみ','天然']},
  {t:'喜美',r:'きみ',s:21,w:1,pt:['天然','親しみ']},
  {t:'龍也',r:'りゅうや',s:19,w:1,pt:['インパクト','体育会系']},
  {t:'恵理',r:'えり',s:23,w:1,pt:['知性系','本格']},

  // カタカナ（高確率: weight=4）
  // 外国人名前系
  {t:'マリア',r:'まりあ',s:5,w:4,pt:['親しみ','天然']},
  {t:'ソフィア',r:'そふぃあ',s:6,w:4,pt:['本格','知性系']},
  {t:'エミリー',r:'えみりー',s:6,w:4,pt:['親しみ','天然']},
  {t:'ローラ',r:'ろーら',s:5,w:4,pt:['親しみ']},
  {t:'ルーカス',r:'るーかす',s:6,w:4,pt:['インパクト','体育会系']},
  {t:'フランソワ',r:'ふらんそわ',s:8,w:4,pt:['本格','知性系']},
  {t:'アントニオ',r:'あんとにお',s:8,w:4,pt:['体育会系','インパクト']},
  {t:'クロード',r:'くろーど',s:6,w:4,pt:['本格','知性系']},
  {t:'リコ',r:'りこ',s:3,w:4,pt:['親しみ','天然']},
  {t:'マックス',r:'まっくす',s:6,w:4,pt:['体育会系','インパクト']},
  {t:'ニコラス',r:'にこらす',s:7,w:4,pt:['知性系','本格']},
  {t:'アレックス',r:'あれっくす',s:8,w:4,pt:['インパクト','体育会系']},
  {t:'レオ',r:'れお',s:3,w:4,pt:['インパクト','親しみ']},
  {t:'ジュリア',r:'じゅりあ',s:6,w:4,pt:['親しみ','本格']},
  {t:'ビクター',r:'びくたー',s:6,w:4,pt:['体育会系','インパクト']},
  {t:'オリビア',r:'おりびあ',s:6,w:4,pt:['親しみ']},
  {t:'カルロス',r:'かるろす',s:6,w:4,pt:['体育会系']},
  {t:'イザベル',r:'いざべる',s:6,w:4,pt:['本格','知性系']},
  {t:'ガブリエル',r:'がぶりえる',s:8,w:4,pt:['インパクト','体育会系']},
  {t:'エリック',r:'えりっく',s:6,w:4,pt:['インパクト','知性系']},
  {t:'ルイ',r:'るい',s:3,w:4,pt:['本格','親しみ']},
  {t:'アリス',r:'ありす',s:5,w:4,pt:['天然','親しみ']},
  {t:'アイダ',r:'あいだ',s:5,w:4,pt:['親しみ']},
  {t:'ノア',r:'のあ',s:3,w:4,pt:['天然','親しみ']},
  {t:'リアム',r:'りあむ',s:4,w:4,pt:['体育会系','インパクト']},
  // かっこいいカタカナ系
  {t:'マサル',r:'まさる',s:5,w:4,pt:['体育会系']},
  {t:'ケン',r:'けん',s:3,w:4,pt:['体育会系','親しみ']},
  {t:'ハナ',r:'はな',s:3,w:4,pt:['親しみ','天然']},
  {t:'ゾウ',r:'ぞう',s:3,w:4,pt:['インパクト','天然']},
  {t:'タロウ',r:'たろう',s:5,w:4,pt:['天然','体育会系']},
  {t:'ユウ',r:'ゆう',s:3,w:4,pt:['親しみ']},
  {t:'リン',r:'りん',s:3,w:4,pt:['親しみ','本格']},
  {t:'コウ',r:'こう',s:3,w:4,pt:['インパクト','知性系']},
  {t:'ミオ',r:'みお',s:3,w:4,pt:['親しみ']},
  {t:'カイ',r:'かい',s:3,w:4,pt:['体育会系','インパクト']},
  {t:'レン',r:'れん',s:3,w:4,pt:['インパクト','本格']},
  {t:'ソウ',r:'そう',s:3,w:4,pt:['インパクト','体育会系']},
  {t:'ナオ',r:'なお',s:3,w:4,pt:['親しみ','天然']},
  {t:'アイ',r:'あい',s:3,w:4,pt:['親しみ']},
  // ユニーク・おもしろ系
  {t:'チャンプ',r:'ちゃんぷ',s:5,w:4,pt:['体育会系','インパクト']},
  {t:'ボンバー',r:'ぼんばー',s:6,w:4,pt:['体育会系','インパクト']},
  {t:'ゴリラ',r:'ごりら',s:5,w:4,pt:['体育会系','天然']},
  {t:'タイガー',r:'たいがー',s:6,w:4,pt:['体育会系','インパクト']},
  {t:'ドラゴン',r:'どらごん',s:6,w:4,pt:['インパクト','体育会系']},
  {t:'サムライ',r:'さむらい',s:6,w:4,pt:['本格','インパクト']},
  {t:'ニンジャ',r:'にんじゃ',s:5,w:4,pt:['インパクト']},
  {t:'ショーグン',r:'しょーぐん',s:7,w:4,pt:['本格','インパクト']},
  {t:'マジシャン',r:'まじしゃん',s:7,w:4,pt:['知性系','インパクト']},
  {t:'ピエロ',r:'ぴえろ',s:5,w:4,pt:['天然','インパクト']},
  {t:'ジョーカー',r:'じょーかー',s:7,w:4,pt:['天然','毒舌']},
  {t:'バスター',r:'ばすたー',s:6,w:4,pt:['体育会系']},
  {t:'ロケット',r:'ろけっと',s:6,w:4,pt:['体育会系','インパクト']},
  {t:'ジェット',r:'じぇっと',s:5,w:4,pt:['インパクト','体育会系']},
  {t:'コメット',r:'こめっと',s:6,w:4,pt:['インパクト']},
  // 食べ物・癒し系
  {t:'プリン',r:'ぷりん',s:5,w:4,pt:['親しみ','天然']},
  {t:'ムース',r:'むーす',s:5,w:4,pt:['親しみ','天然']},
  {t:'クリーム',r:'くりーむ',s:6,w:4,pt:['親しみ']},
  {t:'ワッフル',r:'わっふる',s:6,w:4,pt:['天然','親しみ']},
  {t:'タピオカ',r:'たぴおか',s:6,w:4,pt:['天然','親しみ']},
  {t:'ナタデ',r:'なたで',s:5,w:4,pt:['天然']},
  {t:'チーズ',r:'ちーず',s:5,w:4,pt:['親しみ','天然']},
  {t:'バター',r:'ばたー',s:5,w:4,pt:['親しみ','天然']},
  {t:'ハチミツ',r:'はちみつ',s:7,w:4,pt:['親しみ','天然']},
  {t:'キャラメル',r:'きゃらめる',s:8,w:4,pt:['親しみ']},
  // 知性・毒舌系
  {t:'ロジック',r:'ろじっく',s:6,w:4,pt:['知性系']},
  {t:'カオス',r:'かおす',s:5,w:4,pt:['毒舌','インパクト']},
  {t:'パラドックス',r:'ぱらどっくす',s:10,w:4,pt:['知性系','毒舌']},
  {t:'シニカル',r:'しにかる',s:6,w:4,pt:['毒舌','知性系']},
  {t:'クリティカル',r:'くりてぃかる',s:9,w:4,pt:['毒舌','知性系']},
  {t:'アイロニー',r:'あいろにー',s:7,w:4,pt:['毒舌','知性系']},
  {t:'ファンタジー',r:'ふぁんたじー',s:9,w:4,pt:['天然','知性系']},
  {t:'ミステリー',r:'みすてりー',s:8,w:4,pt:['知性系','本格']},
  {t:'カリスマ',r:'かりすま',s:6,w:4,pt:['本格','知性系']},
  {t:'アリーナ',r:'ありーな',s:6,w:4,pt:['インパクト','体育会系']},
];

// ── 1ワード芸名プール ──
const ONE_WORD = [
  {t:'ペットボトル',r:'ぺっとぼとる',s:11},
  {t:'フライパン',r:'ふらいぱん',s:8},
  {t:'ダンボール',r:'だんぼーる',s:8},
  {t:'コンセント',r:'こんせんと',s:8},
  {t:'マスカット',r:'ますかっと',s:7},
  {t:'ハンドソープ',r:'はんどそーぷ',s:10},
  {t:'ガムテープ',r:'がむてーぷ',s:8},
  {t:'シュークリーム',r:'しゅーくりーむ',s:11},
  {t:'カーテンレール',r:'かーてんれーる',s:12},
  {t:'スプーン',r:'すぷーん',s:6},
  {t:'トランポリン',r:'とらんぽりん',s:10},
  {t:'バリカン',r:'ばりかん',s:6},
  {t:'ビニールハウス',r:'びにーるはうす',s:12},
  {t:'メロンパン',r:'めろんぱん',s:8},
  {t:'シャンデリア',r:'しゃんでりあ',s:9},
];

const KONBI_A = [
  {t:'月光',st:['インパクト','親しみ']},
  {t:'電撃',st:['インパクト']},
  {t:'天然',st:['親しみ']},
  {t:'超速',st:['インパクト']},
  {t:'伝説',st:['本格','インパクト']},
  {t:'宇宙',st:['親しみ','インパクト']},
  {t:'疾風',st:['インパクト','本格']},
  {t:'神風',st:['インパクト']},
  {t:'天才',st:['本格','インパクト']},
  {t:'爆笑',st:['インパクト','親しみ']},
  {t:'夢想',st:['親しみ','本格']},
  {t:'快速',st:['インパクト','親しみ']},
  {t:'無敵',st:['インパクト']},
  {t:'最強',st:['インパクト','体育会系']},
  {t:'永遠',st:['本格','親しみ']},
  {t:'銀河',st:['インパクト','本格']},
  {t:'幻想',st:['本格']},
  {t:'爆裂',st:['インパクト']},
  {t:'超特急',st:['インパクト']},
  {t:'波乱',st:['インパクト','毒舌']},
];
const KONBI_B = [
  {t:'ブラザーズ',st:['親しみ','インパクト']},
  {t:'スタイル',st:['本格','インパクト']},
  {t:'商会',st:['親しみ','インパクト']},
  {t:'探偵団',st:['インパクト','本格']},
  {t:'軍団',st:['インパクト']},
  {t:'一座',st:['本格']},
  {t:'タウン',st:['親しみ']},
  {t:'クラブ',st:['本格','インパクト']},
  {t:'ファイターズ',st:['インパクト']},
  {t:'楽団',st:['親しみ','本格']},
  {t:'堂',st:['本格']},
  {t:'家族',st:['親しみ']},
  {t:'団地',st:['親しみ','インパクト']},
  {t:'道場',st:['本格','インパクト']},
  {t:'学園',st:['親しみ','本格']},
  {t:'工場',st:['インパクト','親しみ']},
  {t:'大作戦',st:['インパクト']},
  {t:'ジャパン',st:['インパクト','本格']},
  {t:'ワールド',st:['インパクト','本格']},
  {t:'スタジアム',st:['インパクト']},
];

const PERSONALITY_INFO = {
  '天然': {label:'天然ボケ系芸人', icon:'🌸', desc:'予想外のズレが笑いを生む愛されキャラ。計算ではなく本能で笑わせるタイプ。'},
  '毒舌': {label:'毒舌系芸人', icon:'⚡', desc:'切れ味鋭い言葉と観察眼が武器。本音をズバリ言える強さが個性になる。'},
  '体育会系': {label:'体育会系芸人', icon:'🔥', desc:'勢いとテンションで場を制す。全力でぶつかるエネルギーが笑いになる。'},
  '知性系': {label:'インテリ系芸人', icon:'📚', desc:'言葉遊びと構成力で唸らせる。笑いの中に知性と教養が光るタイプ。'},
};

const STYLE_INFO = {
  'インパクト': {label:'🔥 インパクト系', badge:'badge-impact', desc:'一度聞いたら忘れられない'},
  '親しみ': {label:'😊 親しみ系', badge:'badge-friendly', desc:'愛されキャラになれる'},
  '本格': {label:'✨ 本格系', badge:'badge-pro', desc:'売れ線・実力派向け'},
};

const Q_BOKE = [
  {id:'b01',q:'コンビニで会計が1円足りなかった。あなたのボケは？',c:[{t:'「あと1円、お借りできますか？」と店員に聞く',p:'天然'},{t:'「じゃあこのガム1本返します」',p:'毒舌'},{t:'財布をひっくり返して床に全部ばら撒く',p:'体育会系'}]},
  {id:'b02',q:'美容師に「どんな髪型にしますか？」と聞かれた。ボケは？',c:[{t:'「風の流れに任せた感じで」',p:'天然'},{t:'「あなたが後悔しない感じで」',p:'毒舌'},{t:'「勝てる顔にしてください！」',p:'体育会系'}]},
  {id:'b03',q:'電車で隣の人が急に鼻歌を歌い始めた。ボケは？',c:[{t:'「あの、リクエストいいですか？」',p:'天然'},{t:'「イヤホン、1本あげましょうか」',p:'毒舌'},{t:'立ち上がって手拍子を始める',p:'体育会系'}]},
  {id:'b04',q:'射的で一個も当たらなかった。ボケは？',c:[{t:'「銃との相性が合いませんでした」',p:'天然'},{t:'「おかしい、家では百発百中なのに」',p:'毒舌'},{t:'「もう一回！もう一回！」とお金を投入し続ける',p:'体育会系'}]},
  {id:'b05',q:'取引先に「田中さんですよね？」と間違えられた。ボケは？',c:[{t:'「あ、今日は田中でいきます」',p:'天然'},{t:'「田中とは10年の付き合いです」',p:'毒舌'},{t:'「田中ッ！」と大声で返事をする',p:'体育会系'}]},
  {id:'b06',q:'自販機でジュースが2本出てきた。ボケは？',c:[{t:'「機械も気を遣ってくれるんですね」',p:'天然'},{t:'「これが本当の2for1ですね」',p:'知性系'},{t:'急いでもう1本分のお金を入れる',p:'体育会系'}]},
  {id:'b07',q:'カラオケ採点で10点が出た。ボケは？',c:[{t:'「これが私の音楽です」',p:'天然'},{t:'「機械が壊れているんでしょう」',p:'毒舌'},{t:'「もう一回！絶対もう一回！」',p:'体育会系'}]},
  {id:'b08',q:'大事な会議の直前にネクタイにコーヒーをこぼした。ボケは？',c:[{t:'「これが今日のアクセントです」',p:'天然'},{t:'「これにより私の個性が出ました」',p:'知性系'},{t:'「誰かネクタイ持ってませんか！」と走り回る',p:'体育会系'}]},
  {id:'b09',q:'友達の家に行ったら猫が7匹いた。ボケは？',c:[{t:'「みなさんのことは聞いていましたが、初めてですね」',p:'天然'},{t:'「事前に申告してもらわないと心の準備が」',p:'毒舌'},{t:'「よし、全員と仲良くなろう！」と突進する',p:'体育会系'}]},
  {id:'b10',q:'誕生日ケーキのろうそくを一人では吹き消せなかった。ボケは？',c:[{t:'「これは年齢の証明だと受け止めます」',p:'天然'},{t:'「このケーキ、肺活量テストのつもりですね」',p:'知性系'},{t:'扇風機を持ってきて全力で当てる',p:'体育会系'}]},
  {id:'b11',q:'病院の待合室で名前を呼ばれる前に居眠りした。ボケは？',c:[{t:'「夢の中で診察を受けました」',p:'天然'},{t:'「待ち時間が長すぎるのでは」',p:'毒舌'},{t:'「ハイ！」と立ち上がって転ぶ',p:'体育会系'}]},
  {id:'b12',q:'初デートで財布を忘れたことに気づいた。ボケは？',c:[{t:'「今日は気持ちで払います」',p:'天然'},{t:'「これはあなたへのサプライズです」',p:'知性系'},{t:'「すみません、取りに帰ります！」と本当に走る',p:'体育会系'}]},
  {id:'b13',q:'駅の改札で交通系カードがエラーになった。ボケは？',c:[{t:'「今日は徒歩で帰れという意味ですね」',p:'天然'},{t:'「カードのほうが疲れているんでしょう」',p:'知性系'},{t:'カードを磨いて息を吹きかけて再挑戦する',p:'体育会系'}]},
  {id:'b14',q:'スーパーの試食で苦手な食材を勧められた。ボケは？',c:[{t:'「これはきっと好きになる練習ですね」',p:'天然'},{t:'「非常に面白い挑戦をいただきました」',p:'知性系'},{t:'「食べます！何があっても食べます！」',p:'体育会系'}]},
  {id:'b15',q:'映画館で隣の人が全部ネタバレを言ってきた。ボケは？',c:[{t:'「先に知れてお得でした」',p:'天然'},{t:'「ありがとう、入場料を返してもらえますか」',p:'毒舌'},{t:'「最初から全部知ってましたよ！」と嘘をつく',p:'体育会系'}]},
  {id:'b16',q:'喫茶店でホットとアイス、どちらにするか聞かれた。ボケは？',c:[{t:'「どちらも温度があるということで」',p:'天然'},{t:'「あなたはどちらだと思いますか？」',p:'毒舌'},{t:'「両方ください！」',p:'体育会系'}]},
  {id:'b17',q:'銀行のATMで後ろに行列ができてしまった。ボケは？',c:[{t:'「みなさんにとって良い待ち時間でありますように」',p:'天然'},{t:'「銀行は待つことも含めてサービスですよね」',p:'知性系'},{t:'振り向いて「あと少しです！応援よろしく！」',p:'体育会系'}]},
  {id:'b18',q:'タクシーで「どこへ」と聞かれて言葉が出なかった。ボケは？',c:[{t:'「あ、まだ決まっていませんでした」',p:'天然'},{t:'「どこが良いと思いますか？」',p:'毒舌'},{t:'「とりあえず出発してください！走りながら考えます！」',p:'体育会系'}]},
  {id:'b19',q:'テレビ収録で「自己紹介をどうぞ」と振られた。ボケは？',c:[{t:'「はじめまして。まだ自己紹介途中の者です」',p:'天然'},{t:'「長くなりますが、よろしいですか？」',p:'毒舌'},{t:'「自己紹介といえばコレ！」と突然一発芸を始める',p:'体育会系'}]},
  {id:'b20',q:'初めて作った料理を食べてもらったら絶妙な顔をされた。ボケは？',c:[{t:'「その顔がすべてを語っていますね」',p:'天然'},{t:'「いまのが正直な感想でいいです」',p:'毒舌'},{t:'「大丈夫です、私も同じ顔しました」',p:'体育会系'}]},
  {id:'b21',q:'ヨガ教室で一人だけポーズがとれなかった。ボケは？',c:[{t:'「私の体は別のポーズを提案しています」',p:'天然'},{t:'「このポーズ、設計に欠陥があると思います」',p:'知性系'},{t:'「もう1回！もう1回！」と諦めない',p:'体育会系'}]},
  {id:'b22',q:'宅配便の不在票に「笑顔でお待ちしております」と書いてあった。ボケは？',c:[{t:'「それだけで十分です」',p:'天然'},{t:'「笑顔を確認するシステムがあるのですか？」',p:'知性系'},{t:'「笑顔の練習をしてから再配達を頼みます」',p:'体育会系'}]},
  {id:'b23',q:'アマゾンで頼んだ荷物の中身が違った。ボケは？',c:[{t:'「これも運命だと思います」',p:'天然'},{t:'「サプライズのつもりでしょうか」',p:'知性系'},{t:'「箱から開け直しましょう！」と動画撮影を始める',p:'体育会系'}]},
  {id:'b24',q:'上司に呼ばれたら「昼飯一緒に行こう」だった。ボケは？',c:[{t:'「あ、私お弁当持ってきました」',p:'天然'},{t:'「やっぱり仕事の話ですよね？」',p:'毒舌'},{t:'「やったー！」と声に出してしまう',p:'体育会系'}]},
  {id:'b25',q:'お祭りの型抜きで全部失敗した。ボケは？',c:[{t:'「型に入りたくない気持ちがあるんでしょうね」',p:'天然'},{t:'「これは型抜きじゃなくて型崩しですね」',p:'知性系'},{t:'「もう一回！絶対もう一回！」',p:'体育会系'}]},
];

const Q_TSUKKOMI = [
  {id:'t01',q:'相方が「俺、昨日宇宙人と話してきた」と言い出した。ツッコミは？',c:[{t:'「内容、教えてもらえますか？」',p:'天然'},{t:'「それが本当なら今すぐ証明して」',p:'毒舌'},{t:'「誰やねん！」',p:'体育会系'}]},
  {id:'t02',q:'相方が「私、前世は猫だったと思う」と言い出した。ツッコミは？',c:[{t:'「どんな猫？」',p:'天然'},{t:'「今世も大して変わらないけどね」',p:'毒舌'},{t:'「それで今世は何になった！」',p:'体育会系'}]},
  {id:'t03',q:'相方が「天気予報は実は私が決めてる」と言い出した。ツッコミは？',c:[{t:'「じゃあ明日は晴れますか？」',p:'天然'},{t:'「だから最近ハズレが多いんやね」',p:'毒舌'},{t:'「何を言ってるんやー！」',p:'体育会系'}]},
  {id:'t04',q:'相方が舞台に傘を持って登場した。ツッコミは？',c:[{t:'「今日、雨の予報でしたっけ」',p:'天然'},{t:'「それは衣装費に入ってないけどね」',p:'毒舌'},{t:'「なんで傘持っとんねん！」',p:'体育会系'}]},
  {id:'t05',q:'相方が「食べたものが全部同じ味がする」と言い出した。ツッコミは？',c:[{t:'「それ、何の味がするんですか？」',p:'天然'},{t:'「それはもう病院に行きなさい」',p:'毒舌'},{t:'「何味やねん！」',p:'体育会系'}]},
  {id:'t06',q:'相方が打ち合わせ中に突然泣き出した。ツッコミは？',c:[{t:'「大丈夫ですか？何かありましたか？」',p:'天然'},{t:'「それは今日の案件と関係ありますか？」',p:'知性系'},{t:'「なんで泣いとんねん！今打ち合わせ中やろ！」',p:'体育会系'}]},
  {id:'t07',q:'相方がステージ上でスマホを取り出してSNSを見始めた。ツッコミは？',c:[{t:'「何か緊急のことがありましたか？」',p:'天然'},{t:'「今日で相方卒業します」',p:'毒舌'},{t:'「何やっとんねん！今ネタ中やぞ！」',p:'体育会系'}]},
  {id:'t08',q:'相方が「俺、タコが怖い」と急に言い出した。ツッコミは？',c:[{t:'「足が多いからですか？」',p:'天然'},{t:'「タコ焼きは食べるくせに」',p:'毒舌'},{t:'「なんでやねん！」',p:'体育会系'}]},
  {id:'t09',q:'相方がネタの最中に「台本見ていいですか」と言い出した。ツッコミは？',c:[{t:'「どうぞ、急がなくていいですよ」',p:'天然'},{t:'「今日の練習、何時間したんですか」',p:'毒舌'},{t:'「覚えてこんかい！！」',p:'体育会系'}]},
  {id:'t10',q:'相方が「最近、犬と目が合うと先に目をそらされる」と悩んでいた。ツッコミは？',c:[{t:'「犬にも個性がありますからね」',p:'天然'},{t:'「犬に嫌われる人間って珍しいよね」',p:'毒舌'},{t:'「そんな悩みあるかい！」',p:'体育会系'}]},
  {id:'t11',q:'相方が帽子を5枚重ねて登場した。ツッコミは？',c:[{t:'「今日、寒かったですか？」',p:'天然'},{t:'「それ全部、衣装代請求するつもり？」',p:'毒舌'},{t:'「何枚かぶっとんねん！」',p:'体育会系'}]},
  {id:'t12',q:'相方が「今日から菜食主義にする」と言って直後にから揚げを頼んだ。ツッコミは？',c:[{t:'「鶏は菜食に入りますか？」',p:'天然'},{t:'「今日からって今日含んでないやつね」',p:'毒舌'},{t:'「早すぎるわ！宣言して30秒やぞ！」',p:'体育会系'}]},
  {id:'t13',q:'相方が舞台上で突然腕立て伏せを始めた。ツッコミは？',c:[{t:'「緊張をほぐしていますか？」',p:'天然'},{t:'「そのネタ、いつ聞いたんですか？」',p:'毒舌'},{t:'「何しとんねん！今ネタ中やで！」',p:'体育会系'}]},
  {id:'t14',q:'相方が自分の誕生日を間違えていた。ツッコミは？',c:[{t:'「お母さんに確認してみましょう」',p:'天然'},{t:'「自分の誕生日くらい覚えといて」',p:'毒舌'},{t:'「何年生きてんねん！」',p:'体育会系'}]},
  {id:'t15',q:'相方の財布に1円玉が500枚入っていた。ツッコミは？',c:[{t:'「計画的に集めていたんですか？」',p:'天然'},{t:'「それは財布じゃなくて貯金箱だよ」',p:'知性系'},{t:'「なんでそんなになるまで放っといたんや！」',p:'体育会系'}]},
  {id:'t16',q:'相方が「昨日、空に自分の名前が見えた」と言い出した。ツッコミは？',c:[{t:'「雲の形がそう見えたんですか？」',p:'天然'},{t:'「それは病院か眼科、どちらへ？」',p:'知性系'},{t:'「何見とんねん！」',p:'体育会系'}]},
  {id:'t17',q:'相方が舞台に辞書を持って登場した。ツッコミは？',c:[{t:'「今日は言葉を大切にするんですか？」',p:'天然'},{t:'「それでネタの穴を埋める気？」',p:'毒舌'},{t:'「なんで辞書持ってきとんねん！」',p:'体育会系'}]},
  {id:'t18',q:'相方が「コーヒーが飲めなくなった」と言ったが手にコーヒーを持っていた。ツッコミは？',c:[{t:'「それはジュースですか？」',p:'天然'},{t:'「手に持ってるのは何ですか」',p:'知性系'},{t:'「今飲んどるやないか！！」',p:'体育会系'}]},
  {id:'t19',q:'相方が「俺って笑顔で損をしてると思う」と言い出した。ツッコミは？',c:[{t:'「笑顔が多いと得をすることもありますよ」',p:'天然'},{t:'「まず笑顔かどうか、鏡で確認してから言って」',p:'毒舌'},{t:'「どんな笑顔やねん！見せてみ！」',p:'体育会系'}]},
  {id:'t20',q:'相方が鉛筆でメモを取ろうとしてずっと芯が折れ続けている。ツッコミは？',c:[{t:'「力を少し抜いてみてはどうですか」',p:'天然'},{t:'「シャーペン使ったら？今は令和だから」',p:'知性系'},{t:'「もうそのメモ、諦めろ！」',p:'体育会系'}]},
  {id:'t21',q:'相方が「夢の中でお金を稼ぐ方法を思いついた」と言い出した。ツッコミは？',c:[{t:'「どんな方法ですか？」',p:'天然'},{t:'「起きてから試してください」',p:'毒舌'},{t:'「夢の中で完結させとけ！」',p:'体育会系'}]},
  {id:'t22',q:'相方が「実は算数が得意」と言って簡単な計算を間違えた。ツッコミは？',c:[{t:'「今日は調子が悪いんでしょうね」',p:'天然'},{t:'「算数の定義を教えてください」',p:'知性系'},{t:'「得意ちゃうやないか！！」',p:'体育会系'}]},
  {id:'t23',q:'相方が「最近、毎朝4時に自然に目が覚める」と自慢してきた。ツッコミは？',c:[{t:'「体内時計が正確なんですね」',p:'天然'},{t:'「それ、自慢にならないから」',p:'毒舌'},{t:'「なんで！！なんで4時に！！」',p:'体育会系'}]},
  {id:'t24',q:'相方が本番直前に「少し休憩してもいいですか」と言い出した。ツッコミは？',c:[{t:'「どうぞ、ゆっくりしてください」',p:'天然'},{t:'「開演5分前に言うことじゃないよ」',p:'毒舌'},{t:'「今から休んでどうすんねん！！」',p:'体育会系'}]},
  {id:'t25',q:'相方が「俺、実は透明人間になれると思う」と言い出した。ツッコミは？',c:[{t:'「どうやって？」',p:'天然'},{t:'「思うだけじゃなくてやってみて」',p:'毒舌'},{t:'「なれへんわ！！」',p:'体育会系'}]},
];

const Q_PIN = [
  {id:'p01',q:'こんな占い師はやだ！どんな占い師？',c:[{t:'水晶玉の代わりにスーパーボールを使っている',p:'知性系'},{t:'「うーん、ちょっとGoogleで調べていいですか」と言う',p:'天然'},{t:'鑑定結果がいつも「まあ何とかなる」で締める',p:'毒舌'}]},
  {id:'p02',q:'100年後の「おはようございます」ってどんな感じ？',c:[{t:'「起動おめでとうございます」',p:'知性系'},{t:'「昨日もお疲れ様でした（翌朝Ver.）」',p:'天然'},{t:'全言語同時自動翻訳で発声される',p:'毒舌'}]},
  {id:'p03',q:'こんな漫才師はやだ！どんな漫才師？',c:[{t:'ネタより先に「次の仕事が〜」と自己PRを始める',p:'毒舌'},{t:'ボケとツッコミが毎回入れ替わって自分でもわからない',p:'天然'},{t:'笑いのタイミングを手元の台本で確認している',p:'知性系'}]},
  {id:'p04',q:'こんな占いの結果は嫌だ！どんな結果？',c:[{t:'「あなたの前世はもやしです」',p:'天然'},{t:'「今日の運勢：ふつう（以上でも以下でもない）」',p:'知性系'},{t:'「大吉」なのに注意事項が20項目',p:'毒舌'}]},
  {id:'p05',q:'もし芸人が総理大臣になったら？どんな国会？',c:[{t:'法案にツッコミを入れる野党が出てきた',p:'知性系'},{t:'予算委員会が全部漫才形式になった',p:'天然'},{t:'施政方針演説が一発芸で始まる',p:'体育会系'}]},
  {id:'p06',q:'こんな相方はやだ！どんな相方？',c:[{t:'ボケをボケたまま終わらせて次に進む',p:'天然'},{t:'ネタ中に「このツッコミ、ウケてる？」と聞いてくる',p:'知性系'},{t:'ボケる前に「笑ってください」と予告する',p:'毒舌'}]},
  {id:'p07',q:'100年後の「いただきます」ってどんな感じ？',c:[{t:'「栄養プログラム、起動します」',p:'知性系'},{t:'「このデータ、消費します」',p:'天然'},{t:'AIが全員分のカロリー計算をしてから許可を出す',p:'毒舌'}]},
  {id:'p08',q:'こんなオーディションはやだ！どんなオーディション？',c:[{t:'審査員全員が寝ている',p:'天然'},{t:'「面白さは後で採点します」と言われる',p:'知性系'},{t:'「笑ったら負け」のルールがある',p:'毒舌'}]},
  {id:'p09',q:'芸人が宇宙に行ったら何をする？',c:[{t:'無重力ボケをひたすらやる',p:'体育会系'},{t:'地球に向かってツッコミを入れる（「でかすぎるやろ！」）',p:'知性系'},{t:'宇宙人向けに日本語漫才を披露して困惑される',p:'天然'}]},
  {id:'p10',q:'こんな笑点はやだ！どんな笑点？',c:[{t:'座布団の代わりにクッションが積まれる',p:'天然'},{t:'お題が「最近気になったニュース」だけになる',p:'毒舌'},{t:'回答者が全員スマホで答えを調べてから言う',p:'知性系'}]},
  {id:'p11',q:'もし芸人が医者になったら？どんな診察？',c:[{t:'「痛いところは？…では笑いで治しましょう」',p:'天然'},{t:'処方箋に「お笑いDVD1日3本」と書く',p:'知性系'},{t:'診察より先に「今日はどんなお気持ちですか？」とMCを始める',p:'毒舌'}]},
  {id:'p12',q:'こんなM-1グランプリはやだ！どんなM-1？',c:[{t:'優勝者が「実は今日が初舞台」',p:'天然'},{t:'審査員の得点がバラバラすぎて平均が出ない',p:'知性系'},{t:'漫才中に審査員がツッコんでくる',p:'体育会系'}]},
  {id:'p13',q:'こんな漫才の衣装はやだ！どんな衣装？',c:[{t:'スーツなのにサンダル',p:'天然'},{t:'テーマに合わせて毎回着替えるため着替え時間の方が長い',p:'知性系'},{t:'上下違うコンビのスーツを着て登場',p:'体育会系'}]},
  {id:'p14',q:'こんな占い館はやだ！どんな占い館？',c:[{t:'「お待ちください」と言われて2時間待つ',p:'天然'},{t:'鑑定結果がメールで届くのが1週間後',p:'知性系'},{t:'館内がとにかく明るい（蛍光灯でギラギラ）',p:'毒舌'}]},
  {id:'p15',q:'もし動物が漫才をしたら？どんな漫才？',c:[{t:'犬：「お手！」猫：「やだ」…でずっと続く',p:'天然'},{t:'パンダが「笹！笹！笹！」とボケるだけ',p:'体育会系'},{t:'カラスが「なんでやねん」だけ覚えて使い回す',p:'知性系'}]},
  {id:'p16',q:'もし芸人が学校の先生になったら？どんな授業？',c:[{t:'算数の時間に「ツッコミのタイミング」を教え始める',p:'知性系'},{t:'起立・礼・着席が一発芸に変わる',p:'体育会系'},{t:'テストの答えが「ウケればなんでも正解」',p:'天然'}]},
  {id:'p17',q:'100年後の「おやすみなさい」ってどんな感じ？',c:[{t:'「本日の活動、終了します」',p:'知性系'},{t:'AIが「睡眠効率が低下しています。再調整しますか？」と聞いてくる',p:'毒舌'},{t:'全人類が同じ時刻に強制シャットダウン',p:'天然'}]},
  {id:'p18',q:'もしAIが漫才をしたら？どんな漫才？',c:[{t:'「処理中…ただいまボケを生成しています」',p:'知性系'},{t:'ウケなかった時の言い訳が「データ不足」',p:'毒舌'},{t:'客席の笑い声をリアルタイム分析しながらネタを変える',p:'天然'}]},
  {id:'p19',q:'100年後の「ありがとう」ってどんな感じ？',c:[{t:'「感謝ポイント、送信しました」',p:'知性系'},{t:'スタンプ1000種類から選んで送る',p:'天然'},{t:'AIが代わりに感謝の手紙を自動生成してくれる',p:'毒舌'}]},
  {id:'p20',q:'こんなYouTuberはやだ！どんなYouTuber？',c:[{t:'「今日は何も起きませんでした」という動画を週3で上げる',p:'天然'},{t:'サムネが毎回「ついに○○！？」なのに内容は普通',p:'毒舌'},{t:'コメント欄が全部「はじめまして」で埋まっている',p:'知性系'}]},
  {id:'p21',q:'こんな芸名はやだ！どんな芸名？',c:[{t:'「普通の田中」',p:'天然'},{t:'名刺に収まらない長さ',p:'知性系'},{t:'読み方が毎回説明が必要',p:'毒舌'}]},
  {id:'p22',q:'こんな芸人の楽屋はやだ！どんな楽屋？',c:[{t:'全員が別々の方向を向いて仕切りを作っている',p:'毒舌'},{t:'ネタの自主練がうるさくて静かな空間がない',p:'体育会系'},{t:'差し入れが全部昆布だけ',p:'天然'}]},
  {id:'p23',q:'もし芸人がスポーツ選手になったら？',c:[{t:'ピン芸人 → マラソン（一人でゴールを目指す）',p:'知性系'},{t:'漫才師 → テニスダブルス（コンビで戦う）',p:'天然'},{t:'コント師 → フィギュアスケート（演技点あり）',p:'体育会系'}]},
  {id:'p24',q:'こんな大喜利の司会者はやだ！どんな司会者？',c:[{t:'回答が出るたびに「それ、私も考えてました」と言う',p:'毒舌'},{t:'お題を自分でも答えてしまう',p:'天然'},{t:'回答時間を計るストップウォッチが壊れていて毎回曖昧',p:'知性系'}]},
  {id:'p25',q:'こんな芸人の年表はやだ！どんな年表？',c:[{t:'全部「修行中」',p:'天然'},{t:'「初舞台」と「引退」しかない',p:'毒舌'},{t:'出来事が多すぎてA4用紙50枚になった',p:'体育会系'}]},
];

let state = {role:null,questions:[],current:0,answers:[],selectedIdx:null,fromGame:false};

function selectRole(role,el){
  document.querySelectorAll('.role-btn').forEach(b=>b.classList.remove('selected'));
  el.classList.add('selected');
  state.role=role;
}
function getDate(){
  const v=document.getElementById('gDate').value;
  if(!v)return null;
  const[y,m,d]=v.split('-').map(Number);
  return{y,m,d};
}
function startGame(){
  if(!state.role){alert('芸風を選んでください');return;}
  if(!getDate()){alert('生年月日を入力してください');return;}
  state.fromGame=true;
  const pool=state.role==='boke'?Q_BOKE:state.role==='tsukkomi'?Q_TSUKKOMI:Q_PIN;
  state.questions=shuffle([...pool]).slice(0,10);
  state.current=0;state.answers=[];
  document.getElementById('formSection').style.display='none';
  document.getElementById('gameSection').style.display='block';
  const labels={boke:'ボケ担当',tsukkomi:'ツッコミ担当',pin:'ピン芸人'};
  document.getElementById('roleBadge').textContent=labels[state.role];
  renderQuestion();
}
function skipToResult(){
  if(!state.role){alert('芸風を選んでください');return;}
  if(!getDate()){alert('生年月日を入力してください');return;}
  state.fromGame=false;showResult();
}
function renderQuestion(){
  const q=state.questions[state.current];
  const pct=(state.current/10)*100;
  document.getElementById('progressFill').style.width=pct+'%';
  document.getElementById('progressText').textContent=(state.current+1)+' / 10';
  document.getElementById('gameQ').textContent=q.q;
  const wrap=document.getElementById('choicesWrap');
  wrap.innerHTML='';
  q.c.forEach((ch)=>{
    const btn=document.createElement('button');
    btn.className='choice-btn';btn.textContent=ch.t;
    btn.onclick=()=>selectChoice(ch.p,q.id,btn);
    wrap.appendChild(btn);
  });
  state.selectedIdx=null;
  document.getElementById('nextBtn').disabled=true;
  document.getElementById('freeWrap').classList.remove('show');
  document.getElementById('freeInput').value='';
}
function selectChoice(pType,qid,btn){
  document.querySelectorAll('.choice-btn').forEach(b=>b.classList.remove('selected'));
  btn.classList.add('selected');state.selectedIdx=0;
  state.answers.push({qid,type:pType});
  document.getElementById('nextBtn').disabled=false;
}
function toggleFree(){
  document.getElementById('freeWrap').classList.toggle('show');
}
function submitFree(){
  const val=document.getElementById('freeInput').value.trim();
  if(val.length<3){alert('3文字以上入力してください');return;}
  const q=state.questions[state.current];
  const fd=new FormData();
  fd.append('action','save_answer');fd.append('cat',state.role);fd.append('qid',q.id);fd.append('answer',val);
  fetch('',{method:'POST',body:fd}).catch(()=>{});
  document.querySelectorAll('.choice-btn').forEach(b=>b.classList.remove('selected'));
  state.answers.push({qid:q.id,type:'天然'});
  state.selectedIdx=0;
  document.getElementById('nextBtn').disabled=false;
  document.getElementById('freeWrap').classList.remove('show');
}
function nextQuestion(){
  if(state.selectedIdx===null)return;
  state.current++;
  if(state.current>=10)showResult();
  else renderQuestion();
}
function calcPersonality(){
  if(!state.fromGame||state.answers.length===0)return '天然';
  const cnt={'天然':0,'毒舌':0,'体育会系':0,'知性系':0};
  state.answers.forEach(a=>{if(cnt[a.type]!==undefined)cnt[a.type]++;});
  return Object.entries(cnt).sort((a,b)=>b[1]-a[1])[0][0];
}

// weightを考慮した抽選
function weightedPool(arr){
  const out=[];
  arr.forEach(item=>{
    const w=item.w||1;
    for(let i=0;i<w;i++)out.push(item);
  });
  return out;
}

function isLucky(n){return LUCKY.has(n);}

// カタカナかどうか
function isKata(str){return /^[ァ-ヶー]+$/.test(str);}

function genNames(personality){
  const styles=['インパクト','親しみ','本格'];
  const usedFullnames=new Set();
  resetKonbiUsed();

  return styles.map(style=>{
    // 1ワード芸名（10%の確率）
    const doOneWord=Math.random()<0.10;
    if(doOneWord){
      const ow=shuffle([...ONE_WORD])[0];
      const konbi=genKonbi(style);
      return{style,oneWord:ow,konbi,jinkaku:ow.s};
    }

    // 苗字候補: スタイル一致優先、なければ全体
    let myojiPool=weightedPool(MYOJI.filter(m=>m.st.includes(style)));
    if(!myojiPool.length)myojiPool=weightedPool(MYOJI);
    // 名前候補
    let namaePool=weightedPool(NAMAE);

    // 大吉の画数を探す（カタカナは固定s=6を使う）
    let found=null;
    const shuffledM=shuffle([...myojiPool]);
    const shuffledN=shuffle([...namaePool]);
    outer: for(const myoji of shuffledM){
      for(const namae of shuffledN){
        const key=myoji.t+'_'+namae.t;
        if(usedFullnames.has(key))continue;
        // カタカナ同士の重複を許可、漢字×漢字は同じ字種のみ排除
        const bothKanji=!isKata(myoji.t)&&!isKata(namae.t);
        if(bothKanji&&myoji.t===namae.t)continue;
        if(isLucky(myoji.s+namae.s)){
          found={myoji,namae,jinkaku:myoji.s+namae.s};
          usedFullnames.add(key);
          break outer;
        }
      }
    }
    if(!found){
      // 大吉なくても最初のペアで
      const m=shuffledM[0];const n=shuffledN[0];
      found={myoji:m,namae:n,jinkaku:m.s+n.s};
      usedFullnames.add(m.t+'_'+n.t);
    }

    const konbi=genKonbi(style);
    return{style,myoji:found.myoji,namae:found.namae,jinkaku:found.jinkaku,konbi};
  });
}

const _usedKonbiA=new Set();
const _usedKonbiB=new Set();
function genKonbi(style){
  const aPool=shuffle([...KONBI_A.filter(a=>a.st.includes(style))]);
  const bPool=shuffle([...KONBI_B.filter(b=>b.st.includes(style))]);
  const kA=aPool.find(a=>!_usedKonbiA.has(a.t))||aPool[0]||KONBI_A[0];
  const kB=bPool.find(b=>!_usedKonbiB.has(b.t))||bPool[0]||KONBI_B[0];
  _usedKonbiA.add(kA.t);_usedKonbiB.add(kB.t);
  return kA.t+kB.t;
}
function resetKonbiUsed(){_usedKonbiA.clear();_usedKonbiB.clear();}

function makeReason(myoji,namae,jinkaku,style,personality){
  const sD={'インパクト':'インパクトと個性の強さが','親しみ':'親しみやすさと愛されキャラの素質が','本格':'実力派芸人としての風格が'};
  const pD={'天然':'天然の笑いセンスを引き立て','毒舌':'毒舌の切れ味を磨き上げ','体育会系':'体育会系の勢いを後押しし','知性系':'インテリ的な笑いの構成力を活かし'};
  return `「${myoji.t} ${namae.t}」は人格${jinkaku}画で、大吉の画数です。${sD[style]}この名前に宿り、${pD[personality]||'芸人としての個性を活かし'}ます。`;
}

function buildSeimeiUrl(fullname){
  return '/seimei?name='+encodeURIComponent(fullname);
}

function showResult(){
  document.getElementById('loadingOverlay').classList.add('show');
  setTimeout(()=>{
    const personality=calcPersonality();
    const names=genNames(personality);
    const pCard=document.getElementById('personalityCard');
    if(state.fromGame){
      const pi=PERSONALITY_INFO[personality];
      pCard.innerHTML=`<div style="font-size:2rem;margin-bottom:.3rem">${pi.icon}</div><div class="personality-type">${pi.label}</div><div class="personality-desc">${pi.desc}</div>`;
      pCard.style.display='block';
    }else{pCard.style.display='none';}

    const cardsEl=document.getElementById('nameCards');
    cardsEl.innerHTML=names.map(n=>{
      const si=STYLE_INFO[n.style];
      if(n.oneWord){
        // 1ワード芸名パターン
        const seimeiUrl=buildSeimeiUrl(n.oneWord.t);
        return `<div class="name-card">
          <div class="name-card-header">
            <span class="name-card-badge ${si.badge}">${si.label}</span>
            <span class="name-card-title">${si.desc}</span>
          </div>
          <div class="name-card-body">
            <div class="fullname">${n.oneWord.t}</div>
            <div class="fullname-read">（${n.oneWord.r}）</div>
            <div class="konbi-section">
              <div class="konbi-label">コンビ・グループ名として</div>
              <div class="konbi-name">「${n.konbi}」</div>
              <a href="${seimeiUrl}" class="seimei-btn">✍️ この芸名で姓名判断 →</a>
              <span class="kata-note">※カタカナ芸名の画数は参考値です</span>
            </div>
          </div>
        </div>`;
      }
      const lucky=isLucky(n.jinkaku)?`人格${n.jinkaku}画（大吉）`:`人格${n.jinkaku}画`;
      const reason=state.fromGame?makeReason(n.myoji,n.namae,n.jinkaku,n.style,personality):'';
      const fullname=n.myoji.t+' '+n.namae.t;
      const seimeiUrl=buildSeimeiUrl(fullname);
      const hasKata=isKata(n.myoji.t)||isKata(n.namae.t);
      return `<div class="name-card">
        <div class="name-card-header">
          <span class="name-card-badge ${si.badge}">${si.label}</span>
          <span class="name-card-title">${si.desc}</span>
        </div>
        <div class="name-card-body">
          <div class="fullname">${n.myoji.t} ${n.namae.t}</div>
          <div class="fullname-read">（${n.myoji.r} ${n.namae.r}）</div>
          <div class="jinkaku-badge">${lucky}</div>
          ${reason?`<div class="name-reason">${reason}</div>`:''}
          <a href="${seimeiUrl}" class="seimei-btn">✍️ この芸名で姓名判断 →</a>
          ${hasKata?'<span class="kata-note">※カタカナ部分の画数は参考値です</span>':''}
          <div class="konbi-section">
            <div class="konbi-label">コンビ・グループ名として</div>
            <div class="konbi-name">「${n.konbi}」</div>
          </div>
        </div>
      </div>`;
    }).join('');

    document.getElementById('gameSection').style.display='none';
    document.getElementById('formSection').style.display='none';
    document.getElementById('resultSection').style.display='block';
    document.getElementById('inlineNavCards').style.display='block';
    document.getElementById('loadingOverlay').classList.remove('show');
    window.scrollTo({top:0,behavior:'smooth'});
  },900);
}
function resetAll(){
  state={role:null,questions:[],current:0,answers:[],selectedIdx:null,fromGame:false};
  document.querySelectorAll('.role-btn').forEach(b=>b.classList.remove('selected'));
  document.getElementById('resultSection').style.display='none';
  document.getElementById('gameSection').style.display='none';
  document.getElementById('formSection').style.display='block';
  window.scrollTo({top:0,behavior:'smooth'});
}
function shuffle(arr){for(let i=arr.length-1;i>0;i--){const j=Math.floor(Math.random()*(i+1));[arr[i],arr[j]]=[arr[j],arr[i]];}return arr;}
</script>
</body>
</html>
