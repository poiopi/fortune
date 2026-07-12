<?php
$item = [
  'slug' => '9216-patterns',
  'navTitle' => '9216パターンの仕組み',
  'title' => '9216パターンの仕組み｜Love Engineの実測データとは',
  'description' => 'Love Engineの記事で繰り返し登場する「9216パターン」の意味を解説。MBTI16×血液型4×星座144の全組み合わせと、実測データ（Golden Master）に基づく記事作成の考え方がわかります。',
  'h1' => '9216パターンの仕組み｜Love Engineの実測データとは',
  'lead' => 'Love Engineの各記事には「9216通りのうち」「9216件で集計すると」といった表現が繰り返し出てきます。このページでは、9216という数字が何を意味し、なぜLove Engineの記事群がこの数字にこだわっているのかを解説します。',

  'body' => <<<'HTML'
  <nav class="toc">
    <p class="toc-title">目次</p>
    <ol>
      <li><a href="#overview">9216の内訳</a></li>
      <li><a href="#why144">星座はなぜ144通りなのか</a></li>
      <li><a href="#golden-master">Golden Masterという考え方</a></li>
      <li><a href="#how-used">記事の中でどう使われているか</a></li>
      <li><a href="#faq">よくある質問</a></li>
      <li><a href="#matome">まとめ</a></li>
    </ol>
  </nav>

  <section class="art-section" id="overview">
    <h2>9216の内訳</h2>
    <p>9216は、Love Engineが入力として受け付ける3つの占術の全組み合わせ数です。</p>
    <p style="font-family:var(--ff-mono);text-align:center;background:var(--bg2);border-radius:8px;padding:1rem;font-size:.9rem">MBTI 16 × 血液型 4 × 星座 144 = 9216</p>
    <p>MBTIは16タイプ、血液型はA・B・O・ABの4種類です。星座だけ「144」と大きい数になっているのは、単純な12星座ではなく、星座（12）×内面タイプ（12）の組み合わせだからです。</p>
  </section>

  <section class="art-section" id="why144">
    <h2>星座はなぜ144通りなのか</h2>
    <p>Love Engineの星座診断は、生年月日から「星座（誕生日の期間で決まる、一般的な12星座）」と「内面タイプ（生年月日から別ロジックで計算される、もう1つの12分類）」という2つの値を同時に使っています。この2つは独立して変化するため、12×12=144通りが生まれます。</p>
    <p>ただし<a href="/articles/love/seiza/" class="al-link">星座×恋愛の各記事</a>は、内面タイプ単位ではなく星座単位（1星座=768件＝MBTI16×血液型4×内面タイプ12）で集計しています。内面タイプは「なぜこの傾向になるか」の説明には使わず、あくまでサンプル構成の一部として扱っています。</p>
  </section>

  <section class="art-section" id="golden-master">
    <h2>Golden Masterという考え方</h2>
    <p>Love Engineでは、9216通りすべての組み合わせを実際に計算し、結果を1つのデータとして保存しています。これを「Golden Master」と呼んでいます。</p>
    <p>記事に登場する数値（例えば「積極性がHighになるのはENTPで100%」「Bundle『誠実性×情動性』は9216件中26.2%」など）は、このGolden Masterを実際に集計して得られた本物の数値です。記事を書く担当が「だいたいこのくらいだろう」と見積もった数値ではなく、9216件の元データをその都度集計スクリプトで数え上げています。</p>
    <p>この方針は<a href="/articles/love/blood/" class="al-link">血液型×恋愛の各記事</a>で特に厳密に適用されており、記事執筆前にA・B・O・AB全パターンの相互比較データをあらかじめ計算してから文章を書く、という手順が確立されています。</p>
  </section>

  <section class="art-section" id="how-used">
    <h2>記事の中でどう使われているか</h2>
    <p>9216件（またはその一部）の実測データは、主に次の3つの形で記事に登場します。</p>
    <ul class="matome-list">
      <li><strong>全体集計</strong>：9216件全体でのStyle/Tendencyの分布、Bundleの出現率など。</li>
      <li><strong>MBTI別・血液型別・星座別の絞り込み集計</strong>：例えば「ENTPの576件（=血液型4×星座144）に限定した場合の積極性の分布」など。</li>
      <li><strong>相互比較</strong>：MBTIの16タイプ同士、血液型の4種類同士を横並びで比較するランキング表。</li>
    </ul>
    <p>いずれも、Golden Masterという同じ1つの元データから集計されているため、記事をまたいで数値の矛盾が起きない設計になっています。</p>
  </section>

  <section class="art-section" id="faq">
    <h2>よくある質問</h2>
    <div class="faq-list">
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">9216通りは、実際にありえる生年月日の組み合わせの数ですか？</div>
        <div class="faq-a">いいえ。9216は「MBTIの回答結果」「血液型」「生年月日から導かれる星座と内面タイプ」の組み合わせ数です。実際の生年月日そのものの日数とは別の概念です。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">なぜ全パターンを事前計算しているのですか？</div>
        <div class="faq-a">記事内の「最も」「唯一」といった相対表現に根拠を持たせるためです。一部のデータだけを見て「これが一番多そう」と書くと、確認できていない組み合わせで結果が変わってしまう可能性があります。9216件全体を事前に計算しておくことで、こうした表現に実測の裏付けを持たせています。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">診断結果はこの9216通りのどれかに必ず当てはまりますか？</div>
        <div class="faq-a">はい。診断で入力するMBTI・血液型・星座（生年月日）の組み合わせは、必ずこの9216通りのいずれか1つに対応します。</div>
      </div>
    </div>
  </section>

  <section class="art-section" id="matome">
    <h2>まとめ</h2>
    <ul class="matome-list">
      <li>9216は、MBTI（16）×血液型（4）×星座（144＝12星座×内面タイプ12）の全組み合わせ数。</li>
      <li>星座が144通りなのは、誕生日で決まる星座と、別ロジックで決まる内面タイプの2軸を掛け合わせているため。</li>
      <li>Love Engineはこの9216通り全部を事前に計算した「Golden Master」を保持しており、記事中の数値はすべてこれを実際に集計した本物の値。</li>
      <li>全体集計・カテゴリ別集計・相互比較という3つの形で、各記事に実測データとして登場する。</li>
    </ul>
  </section>
HTML,

  'relatedItems' => [
    ['label'=>'恋愛傾向診断', 'title'=>'MBTI×血液型×星座で診断する →', 'url'=>'/love'],
    ['label'=>'結果の見方', 'title'=>'診断結果の読み方を最初から見る →', 'url'=>'/articles/love/guide/kekka-no-mikata/'],
    ['label'=>'Bundleとは', 'title'=>'恋愛タイプの分類ロジックを見る →', 'url'=>'/articles/love/guide/bundle-guide/'],
    ['label'=>'星座×恋愛', 'title'=>'12星座別の恋愛傾向を見る →', 'url'=>'/articles/love/seiza/'],
  ],

  'prev' => ['title'=>'Tendencyとは', 'url'=>'/articles/love/guide/tendency-guide/'],
  'next' => ['title'=>'Primitiveとは', 'url'=>'/articles/love/guide/primitive-guide/'],
];
require __DIR__ . '/../_guide-tpl.php';
