<?php
declare(strict_types=1);

$sent    = false;
$error   = '';
$values  = ['name'=>'','email'=>'','message'=>''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ハニーポット（ボット対策）
    if (!empty($_POST['website'] ?? '')) {
        $sent = true;
    } else {
        $name    = trim($_POST['name']    ?? '');
        $email   = trim($_POST['email']   ?? '');
        $message = trim($_POST['message'] ?? '');

        $values = ['name'=>$name,'email'=>$email,'message'=>$message];

        if ($name === '' || $email === '' || $message === '') {
            $error = 'お名前・メールアドレス・お問い合わせ内容はすべて必須です。';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'メールアドレスの形式が正しくありません。';
        } elseif (mb_strlen($message) < 10) {
            $error = 'お問い合わせ内容は10文字以上ご記入ください。';
        } else {
            $to      = 'info@life-fun.net';
            $subject = '【占いPortal】お問い合わせ：' . mb_substr($name, 0, 30);
            $body    = "お名前：{$name}\nメール：{$email}\n\n{$message}";
            $headers = "From: noreply@life-fun.net\r\nReply-To: {$email}\r\nContent-Type: text/plain; charset=UTF-8";
            mail($to, $subject, $body, $headers);
            $sent = true;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-P1EKB3WWX8"></script>
  <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','G-P1EKB3WWX8');</script>
  <meta charset="UTF-8">
  <link rel="canonical" href="https://life-fun.net/contact" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="占いPortalへのご意見・ご感想・お問い合わせはこちらのフォームよりご連絡ください。">
  <title>お問い合わせ｜占いPortal</title>
  <link rel="icon" type="image/png" href="/favicon.png">
  <link rel="apple-touch-icon" href="/favicon.png">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6979913482925873" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500&family=DM+Mono:wght@300;400&display=swap" rel="stylesheet">
  <style>
  *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
  :root{
    --void:#08060f;--card:#1e1738;--border:rgba(160,130,220,.18);
    --gold:#c9a84c;--gold-lt:#e8c96a;--violet-lt:#c4a8f5;
    --text:#e8e2f5;--muted:#8a7db5;
    --ff-serif:'Shippori Mincho',serif;--ff-sans:'Zen Kaku Gothic New',sans-serif;--ff-mono:'DM Mono',monospace;
  }
  html{font-size:16px;scroll-behavior:smooth}
  body{background:var(--void);color:var(--text);font-family:var(--ff-sans);font-weight:300;line-height:1.8;min-height:100vh}
  body::before{content:'';position:fixed;inset:0;background:radial-gradient(ellipse at 20% 20%,rgba(90,50,180,.22) 0%,transparent 55%),radial-gradient(ellipse at 80% 80%,rgba(180,50,100,.14) 0%,transparent 55%);pointer-events:none;z-index:0}
  .wrap{position:relative;z-index:1;max-width:860px;margin:0 auto;padding:0 1.2rem}
  header{border-bottom:1px solid var(--border);padding:0 1.2rem;position:sticky;top:0;z-index:100;background:rgba(8,6,15,.9);backdrop-filter:blur(12px)}
  .header-inner{max-width:860px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;height:54px}
  .logo{font-family:var(--ff-serif);font-size:1.1rem;font-weight:700;color:var(--text);text-decoration:none;letter-spacing:.08em}
  .logo em{font-style:italic;color:var(--gold)}
  .header-nav{display:flex;gap:1.5rem}
  .header-nav a{font-family:var(--ff-mono);font-size:.72rem;color:var(--muted);text-decoration:none;letter-spacing:.08em;transition:color .2s}
  .header-nav a:hover{color:var(--gold-lt)}
  .hero{text-align:center;padding:3rem 1rem 2rem;border-bottom:1px solid var(--border);margin-bottom:2rem}
  .hero-eyebrow{font-family:var(--ff-mono);font-size:.68rem;letter-spacing:.25em;color:var(--gold);text-transform:uppercase;margin-bottom:1rem;display:block}
  .hero h1{font-family:var(--ff-serif);font-size:clamp(1.8rem,5vw,2.6rem);font-weight:700;line-height:1.2;letter-spacing:.06em;background:linear-gradient(135deg,var(--gold-lt) 0%,var(--violet-lt) 50%,#4ecdc4 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;margin-bottom:.5rem}
  .contact-box{background:linear-gradient(135deg,rgba(201,168,76,.06),rgba(155,114,239,.06));border:1px solid var(--border);border-radius:16px;padding:2rem;margin-bottom:2rem}
  .form-note{font-size:.8rem;color:var(--muted);margin-bottom:1.5rem;line-height:1.7}
  .form-group{margin-bottom:1.4rem}
  .form-label{display:block;font-family:var(--ff-mono);font-size:.72rem;letter-spacing:.1em;color:var(--gold);margin-bottom:.45rem}
  .form-label .req{color:#ef5350;margin-left:.3rem;font-size:.65rem}
  .form-input,.form-textarea{width:100%;background:rgba(255,255,255,.04);border:1px solid rgba(160,130,220,.3);border-radius:8px;padding:.7rem 1rem;color:var(--text);font-family:var(--ff-sans);font-size:.9rem;font-weight:300;transition:border-color .2s,box-shadow .2s;outline:none}
  .form-input:focus,.form-textarea:focus{border-color:rgba(155,114,239,.7);box-shadow:0 0 0 3px rgba(155,114,239,.12)}
  .form-textarea{resize:vertical;min-height:130px;line-height:1.7}
  .form-honeypot{display:none}
  .form-submit{display:inline-flex;align-items:center;gap:.5rem;background:linear-gradient(135deg,rgba(201,168,76,.2),rgba(155,114,239,.2));border:1px solid rgba(201,168,76,.4);border-radius:24px;padding:.75rem 2rem;font-family:var(--ff-serif);font-size:.9rem;color:var(--gold-lt);cursor:pointer;letter-spacing:.06em;transition:background .2s,box-shadow .2s}
  .form-submit:hover{background:linear-gradient(135deg,rgba(201,168,76,.3),rgba(155,114,239,.3));box-shadow:0 0 16px rgba(201,168,76,.2)}
  .msg-error{background:rgba(239,83,80,.1);border:1px solid rgba(239,83,80,.3);border-radius:8px;padding:.85rem 1rem;font-size:.85rem;color:#ef9a9a;margin-bottom:1.4rem}
  .msg-success{background:rgba(76,175,80,.1);border:1px solid rgba(76,175,80,.3);border-radius:8px;padding:1.5rem;font-size:.9rem;color:#a5d6a7;text-align:center;line-height:1.9}
  .msg-success strong{font-family:var(--ff-serif);font-size:1.1rem;color:#c8e6c9;display:block;margin-bottom:.5rem}
  footer{border-top:1px solid var(--border);padding:2rem;text-align:center;font-family:var(--ff-mono);font-size:.68rem;color:var(--muted);letter-spacing:.08em;margin-top:2rem}
  footer a{color:var(--muted);text-decoration:none}footer a:hover{color:var(--gold)}
  .sp-menu-btn{display:none}.sp-dropdown{display:none}
  @media(max-width:768px){
    .header-nav{display:none}
    .contact-box{padding:1.4rem 1.2rem}
    .sp-menu-btn{display:flex;align-items:center;gap:.4rem;font-family:var(--ff-mono);font-size:.75rem;letter-spacing:.08em;color:var(--muted);background:none;border:1px solid var(--border);border-radius:6px;padding:.35rem .8rem;cursor:pointer}
    .sp-dropdown{display:none;position:absolute;top:54px;right:1.2rem;background:rgba(8,6,15,.97);border:1px solid var(--border);border-radius:12px;overflow:hidden;z-index:200;min-width:180px;backdrop-filter:blur(16px)}
    .sp-dropdown.open{display:block}
    .sp-dropdown a{display:block;padding:.85rem 1.25rem;font-family:var(--ff-mono);font-size:.78rem;color:var(--muted);text-decoration:none;border-bottom:1px solid var(--border)}
    .sp-dropdown a:last-child{border-bottom:none}
    .sp-dropdown a:hover{color:var(--gold-lt)}
  }
  #google_translate_element{font-size:.65rem;flex-shrink:0}
  #google_translate_element .goog-te-gadget{color:transparent;white-space:nowrap}
  #google_translate_element .goog-te-gadget select{background:rgba(8,6,15,.9);color:#8a7db5;border:1px solid rgba(160,130,220,.3);border-radius:6px;font-size:.65rem;padding:.15rem .3rem;cursor:pointer}
  .goog-te-banner-frame{display:none!important}body{top:0!important}
  </style>
  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</head>
<body>
<?php $currentPage='contact'; require __DIR__.'/inc/header.php'; ?>

<div class="wrap">
  <section class="hero">
    <span class="hero-eyebrow">Contact</span>
    <h1>お問い合わせ</h1>
  </section>

  <div class="contact-box">
    <?php if ($sent): ?>
    <div class="msg-success">
      <strong>送信完了しました</strong>
      お問い合わせいただきありがとうございます。<br>
      内容を確認のうえ、順次ご返信いたします。<br>
      返信までに数日かかる場合がございますが、ご了承ください。
    </div>
    <?php else: ?>
    <p class="form-note">ご意見・ご感想・お問い合わせはこちらのフォームよりお送りください。<br>
    ※ 占い結果や個人の運勢に関するご相談には対応しておりません。</p>

    <?php if ($error): ?>
    <div class="msg-error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>

    <form method="post" action="/contact">
      <div class="form-group">
        <label class="form-label" for="name">お名前<span class="req">必須</span></label>
        <input class="form-input" type="text" id="name" name="name" maxlength="50" placeholder="例：山田 太郎"
          value="<?= htmlspecialchars($values['name'], ENT_QUOTES, 'UTF-8') ?>" required>
      </div>
      <div class="form-group">
        <label class="form-label" for="email">メールアドレス<span class="req">必須</span></label>
        <input class="form-input" type="email" id="email" name="email" maxlength="100" placeholder="例：example@email.com"
          value="<?= htmlspecialchars($values['email'], ENT_QUOTES, 'UTF-8') ?>" required>
      </div>
      <div class="form-group">
        <label class="form-label" for="message">お問い合わせ内容<span class="req">必須</span></label>
        <textarea class="form-textarea" id="message" name="message" maxlength="2000"
          placeholder="お問い合わせ内容をご記入ください。" required><?= htmlspecialchars($values['message'], ENT_QUOTES, 'UTF-8') ?></textarea>
      </div>
      <div class="form-honeypot"><input type="text" name="website" tabindex="-1" autocomplete="off"></div>
      <button class="form-submit" type="submit">送信する →</button>
    </form>
    <?php endif; ?>
  </div>
</div>

<?php $currentPage='contact'; $currentSlug=''; $pageType='tool'; require __DIR__.'/inc/footer.php'; ?>
<script>
function googleTranslateElementInit(){new google.translate.TranslateElement({pageLanguage:'ja',includedLanguages:'en,zh-TW,zh-CN,ko',layout:google.translate.TranslateElement.InlineLayout.SIMPLE},'google_translate_element');}
function toggleSpMenu(){document.getElementById('spDropdown').classList.toggle('open');}
document.addEventListener('click',function(e){if(!e.target.closest('.sp-menu-btn')&&!e.target.closest('.sp-dropdown')){var sd=document.getElementById('spDropdown');if(sd)sd.classList.remove('open');}});
</script>
</body>
</html>
