<?php
$item = [
  'slug' => 'kekka-no-mikata',
  'navTitle' => '恋愛診断の結果の見方',
  'title' => '恋愛診断の結果の見方｜Love Engineの仕組みをやさしく解説',
  'description' => 'Love Engineの恋愛傾向診断が、MBTI・血液型・星座からどうやって結果を導き出しているのかを解説。Style・Tendency・Bundle・High/Mid/Lowの意味、9216パターンの仕組みがわかります。',
  'h1' => '恋愛診断の結果の見方｜Love Engineの仕組みをやさしく解説',
  'lead' => '恋愛傾向診断の結果には、「積極性はHigh」「恋愛タイプはREL_SEN」など、聞き慣れない言葉が出てきます。このページでは、Love Engineがどんな仕組みで結果を導き出しているのかを、専門用語を1つずつ解きほぐしながら解説します。',

  'body' => <<<'HTML'
  <nav class="toc">
    <p class="toc-title">目次</p>
    <ol>
      <li><a href="#overview">診断結果に出てくる3つの要素</a></li>
      <li><a href="#flow">MBTI・血液型・星座から結果ができるまで</a></li>
      <li><a href="#highmidlow">High・Mid・Lowとは何か</a></li>
      <li><a href="#bundle">恋愛タイプ（Bundle）とは</a></li>
      <li><a href="#9216">9216パターンとは</a></li>
      <li><a href="#faq">よくある質問</a></li>
      <li><a href="#matome">まとめ</a></li>
    </ol>
  </nav>

  <section class="art-section" id="overview">
    <h2>診断結果に出てくる3つの要素</h2>
    <p>Love Engineの診断結果は、大きく3つの要素でできています。それぞれ独立した記事で詳しく解説していますので、気になるものから読んでみてください。</p>
    <div class="concept-grid">
      <a href="/articles/love/style/" class="concept-card">
        <div class="concept-card-title">Style（恋愛スタイル）</div>
        <div class="concept-card-desc">積極性・愛情表現など7つの指標。恋愛での行動や表現の傾向を表します。</div>
      </a>
      <a href="/articles/love/tendency/" class="concept-card">
        <div class="concept-card-title">Tendency（推定傾向）</div>
        <div class="concept-card-desc">結婚志向・浮気耐性の2指標。性格だけで決まらない価値観寄りの傾向です。</div>
      </a>
    </div>
    <p style="margin-top:1rem">この2つに加えて、後述する「Bundle（恋愛タイプ）」が診断結果の中心になります。</p>
  </section>

  <section class="art-section" id="flow">
    <h2>MBTI・血液型・星座から結果ができるまで</h2>
    <p>Love Engineは、MBTI・血液型・星座という3つの入力を、いくつかの段階を経て最終的な結果に変換します。</p>
    <div class="flow-chain">
      <span class="flow-node">MBTI・血液型・星座</span>
      <span class="flow-arrow">→</span>
      <span class="flow-node">Trait（性格特性）</span>
      <span class="flow-arrow">→</span>
      <span class="flow-node">Primitive（5つの基本軸）</span>
      <span class="flow-arrow">→</span>
      <span class="flow-node">Style・Tendency・Bundle</span>
    </div>
    <p>途中に出てくる「Primitive（性格プリミティブ）」は、「行動主導性」「誠実性」「情動性」「自立性」「変化志向」という5つの基本軸です。MBTI・血液型・星座のそれぞれが、この5つの軸へ何らかの形で変換され、そのスコアの組み合わせからStyle・Tendency・Bundleが計算されます。</p>
    <p>この因果関係は、<a href="/articles/love/mbti/" class="al-link">MBTI×恋愛の各記事</a>・<a href="/articles/love/seiza/" class="al-link">星座×恋愛の各記事</a>・<a href="/articles/love/blood/" class="al-link">血液型×恋愛の各記事</a>それぞれで、「なぜこの傾向になるのか」という形で具体的に解説しています。</p>
  </section>

  <section class="art-section" id="highmidlow">
    <h2>High・Mid・Lowとは何か</h2>
    <p>診断結果のStyle・Tendencyは、それぞれ「High」「Mid」「Low」の3段階で表示されます。これは9216通りの実測データの中で、あなたの結果が上位・中位・下位のどこに位置するかを表す「母集団上の位置」です。</p>
    <div class="norm-box">
      <div class="norm-seg"><span class="lv">Low</span>下位33%</div>
      <div class="norm-seg"><span class="lv">Mid</span>中位34%</div>
      <div class="norm-seg"><span class="lv">High</span>上位33%</div>
    </div>
    <p>大切なのは、High・Mid・Lowに優劣が無いという点です。「High=良い」「Low=悪い」ではなく、単に相対的な位置を示しているだけです。実際の閾値は指標ごとに異なり、各<a href="/articles/love/style/" class="al-link">Style記事</a>・<a href="/articles/love/tendency/" class="al-link">Tendency記事</a>で実際の数値を確認できます。</p>
  </section>

  <section class="art-section" id="bundle">
    <h2>恋愛タイプ（Bundle）とは</h2>
    <p>Bundleは、5つのPrimitiveのうち特に強く出ている上位2つの組み合わせで恋愛タイプを分類したものです。例えば「行動主導性×情動性」のように、2つの軸の組み合わせで表現されます。</p>
    <p>Bundleが重要なのは、MBTI・血液型・星座という3つの異なる入力が、最終的にどのプリミティブへ集約されるかを1つの結果として示している点です。41本の記事で見てきたように、同じ「行動主導性×情動性」というBundleでも、それがENTPの性格由来なのか、O型の血液型由来なのか、牡羊座の星座由来なのかは、組み合わせによって変わります。</p>
    <p>Bundleそれぞれの意味を解説する記事は、順次公開予定です。</p>
  </section>

  <section class="art-section" id="9216">
    <h2>9216パターンとは</h2>
    <p>Love Engineの記事で繰り返し登場する「9216パターン」は、MBTI（16タイプ）×血液型（4種類）×星座（144通り＝12星座×内面タイプ12）の全組み合わせ数です。</p>
    <p style="font-family:var(--ff-mono);text-align:center;background:var(--bg2);border-radius:8px;padding:1rem;font-size:.9rem">16 × 4 × 144 = 9216</p>
    <p>Love Engineでは、この9216通りすべてを実際に計算し、結果を記録しています（Golden Masterと呼んでいます）。41本の記事に登場する実測データは、すべてこの9216件、またはその一部（特定のMBTIタイプだけ・特定の星座だけ、など）を集計した本物の数値です。「理論上こうなるはず」ではなく、「実際に計算するとこうなる」という実測に基づいている点が、Love Engineの記事群の特徴です。</p>
  </section>

  <section class="art-section" id="faq">
    <h2>よくある質問</h2>
    <div class="faq-list">
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">StyleとBundleは何が違いますか？</div>
        <div class="faq-a">Styleは「積極性」のように1つ1つ独立した指標です。Bundleは、5つのPrimitiveのうち特に強く出ている上位2つの組み合わせで恋愛タイプ全体を1つに表現したものです。StyleとBundleはどちらもPrimitiveから計算されますが、Styleは個別の側面を、Bundleは全体像を表します。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">Primitiveは診断結果に表示されますか？</div>
        <div class="faq-a">表示されません。Primitiveは、MBTI・血液型・星座の情報をStyle・Tendency・Bundleへ変換するための内部的な計算軸です。各記事の「なぜこの傾向になるのか」という解説の中で登場しますが、診断結果の画面そのものにはStyle・Tendency・Bundleのみが表示されます。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">なぜHigh/Mid/Lowの境界が指標によって違うのですか？</div>
        <div class="faq-a">Love Engineでは、あらかじめ均等な3分割を狙うのではなく、9216通りの実測データから実際の分布に基づいて閾値を決めています。指標によって元のスコアの分布が異なるため、境界値も指標ごとに異なります。</div>
      </div>
    </div>
  </section>

  <section class="art-section" id="matome">
    <h2>まとめ</h2>
    <ul class="matome-list">
      <li>診断結果は、Style（恋愛スタイル）・Tendency（推定傾向）・Bundle（恋愛タイプ）の3つで構成される。</li>
      <li>MBTI・血液型・星座は、Trait→Primitive（5つの基本軸）という段階を経てStyle/Tendency/Bundleへ変換される。</li>
      <li>High/Mid/Lowは9216通りの実測データにおける相対的な位置であり、優劣を示すものではない。</li>
      <li>Bundleは、特に強く出ている上位2つのPrimitiveの組み合わせで恋愛タイプ全体を表す。</li>
      <li>9216パターンは「MBTI16×血液型4×星座144」の全組み合わせで、記事内の実測データはすべてこの9216件（またはその一部）を実際に計算した本物の数値。</li>
    </ul>
  </section>
HTML,

  'relatedItems' => [
    ['label'=>'恋愛傾向診断', 'title'=>'MBTI×血液型×星座で診断する →', 'url'=>'/love'],
    ['label'=>'MBTI×恋愛', 'title'=>'16タイプ別の恋愛傾向を見る →', 'url'=>'/articles/love/mbti/'],
    ['label'=>'Style指標一覧', 'title'=>'積極性・愛情表現など7指標を見る →', 'url'=>'/articles/love/style/'],
    ['label'=>'星座×恋愛', 'title'=>'12星座別の恋愛傾向を見る →', 'url'=>'/articles/love/seiza/'],
  ],
];
require __DIR__ . '/../_guide-tpl.php';
