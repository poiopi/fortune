<?php
$item = [
  'slug' => 'tendency-guide',
  'navTitle' => 'Tendencyとは',
  'title' => 'Tendency（推定傾向）とは｜結婚志向・浮気耐性の考え方',
  'description' => 'Love Engineが算出する推定傾向（Tendency）指標「結婚志向」「浮気耐性」を解説。Styleとの違い、断定を避ける理由がわかります。',
  'h1' => 'Tendency（推定傾向）とは｜結婚志向・浮気耐性の考え方',
  'lead' => '診断結果に出てくる「結婚志向」「浮気耐性」は、Love EngineでTendency（推定傾向）と呼ばれる指標です。Styleとよく似ていますが、性格だけでは決まらない概念として、扱い方を区別しています。',

  'body' => <<<'HTML'
  <nav class="toc">
    <p class="toc-title">目次</p>
    <ol>
      <li><a href="#overview">Tendencyとは何を測る指標か</a></li>
      <li><a href="#two">2つのTendency一覧</a></li>
      <li><a href="#diff">Styleとの違い</a></li>
      <li><a href="#writing">断定を避ける理由</a></li>
      <li><a href="#faq">よくある質問</a></li>
      <li><a href="#matome">まとめ</a></li>
    </ol>
  </nav>

  <section class="art-section" id="overview">
    <h2>Tendencyとは何を測る指標か</h2>
    <p>Tendencyは、恋愛における価値観・将来観の傾向を測る指標です。<a href="/articles/love/guide/kekka-no-mikata/" class="al-link">Style</a>と同じく2つのプリミティブの加重和で計算されますが、性格だけで説明しきれない領域を扱うという前提で設計されています。</p>
  </section>

  <section class="art-section" id="two">
    <h2>2つのTendency一覧</h2>
    <div class="concept-grid">
      <a href="/articles/love/tendency/kekkonshikou-love/" class="concept-card">
        <div class="concept-card-title">結婚志向</div>
        <div class="concept-card-desc">恋愛の先に安定した関係や将来を描きやすいか。誠実性が主軸。</div>
      </a>
      <a href="/articles/love/tendency/uwakitaisei-love/" class="concept-card">
        <div class="concept-card-title">浮気耐性</div>
        <div class="concept-card-desc">一度決めた相手をどれだけ守り抜こうとするか。誠実性が主軸。</div>
      </a>
    </div>
  </section>

  <section class="art-section" id="diff">
    <h2>Styleとの違い</h2>
    <p>結婚志向・浮気耐性はどちらも誠実性が主軸ですが、負に働く2つ目のプリミティブが異なります（結婚志向は変化志向、浮気耐性は行動主導性）。そのため、必ずしも同じ高低にはなりません。詳しくは<a href="/articles/love/tendency/" class="al-link">Tendency記事一覧</a>のFAQで解説しています。</p>
  </section>

  <section class="art-section" id="writing">
    <h2>断定を避ける理由</h2>
    <p>結婚観や浮気に対する耐性は、性格だけでなく年齢・価値観・パートナーとの関係性によって大きく変わる概念です。そのためTendencyの解説文は、Styleよりも一段強く断定を避ける言い回し（「〜の傾向があります」）で統一されています。これはLove Engineの表示規約（Writing Rules）に基づくもので、High判定でもLow判定でも、優劣ではなく傾向として受け取っていただく設計です。</p>
  </section>

  <section class="art-section" id="faq">
    <h2>よくある質問</h2>
    <div class="faq-list">
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">Tendencyが低いと結婚に向いていない・浮気しやすいということですか？</div>
        <div class="faq-a">そうとは言えません。Tendencyは性格由来の構造的な傾向を示す指標であり、実際の結婚観や行動を断定するものではありません。年齢・価値観・パートナーとの関係性によって、実際の結果は大きく変わります。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">なぜTendencyは2項目しかないのですか？</div>
        <div class="faq-a">性格だけで説明しきれない概念を無理に増やすと、根拠のない断定につながりやすくなります。Love Engineでは、Primitiveとの結びつきが明確に説明できる2項目（結婚志向・浮気耐性）に絞っています。</div>
      </div>
    </div>
  </section>

  <section class="art-section" id="matome">
    <h2>まとめ</h2>
    <ul class="matome-list">
      <li>Tendencyは、恋愛における価値観・将来観の傾向を測る2つの指標（結婚志向・浮気耐性）。</li>
      <li>Styleと同じく2つのプリミティブの加重和で計算されるが、性格だけで決まらない概念という前提を持つ。</li>
      <li>結婚志向・浮気耐性はどちらも誠実性が主軸だが、負に働くプリミティブが異なるため必ずしも連動しない。</li>
      <li>Styleより一段強く断定を避ける表現（「〜の傾向があります」）で統一されている。</li>
    </ul>
  </section>
HTML,

  'relatedItems' => [
    ['label'=>'恋愛傾向診断', 'title'=>'MBTI×血液型×星座で診断する →', 'url'=>'/love'],
    ['label'=>'結果の見方', 'title'=>'診断結果の読み方を最初から見る →', 'url'=>'/articles/love/guide/kekka-no-mikata/'],
    ['label'=>'Styleとは', 'title'=>'恋愛スタイル7指標を見る →', 'url'=>'/articles/love/guide/style-guide/'],
    ['label'=>'Tendency指標一覧', 'title'=>'2指標の詳しい記事を見る →', 'url'=>'/articles/love/tendency/'],
  ],

  'prev' => ['title'=>'Styleとは', 'url'=>'/articles/love/guide/style-guide/'],
  'next' => ['title'=>'9216パターンの仕組み', 'url'=>'/articles/love/guide/9216-patterns/'],
];
require __DIR__ . '/../_guide-tpl.php';
