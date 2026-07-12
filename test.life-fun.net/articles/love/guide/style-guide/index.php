<?php
$item = [
  'slug' => 'style-guide',
  'navTitle' => 'Styleとは',
  'title' => 'Style（恋愛スタイル）とは｜7つの指標とHigh/Mid/Lowの読み方',
  'description' => 'Love Engineが算出する7つの恋愛スタイル（Style）指標を一覧で解説。それぞれ何を測っているか、どう計算されるか、High/Mid/Lowの読み方がわかります。',
  'h1' => 'Style（恋愛スタイル）とは｜7つの指標とHigh/Mid/Lowの読み方',
  'lead' => '診断結果に出てくる「積極性」「愛情表現」などの項目は、Love Engineが算出するStyle（恋愛スタイル）と呼ばれる指標です。このページでは、7つのStyleがそれぞれ何を測っているのか、どう計算されるのかを一覧で解説します。',

  'body' => <<<'HTML'
  <nav class="toc">
    <p class="toc-title">目次</p>
    <ol>
      <li><a href="#overview">Styleとは何を測る指標か</a></li>
      <li><a href="#seven">7つのStyle一覧</a></li>
      <li><a href="#formula">Styleはどう計算されるか</a></li>
      <li><a href="#reading">High/Mid/Lowの読み方</a></li>
      <li><a href="#faq">よくある質問</a></li>
      <li><a href="#matome">まとめ</a></li>
    </ol>
  </nav>

  <section class="art-section" id="overview">
    <h2>Styleとは何を測る指標か</h2>
    <p>Styleは、恋愛における行動・表現・関わり方の傾向を測る指標です。<a href="/articles/love/guide/kekka-no-mikata/" class="al-link">5つの性格プリミティブ</a>のうち2つを組み合わせた加重和で計算され、全部で7項目あります。</p>
    <p>MBTIの16タイプ、血液型の4種類、星座の12星座（さらに内面タイプを含めると144通り）という、それぞれ異なる入力から共通の7項目が算出されるため、複数の占術を横断して同じ物差しで比較できるのがStyleの特徴です。</p>
  </section>

  <section class="art-section" id="seven">
    <h2>7つのStyle一覧</h2>
    <div class="concept-grid">
      <a href="/articles/love/style/sekkyokusei-love/" class="concept-card">
        <div class="concept-card-title">積極性</div>
        <div class="concept-card-desc">自分から動くか、相手を待つか。行動主導性が主軸。</div>
      </a>
      <a href="/articles/love/style/aijouhyougen-love/" class="concept-card">
        <div class="concept-card-title">愛情表現</div>
        <div class="concept-card-desc">感情をどれだけ表に出すか。情動性が主軸。</div>
      </a>
      <a href="/articles/love/style/houyouryoku-love/" class="concept-card">
        <div class="concept-card-title">包容力</div>
        <div class="concept-card-desc">相手をどれだけ受け止められるか。誠実性が主軸。</div>
      </a>
      <a href="/articles/love/style/dokusenyoku-love/" class="concept-card">
        <div class="concept-card-title">独占欲</div>
        <div class="concept-card-desc">相手との結びつきの強さ。情動性が主軸。</div>
      </a>
      <a href="/articles/love/style/horeyasusa-love/" class="concept-card">
        <div class="concept-card-title">惚れやすさ</div>
        <div class="concept-card-desc">新しい出会いへの心の開き方。情動性・変化志向。</div>
      </a>
      <a href="/articles/love/style/shittobukasa-love/" class="concept-card">
        <div class="concept-card-title">嫉妬深さ</div>
        <div class="concept-card-desc">感情の揺れやすさ。情動性が主軸。</div>
      </a>
      <a href="/articles/love/style/shinchousa-love/" class="concept-card">
        <div class="concept-card-title">恋愛の慎重さ</div>
        <div class="concept-card-desc">関係を進めるペース。誠実性が主軸。</div>
      </a>
    </div>
  </section>

  <section class="art-section" id="formula">
    <h2>Styleはどう計算されるか</h2>
    <p>7つのStyleはすべて、2つのプリミティブの加重和として計算されます。例えば積極性は「行動主導性×0.6＋情動性×0.4」、包容力は「誠実性×0.6＋情動性×0.4」という具合です。</p>
    <p>似ている指標もありますが、計算式のどのプリミティブを使うかで意味が分かれています。積極性と愛情表現は同じ2つのプリミティブを使いながら重みが逆になっていますし、独占欲と嫉妬深さはどちらも情動性が主軸ですが、差し引かれるプリミティブが異なります（独占欲は自立性、嫉妬深さは誠実性）。それぞれの違いは、各Style記事のFAQで詳しく解説しています。</p>
  </section>

  <section class="art-section" id="reading">
    <h2>High/Mid/Lowの読み方</h2>
    <p>Styleの結果は、9216通りの実測データにおける相対的な位置（上位33%・中位34%・下位33%）でHigh/Mid/Lowに分類されます。優劣を示すものではなく、Lowも「じっくり相手を見てから動く」のように前向きな傾向として表示されます。詳しくは<a href="/articles/love/guide/kekka-no-mikata/" class="al-link">「恋愛診断の結果の見方」</a>で解説しています。</p>
  </section>

  <section class="art-section" id="faq">
    <h2>よくある質問</h2>
    <div class="faq-list">
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">なぜStyleは7項目なのですか？</div>
        <div class="faq-a">5つのプリミティブの組み合わせのうち、恋愛における具体的な行動・感情面を表す7つの側面として設計されています。プリミティブの理論上の組み合わせはもっと多く作れますが、実際に意味のある恋愛概念として言語化できるものを7つに絞っています。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">StyleとTendencyは何が違いますか？</div>
        <div class="faq-a">Styleは性格の傾向を表す指標です。Tendency（結婚志向・浮気耐性）は、性格だけでなく価値観・経験・年齢の影響を強く受ける概念のため、区別して扱っています。詳しくは<a href="/articles/love/tendency/">Tendencyの記事一覧</a>をご覧ください。</div>
      </div>
    </div>
  </section>

  <section class="art-section" id="matome">
    <h2>まとめ</h2>
    <ul class="matome-list">
      <li>Styleは、恋愛における行動・表現・関わり方の傾向を測る7つの指標。</li>
      <li>すべて2つのプリミティブの加重和として計算され、似た指標でも参照するプリミティブや重みが異なる。</li>
      <li>High/Mid/Lowは9216通りの実測データにおける相対的な位置で、優劣を示すものではない。</li>
      <li>各Styleの詳しい計算式・実測データは、それぞれの記事で確認できる。</li>
    </ul>
  </section>
HTML,

  'relatedItems' => [
    ['label'=>'恋愛傾向診断', 'title'=>'MBTI×血液型×星座で診断する →', 'url'=>'/love'],
    ['label'=>'結果の見方', 'title'=>'診断結果の読み方を最初から見る →', 'url'=>'/articles/love/guide/kekka-no-mikata/'],
    ['label'=>'Bundleとは', 'title'=>'恋愛タイプの分類ロジックを見る →', 'url'=>'/articles/love/guide/bundle-guide/'],
    ['label'=>'Style指標一覧', 'title'=>'7指標の詳しい記事を見る →', 'url'=>'/articles/love/style/'],
  ],
];
require __DIR__ . '/../_guide-tpl.php';
