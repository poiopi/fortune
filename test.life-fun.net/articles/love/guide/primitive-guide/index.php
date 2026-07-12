<?php
$item = [
  'slug' => 'primitive-guide',
  'navTitle' => 'Primitiveとは',
  'title' => 'Primitive（性格プリミティブ）とは｜Love Engineの内部計算軸',
  'description' => 'Love Engineの内部で使われる5つの性格プリミティブ（行動主導性・誠実性・情動性・自立性・変化志向）を解説。MBTI・血液型・星座からどう変換され、Style/Tendency/Bundleへどうつながるかがわかります。',
  'h1' => 'Primitive（性格プリミティブ）とは｜Love Engineの内部計算軸',
  'lead' => '各記事の「なぜこの傾向になるのか」という説明には、「行動主導性」「誠実性」といった聞き慣れない言葉が登場します。これはLove Engineが内部で使っているPrimitive（性格プリミティブ）と呼ばれる計算軸です。このページでは、5つのPrimitiveが何を意味し、診断結果とどうつながっているのかを解説します。',

  'body' => <<<'HTML'
  <nav class="toc">
    <p class="toc-title">目次</p>
    <ol>
      <li><a href="#overview">Primitiveとは何か</a></li>
      <li><a href="#five">5つのPrimitive一覧</a></li>
      <li><a href="#input">MBTI・血液型・星座からどう変換されるか</a></li>
      <li><a href="#not-shown">なぜ診断結果には表示されないのか</a></li>
      <li><a href="#faq">よくある質問</a></li>
      <li><a href="#matome">まとめ</a></li>
    </ol>
  </nav>

  <section class="art-section" id="overview">
    <h2>Primitiveとは何か</h2>
    <p>Primitiveは、MBTI・血液型・星座という異なる3つの入力を、恋愛の計算で使える共通の物差しに変換するための、Love Engine内部の基本軸です。<a href="/articles/love/guide/kekka-no-mikata/" class="al-link">Style・Tendency・Bundle</a>は、すべてこの5つのPrimitiveのスコアから計算されています。</p>
  </section>

  <section class="art-section" id="five">
    <h2>5つのPrimitive一覧</h2>
    <div class="concept-grid">
      <div class="concept-card" style="cursor:default">
        <div class="concept-card-title">行動主導性</div>
        <div class="concept-card-desc">自分から動くか、待つか。積極性・愛情表現の主軸。</div>
      </div>
      <div class="concept-card" style="cursor:default">
        <div class="concept-card-title">誠実性</div>
        <div class="concept-card-desc">関係を守り、慎重に育てる力。包容力・結婚志向の主軸。</div>
      </div>
      <div class="concept-card" style="cursor:default">
        <div class="concept-card-title">情動性</div>
        <div class="concept-card-desc">感情の動きやすさ。愛情表現・独占欲・嫉妬深さの主軸。</div>
      </div>
      <div class="concept-card" style="cursor:default">
        <div class="concept-card-title">自立性</div>
        <div class="concept-card-desc">相手と距離を保つ力。5つの中で最もスコアが伸びにくい軸。</div>
      </div>
      <div class="concept-card" style="cursor:default">
        <div class="concept-card-title">変化志向</div>
        <div class="concept-card-desc">新しい状況を楽しめるか。惚れやすさの主軸の1つ。</div>
      </div>
    </div>
  </section>

  <section class="art-section" id="input">
    <h2>MBTI・血液型・星座からどう変換されるか</h2>
    <p>MBTI・血液型・星座は、それぞれ異なるロジックでPrimitiveへスコアを加算します。</p>
    <div class="flow-chain">
      <span class="flow-node">MBTI・血液型・星座の入力</span>
      <span class="flow-arrow">→</span>
      <span class="flow-node">Trait（性格特性）</span>
      <span class="flow-arrow">→</span>
      <span class="flow-node">Primitiveのスコア加算</span>
    </div>
    <p>例えばMBTIのE（外向）は「行動力」というTraitを経て行動主導性に、血液型のA型は「慎重さ」「責任感」「安定性」という3つのTraitを経て誠実性に集中して加算されます。星座は「エレメント（火・地・風・水）」と「クオリティ（活動宮・不動宮・柔軟宮）」という2つの要素がそれぞれ別のTraitに変換されます。</p>
    <p>この変換ロジックの詳細は、<a href="/articles/love/mbti/" class="al-link">MBTI×恋愛</a>・<a href="/articles/love/blood/" class="al-link">血液型×恋愛</a>・<a href="/articles/love/seiza/" class="al-link">星座×恋愛</a>それぞれの記事内で、タイプごとに具体的に解説しています。</p>
  </section>

  <section class="art-section" id="not-shown">
    <h2>なぜ診断結果には表示されないのか</h2>
    <p>Primitiveは、MBTI・血液型・星座という性質の異なる3つの入力を1つの計算体系にまとめるための、内部的な翻訳語彙として設計されています。診断結果の画面そのものには表示されず、実際に表示されるのはPrimitiveから計算された後のStyle・Tendency・Bundleです。</p>
    <p>一方で、各記事の「なぜこの結果になるのか」という説明では、Primitiveの概念が数多く登場します。結果を直接示す言葉ではなく、結果の理由を説明するための言葉として使い分けられています。</p>
  </section>

  <section class="art-section" id="faq">
    <h2>よくある質問</h2>
    <div class="faq-list">
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">Primitiveのスコア自体を確認する方法はありますか？</div>
        <div class="faq-a">診断結果の画面には表示していません。ただし各記事では、MBTIタイプ別・血液型別・星座別にどのPrimitiveへ何点加算されるかを具体的に解説しています。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">なぜPrimitiveは5つなのですか？</div>
        <div class="faq-a">MBTI・血液型・星座という3つの異なる入力すべてを過不足なく表現でき、かつStyle・Tendencyの7+2指標を意味のある形で計算できる最小限の軸として、5つに設計されています。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">自立性だけ説明が少ないのはなぜですか？</div>
        <div class="faq-a">自立性は、MBTIのI（内向）からのみ、かつ他の特性より小さいスコアでしか伸びない構造になっており、5つのPrimitiveの中でスコアが伸びにくい軸です。そのため<a href="/articles/love/guide/bundle-guide/">Bundleとは</a>で解説している通り、自立性が主役になるケースは相対的に少なくなっています。</div>
      </div>
    </div>
  </section>

  <section class="art-section" id="matome">
    <h2>まとめ</h2>
    <ul class="matome-list">
      <li>Primitiveは、MBTI・血液型・星座を共通の物差しに変換するLove Engine内部の5つの基本軸（行動主導性・誠実性・情動性・自立性・変化志向）。</li>
      <li>MBTI・血液型・星座は、それぞれ異なるTrait（性格特性）を経てPrimitiveのスコアに加算される。</li>
      <li>Style・Tendency・Bundleは、すべてこの5つのPrimitiveのスコアから計算される。</li>
      <li>診断結果の画面には表示されないが、各記事の「なぜこの結果になるのか」という説明の中で繰り返し使われている。</li>
    </ul>
  </section>
HTML,

  'relatedItems' => [
    ['label'=>'恋愛傾向診断', 'title'=>'MBTI×血液型×星座で診断する →', 'url'=>'/love'],
    ['label'=>'結果の見方', 'title'=>'診断結果の読み方を最初から見る →', 'url'=>'/articles/love/guide/kekka-no-mikata/'],
    ['label'=>'Bundleとは', 'title'=>'恋愛タイプの分類ロジックを見る →', 'url'=>'/articles/love/guide/bundle-guide/'],
    ['label'=>'9216パターンの仕組み', 'title'=>'実測データの成り立ちを見る →', 'url'=>'/articles/love/guide/9216-patterns/'],
  ],

  'prev' => ['title'=>'9216パターンの仕組み', 'url'=>'/articles/love/guide/9216-patterns/'],
];
require __DIR__ . '/../_guide-tpl.php';
