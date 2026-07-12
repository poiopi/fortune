<?php
$item = [
  'slug' => 'bundle-guide',
  'navTitle' => 'Bundleとは',
  'title' => 'Bundle（恋愛タイプ）とは｜Love Engine独自の分類ロジックを解説',
  'description' => 'Love Engineが恋愛タイプ（Bundle）をどう決めているのかを解説。5つのPrimitiveから上位2つを選ぶ仕組み、20通りの内訳、9216件での出現率の実測データを紹介します。',
  'h1' => 'Bundle（恋愛タイプ）とは｜Love Engine独自の分類ロジックを解説',
  'lead' => '診断結果の「恋愛タイプ」は、Love Engineの中でBundleと呼ばれる仕組みで決まります。5つの性格プリミティブのうち、特に強く出ている上位2つを組み合わせて1つのタイプにする、Love Engine独自の分類ロジックです。このページでは、Bundleがどう決まるのか、20通りの内訳、実際の出現率を解説します。',

  'body' => <<<'HTML'
  <nav class="toc">
    <p class="toc-title">目次</p>
    <ol>
      <li><a href="#overview">Bundleとは何か</a></li>
      <li><a href="#mechanism">なぜ上位2つの組み合わせなのか</a></li>
      <li><a href="#20types">20通りの仕組み</a></li>
      <li><a href="#frequency">9216件での出現率</a></li>
      <li><a href="#why-uneven">なぜ出現率に大きな差があるのか</a></li>
      <li><a href="#faq">よくある質問</a></li>
      <li><a href="#matome">まとめ</a></li>
    </ol>
  </nav>

  <section class="art-section" id="overview">
    <h2>Bundleとは何か</h2>
    <p>Bundleは、<a href="/articles/love/guide/kekka-no-mikata/" class="al-link">5つの性格プリミティブ</a>（行動主導性・誠実性・情動性・自立性・変化志向）のうち、あなたのスコアで特に強く出ている上位2つを組み合わせて1つの恋愛タイプにしたものです。「誠実性×情動性」のように、主軸（1番強い軸）と副軸（2番目に強い軸）の順序を区別して表現します。</p>
    <p>MBTI・血液型・星座という3つの入力は、それぞれ異なる形でこの5つのプリミティブへ変換されます。Bundleは、その3つの入力が最終的にどこへ集約されるかを1つの結果として示すものです。</p>
  </section>

  <section class="art-section" id="mechanism">
    <h2>なぜ上位2つの組み合わせなのか</h2>
    <p>Bundleの決め方はシンプルです。</p>
    <ol style="padding-left:1.2rem;font-size:.93rem;line-height:2;color:#333">
      <li>5つのPrimitiveのスコアを降順に並べる</li>
      <li>同点の場合は決まった優先順位（行動主導性＞誠実性＞情動性＞自立性＞変化志向）でタイブレークする</li>
      <li>上位2つを主軸・副軸として選ぶ</li>
    </ol>
    <p>Style・Tendencyのような加重和ではなく、Bundleは「どのプリミティブが最も強いか」という順位だけで決まります。そのため、Style/Tendencyの数値そのものではなく、5つのプリミティブ同士の相対的な強さがBundleを決めているという点が特徴です。</p>
  </section>

  <section class="art-section" id="20types">
    <h2>20通りの仕組み</h2>
    <p>5つのプリミティブから2つを順序区別ありで選ぶため、5×4=20通りのBundleが存在します。IDは「LOVE_主軸コード_副軸コード」という形式で、例えば「LOVE_REL_SEN」は主軸=誠実性・副軸=情動性を意味します。</p>
    <p>主軸と副軸を区別しているのは、「誠実性が最も強く、次に情動性」というタイプと「情動性が最も強く、次に誠実性」というタイプを、異なる性質として扱うためです。実際、両者は<a href="/articles/love/mbti/" class="al-link">MBTI記事群</a>でもStyle/Tendencyの傾向が異なることが確認できています。</p>
  </section>

  <section class="art-section" id="frequency">
    <h2>9216件での出現率</h2>
    <p>Love Engineの9216通り全パターンでBundleを集計すると、出現率には大きな偏りがあります。</p>
    <table class="rank-table">
      <tr><th>順位</th><th>Bundle</th><th>出現率</th></tr>
      <tr><td>1</td><td>誠実性×情動性</td><td>26.2%</td></tr>
      <tr><td>2</td><td>誠実性×行動主導性</td><td>18.1%</td></tr>
      <tr><td>3</td><td>情動性×行動主導性</td><td>12.8%</td></tr>
      <tr><td>4</td><td>情動性×誠実性</td><td>10.8%</td></tr>
      <tr><td>5</td><td>行動主導性×誠実性</td><td>7.7%</td></tr>
      <tr><td>6</td><td>行動主導性×情動性</td><td>7.0%</td></tr>
      <tr><td>7</td><td>誠実性×変化志向</td><td>4.7%</td></tr>
      <tr><td>8</td><td>情動性×変化志向</td><td>3.9%</td></tr>
      <tr><td>9〜20位</td><td>自立性が絡む8通り＋残り</td><td>合計 8.8%</td></tr>
    </table>
    <p>上位6通り（誠実性・情動性・行動主導性の3者間の組み合わせ）だけで全体の82.6%を占めます。逆に、自立性が主軸または副軸に入る8通りは、合計しても約3.3%しかありません（最も少ないLOVE_AUT_ACTは実測0件）。</p>
  </section>

  <section class="art-section" id="why-uneven">
    <h2>なぜ出現率に大きな差があるのか</h2>
    <p>これは設計の偏りではなく、各プリミティブが取りうるスコアの範囲（レンジ）の違いという構造的な事実によるものです。自立性は、MBTIのI（内向）からのみ、しかも他の特性より小さいスコアでしか伸びないため、他の4プリミティブに比べて到達しうる最大値が低く、上位2つに入りにくい構造になっています。</p>
    <p>この構造は<a href="/articles/love/seiza/" class="al-link">星座記事群</a>・<a href="/articles/love/blood/" class="al-link">血液型記事群</a>でも繰り返し確認できます。例えば血液型でPrimitiveへ自立性を持つのはB型だけですが、そのB型でも自立性が単独でBundleの主軸になるケースはわずかです。</p>
  </section>

  <section class="art-section" id="faq">
    <h2>よくある質問</h2>
    <div class="faq-list">
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">Bundleは何で決まりますか？</div>
        <div class="faq-a">MBTI・血液型・星座の情報が変換された5つのプリミティブ（行動主導性・誠実性・情動性・自立性・変化志向）のうち、スコアが最も高い2つの組み合わせで決まります。Style・Tendencyの数値そのものではなく、プリミティブ同士の相対的な強さが基準です。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">自立性が絡むBundleは珍しいのですか？</div>
        <div class="faq-a">はい。9216通り全体で見ると、自立性が主軸・副軸のどちらかに入るBundleは合計でも約3.3%しかありません。これは自立性というプリミティブが、MBTIのI（内向）からのみ、かつ小さいスコアでしか伸びないという構造上の理由によるものです。</div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">同じBundleでも人によって解説文が違うのですか？</div>
        <div class="faq-a">Bundleの判定ロジックとは別に、実際に表示される解説文（Text Bank）は20通りのうち出現率の低い8通りを2種類の共有文にまとめています。出現率が高い12通りはそれぞれ専用の文章です。</div>
      </div>
    </div>
  </section>

  <section class="art-section" id="matome">
    <h2>まとめ</h2>
    <ul class="matome-list">
      <li>Bundleは、5つのプリミティブのうち最も強い2つを主軸・副軸として組み合わせた、Love Engine独自の恋愛タイプ分類。</li>
      <li>組み合わせは5×4=20通りで、「LOVE_主軸コード_副軸コード」という形式のIDを持つ。</li>
      <li>9216件の実測では、誠実性・情動性・行動主導性の3者間の組み合わせ（上位6通り）だけで82.6%を占める。</li>
      <li>自立性が絡む8通りは合計約3.3%と少なく、これは自立性のスコア到達範囲が他のプリミティブより狭いという構造的な理由による。</li>
      <li>MBTI・星座・血液型のどの入力から来ても、最終的にはこの20通りのBundleへ集約される。</li>
    </ul>
  </section>
HTML,

  'relatedItems' => [
    ['label'=>'恋愛傾向診断', 'title'=>'MBTI×血液型×星座で診断する →', 'url'=>'/love'],
    ['label'=>'結果の見方', 'title'=>'診断結果の読み方を最初から見る →', 'url'=>'/articles/love/guide/kekka-no-mikata/'],
    ['label'=>'MBTI×恋愛', 'title'=>'16タイプ別の恋愛傾向を見る →', 'url'=>'/articles/love/mbti/'],
    ['label'=>'血液型×恋愛', 'title'=>'A・B・O・AB型別の恋愛傾向を見る →', 'url'=>'/articles/love/blood/'],
  ],

  'prev' => ['title'=>'恋愛診断の結果の見方', 'url'=>'/articles/love/guide/kekka-no-mikata/'],
  'next' => ['title'=>'Styleとは', 'url'=>'/articles/love/guide/style-guide/'],
];
require __DIR__ . '/../_guide-tpl.php';
