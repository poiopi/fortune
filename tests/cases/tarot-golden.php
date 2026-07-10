<?php
// tests/cases/tarot-golden.php
// Golden Master: 22カード×正逆=44ケース全件（サンプリングではなく全数）。
// test.life-fun.net/tarot.php の TAROT 定数から直接抽出。
// 生成元: tests/tools/export-tarot-data.js（再実行すれば作り直せる）
return [
    'generator' => 'test.life-fun.net/tarot.php (TAROT定数)',
    'generatorVersion' => '2026-07-05',
    'generatedAt' => '2026-07-05T14:12:30.131Z',
    'deckVersion' => 1,
    'caseCount' => 44,
    'cases' => [
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 0,
                'isUpright' => true,
            ],
            'expected' => [
                'name' => '愚者',
                'en' => 'The Fool',
                'img' => 'fool',
                'keywords' => '新しい始まり・純粋さ・冒険・無限の可能性',
                'message' => '新たな旅の始まりを告げるカードです。恐れを手放し、純粋な心で一歩を踏み出してください。計算より直感、準備より行動。あなたの前には、想像を超えた可能性が広がっています。今こそ、魂の声に従って動くとき。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 0,
                'isUpright' => false,
            ],
            'expected' => [
                'name' => '愚者',
                'en' => 'The Fool',
                'img' => 'fool',
                'keywords' => '無謀・無責任・現実逃避・準備不足',
                'message' => '焦りや無謀さが行動を妨げているかもしれません。飛び込む前に少しだけ立ち止まり、状況を整理しましょう。地に足をつけた判断が今のあなたには必要です。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 1,
                'isUpright' => true,
            ],
            'expected' => [
                'name' => '魔術師',
                'en' => 'The Magician',
                'img' => 'magician',
                'keywords' => '意志の力・スキル・集中・現実化',
                'message' => 'あなたには、目標を実現するためのすべてが揃っています。才能・知識・情熱——必要なものはすでに手の中にあります。あとは強い意志で一点に集中するだけ。今のあなたには、思い描いたものを現実に変える力が宿っています。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 1,
                'isUpright' => false,
            ],
            'expected' => [
                'name' => '魔術師',
                'en' => 'The Magician',
                'img' => 'magician',
                'keywords' => '才能の無駄遣い・欺き・優柔不断',
                'message' => '持っている才能を活かしきれていないかもしれません。散漫になっているエネルギーを一つのことに集中させることで、状況が大きく動き始めます。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 2,
                'isUpright' => true,
            ],
            'expected' => [
                'name' => '女教皇',
                'en' => 'The High Priestess',
                'img' => 'high-priestess',
                'keywords' => '直感・内なる知恵・神秘・静寂',
                'message' => '答えはすでにあなたの内側にあります。外の世界より、内なる声に耳を澄ませてください。夢、直感、ふとした閃き——すべてが宇宙からのメッセージです。今は行動より「感じること」を優先する時期です。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 2,
                'isUpright' => false,
            ],
            'expected' => [
                'name' => '女教皇',
                'en' => 'The High Priestess',
                'img' => 'high-priestess',
                'keywords' => '感情の抑圧・秘密・直感の無視',
                'message' => '自分の直感を信じることをためらっていませんか？心の奥から聞こえる声を無視せず、正直に向き合ってみてください。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 3,
                'isUpright' => true,
            ],
            'expected' => [
                'name' => '女帝',
                'en' => 'The Empress',
                'img' => 'empress',
                'keywords' => '豊かさ・愛・創造・母性・繁栄',
                'message' => '豊穣と愛情のエネルギーに満ちています。与えること、育てること、楽しむこと——この三つを大切にすることで、あなたの人生はさらに花開きます。創造的な活動や自然との触れ合いが、今の運気を高めます。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 3,
                'isUpright' => false,
            ],
            'expected' => [
                'name' => '女帝',
                'en' => 'The Empress',
                'img' => 'empress',
                'keywords' => '依存・創造性の停滞・過保護',
                'message' => '誰かへの依存や、自分を後回しにしすぎている状況が見受けられます。まず自分自身を大切にすることから始めてください。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 4,
                'isUpright' => true,
            ],
            'expected' => [
                'name' => '皇帝',
                'en' => 'The Emperor',
                'img' => 'emperor',
                'keywords' => '権威・安定・秩序・リーダーシップ',
                'message' => '今こそ、自分の人生における主役として堂々と立つべき時です。ルールを設け、秩序をもたらすことで、周囲からの信頼が集まります。感情より論理、直感より計画。しっかりとした基盤を築くことが吉。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 4,
                'isUpright' => false,
            ],
            'expected' => [
                'name' => '皇帝',
                'en' => 'The Emperor',
                'img' => 'emperor',
                'keywords' => '支配・頑固・感情の抑圧',
                'message' => 'コントロールへの執着が、柔軟性を奪っているかもしれません。時には流れに身を委ねることも、大切なリーダーシップです。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 5,
                'isUpright' => true,
            ],
            'expected' => [
                'name' => '法王',
                'en' => 'The Hierophant',
                'img' => 'hierophant',
                'keywords' => '伝統・精神的導き・師との縁・信念',
                'message' => '信頼できる師や先輩との縁が深まる時期です。伝統や慣習の中に、あなたへの重要なヒントが隠れています。学ぶ姿勢を持ち続けることで、精神的な成長が物質的な豊かさをも呼び込みます。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 5,
                'isUpright' => false,
            ],
            'expected' => [
                'name' => '法王',
                'en' => 'The Hierophant',
                'img' => 'hierophant',
                'keywords' => '既成概念への反発・形式主義・偽善',
                'message' => '古いルールや既成概念があなたを縛っているかもしれません。本当に自分が信じることは何か、改めて問い直してみましょう。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 6,
                'isUpright' => true,
            ],
            'expected' => [
                'name' => '恋人',
                'en' => 'The Lovers',
                'img' => 'lovers',
                'keywords' => '愛・選択・調和・価値観の一致',
                'message' => '心から「Yes」と言える選択が、今のあなたに問われています。恋愛だけでなく、仕事や生き方においても「本当に好きなもの」を選ぶ勇気が開運の鍵。魂レベルで「これだ」と感じる方向へ進んでください。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 6,
                'isUpright' => false,
            ],
            'expected' => [
                'name' => '恋人',
                'en' => 'The Lovers',
                'img' => 'lovers',
                'keywords' => '不一致・選択の困難・価値観の衝突',
                'message' => '価値観のズレや、選択への迷いを感じているかもしれません。誰かに合わせすぎず、自分の心が本当に求めるものに正直になってみてください。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 7,
                'isUpright' => true,
            ],
            'expected' => [
                'name' => '戦車',
                'en' => 'The Chariot',
                'img' => 'chariot',
                'keywords' => '勝利・意志・前進・自制心',
                'message' => '強い意志と集中力で、目標へと突き進む時です。相反する力をコントロールし、一つの方向へエネルギーを集めてください。障害はあなたを止めるためにあるのではなく、強さを試すためにあります。前進あるのみ。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 7,
                'isUpright' => false,
            ],
            'expected' => [
                'name' => '戦車',
                'en' => 'The Chariot',
                'img' => 'chariot',
                'keywords' => '方向性の欠如・攻撃性・コントロール不能',
                'message' => '方向性が定まらず、エネルギーが分散しているかもしれません。まず「どこへ向かいたいか」を明確にすることが先決です。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 8,
                'isUpright' => true,
            ],
            'expected' => [
                'name' => '力',
                'en' => 'Strength',
                'img' => 'strength',
                'keywords' => '内なる強さ・勇気・忍耐・優しさ',
                'message' => '真の力は、激しさではなく優しさから生まれます。感情を力で押さえ込むのではなく、愛情を持って向き合うことで、どんな困難も乗り越えられます。あなたの内側には、獅子をも従わせる穏やかな強さが宿っています。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 8,
                'isUpright' => false,
            ],
            'expected' => [
                'name' => '力',
                'en' => 'Strength',
                'img' => 'strength',
                'keywords' => '自信の喪失・弱さ・疑念',
                'message' => '自信を失いかけているかもしれませんが、それは一時的なものです。弱さを認める勇気こそが、本当の強さへの第一歩です。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 9,
                'isUpright' => true,
            ],
            'expected' => [
                'name' => '隠者',
                'en' => 'The Hermit',
                'img' => 'hermit',
                'keywords' => '内省・知恵・孤独・内なる指針',
                'message' => '今は立ち止まり、自分の内側を静かに照らすべき時です。孤独を恐れず、一人の時間を大切にすることで、次のステージへ向けた深い洞察が得られます。答えはすでにあなたの中にあります。静寂の中で耳を澄ませてください。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 9,
                'isUpright' => false,
            ],
            'expected' => [
                'name' => '隠者',
                'en' => 'The Hermit',
                'img' => 'hermit',
                'keywords' => '孤立・引きこもり・頑固',
                'message' => '孤立が長すぎると、視野が狭まることがあります。信頼できる人に心を開くことで、新しい光が見えてくるでしょう。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 10,
                'isUpright' => true,
            ],
            'expected' => [
                'name' => '運命の輪',
                'en' => 'Wheel of Fortune',
                'img' => 'wheel',
                'keywords' => '転機・サイクル・幸運・変化',
                'message' => '運命の輪が回り、新たなサイクルの始まりを告げています。変化を恐れず乗りこなすことで、幸運の波があなたを高みへと運びます。今起きていることには必ず宇宙的な意味があります。流れを信頼してください。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 10,
                'isUpright' => false,
            ],
            'expected' => [
                'name' => '運命の輪',
                'en' => 'Wheel of Fortune',
                'img' => 'wheel',
                'keywords' => '不運・停滞・変化への抵抗',
                'message' => '変化への抵抗が、停滞を生んでいるかもしれません。輪は必ず回ります。今の状況は永遠ではありません。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 11,
                'isUpright' => true,
            ],
            'expected' => [
                'name' => '正義',
                'en' => 'Justice',
                'img' => 'justice',
                'keywords' => '公正・真実・因果・バランス',
                'message' => '因果の法則が働いています。正直で公正な行動が、今のあなたに最大の幸運をもたらします。過去の誠実な努力が正当に評価される時期でもあります。迷ったときは「正しいこと」を選ぶ。それだけで道は開けます。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 11,
                'isUpright' => false,
            ],
            'expected' => [
                'name' => '正義',
                'en' => 'Justice',
                'img' => 'justice',
                'keywords' => '不公平・不誠実・責任逃れ',
                'message' => '誰かに対して、あるいは自分自身に対して、不誠実になっていませんか？真実に向き合うことで、停滞が動き始めます。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 12,
                'isUpright' => true,
            ],
            'expected' => [
                'name' => '吊られた男',
                'en' => 'The Hanged Man',
                'img' => 'hanged-man',
                'keywords' => '犠牲・新視点・待機・悟り',
                'message' => '今は行動よりも待機の時。逆さまになることで、まったく新しい視点が得られます。手放すことを恐れないでください。執着を離れた先に、真の豊かさと深い気づきが待っています。この静止の時間には深い意味があります。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 12,
                'isUpright' => false,
            ],
            'expected' => [
                'name' => '吊られた男',
                'en' => 'The Hanged Man',
                'img' => 'hanged-man',
                'keywords' => '無駄な犠牲・停滞・変化への拒絶',
                'message' => '無駄な我慢や、変化への頑固な抵抗が状況を複雑にしているかもしれません。手放すべきものを手放すことで、流れが変わります。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 13,
                'isUpright' => true,
            ],
            'expected' => [
                'name' => '死神',
                'en' => 'Death',
                'img' => 'death',
                'keywords' => '変容・終わりと始まり・手放し・再生',
                'message' => '「死神」は終わりではなく、変容と再生の象徴です。古いものが終わりを告げ、新しいものが生まれようとしています。今感じる「終わり」は、次の始まりへの扉。手放す勇気が、あなたの人生に新鮮な息吹をもたらします。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 13,
                'isUpright' => false,
            ],
            'expected' => [
                'name' => '死神',
                'en' => 'Death',
                'img' => 'death',
                'keywords' => '変化への抵抗・停滞・執着',
                'message' => '変化を恐れて、終わるべきものにしがみついていませんか？手放すことへの恐れが、新しい出発を遅らせています。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 14,
                'isUpright' => true,
            ],
            'expected' => [
                'name' => '節制',
                'en' => 'Temperance',
                'img' => 'temperance',
                'keywords' => '調和・バランス・忍耐・癒し',
                'message' => '異なるものをうまく組み合わせることで、奇跡が生まれます。焦らず、じっくりと。時間をかけて物事を育てることで、やがて黄金が生まれます。今のあなたに必要なのは、バランスと忍耐、そして癒しの時間です。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 14,
                'isUpright' => false,
            ],
            'expected' => [
                'name' => '節制',
                'en' => 'Temperance',
                'img' => 'temperance',
                'keywords' => '不均衡・過剰・焦り',
                'message' => '何かが行き過ぎていませんか？仕事・感情・生活習慣のどこかでバランスが崩れているかもしれません。中庸を取り戻すことが今の課題です。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 15,
                'isUpright' => true,
            ],
            'expected' => [
                'name' => '悪魔',
                'en' => 'The Devil',
                'img' => 'devil',
                'keywords' => '束縛・執着・物質主義・解放への鍵',
                'message' => '何かがあなたを縛っているように感じていませんか？しかしその鎖は、実は自分でいつでも外せるものです。恐れや欲望、習慣——何があなたを縛っているのかを正直に見つめることが、解放への第一歩です。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 15,
                'isUpright' => false,
            ],
            'expected' => [
                'name' => '悪魔',
                'en' => 'The Devil',
                'img' => 'devil',
                'keywords' => '解放・自由・執着からの脱出',
                'message' => '執着や恐れからの解放が近づいています。長い間あなたを縛っていたものから、ようやく自由になれるタイミングです。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 16,
                'isUpright' => true,
            ],
            'expected' => [
                'name' => '塔',
                'en' => 'The Tower',
                'img' => 'tower',
                'keywords' => '突然の変化・崩壊・解放・真実の露出',
                'message' => '崩れるべきものが崩れ、本質だけが残ります。一見破壊的に見えるこの変化の中に、長い間必要だった「解放」が隠れています。嵐が過ぎた後の空は、必ず澄み渡っています。変化を恐れず、受け入れてください。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 16,
                'isUpright' => false,
            ],
            'expected' => [
                'name' => '塔',
                'en' => 'The Tower',
                'img' => 'tower',
                'keywords' => '変化の回避・内なる混乱・崩壊の先延ばし',
                'message' => '内側では大きな変化が起きているのに、表面では現状維持しようとしているかもしれません。迫りくる変化に正直に向き合う時です。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 17,
                'isUpright' => true,
            ],
            'expected' => [
                'name' => '星',
                'en' => 'The Star',
                'img' => 'star',
                'keywords' => '希望・刷新・インスピレーション・信頼',
                'message' => 'あなたの前には、確かな可能性の光が灯っています。傷ついた心が癒され、夢を信じる力が戻ってきます。今のあなたの願いは、星の力を借りて現実へと近づいています。希望を手放さないでください。宇宙はあなたの味方です。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 17,
                'isUpright' => false,
            ],
            'expected' => [
                'name' => '星',
                'en' => 'The Star',
                'img' => 'star',
                'keywords' => '希望の喪失・失望・自信のなさ',
                'message' => '希望を見失いかけているかもしれませんが、星はまだそこにあります。曇り空の向こうにも、光は消えていません。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 18,
                'isUpright' => true,
            ],
            'expected' => [
                'name' => '月',
                'en' => 'The Moon',
                'img' => 'moon',
                'keywords' => '幻想・直感・潜在意識・不安',
                'message' => '今は物事がはっきり見えにくい時期かもしれませんが、それはあなたの内なる感性が研ぎ澄まされているサインでもあります。夢や直感を大切にしてください。見えない世界からのメッセージに耳を傾けることで、真実が浮かび上がります。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 18,
                'isUpright' => false,
            ],
            'expected' => [
                'name' => '月',
                'en' => 'The Moon',
                'img' => 'moon',
                'keywords' => '混乱の解消・真実の露出・恐れの克服',
                'message' => '霧が晴れ始め、混乱していた状況が明確になってきます。恐れていたことが実は大したことではなかったと気づく時期です。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 19,
                'isUpright' => true,
            ],
            'expected' => [
                'name' => '太陽',
                'en' => 'The Sun',
                'img' => 'sun',
                'keywords' => '喜び・成功・活力・明るさ・達成',
                'message' => '大アルカナ最高の幸運カードがあなたのもとへ届きました！喜びと成功のエネルギーに満ちています。子供のような純粋さで世界と向き合うことで、あらゆる願いが光の速さで実現に向かいます。今のあなたは、太陽のように輝いています。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 19,
                'isUpright' => false,
            ],
            'expected' => [
                'name' => '太陽',
                'en' => 'The Sun',
                'img' => 'sun',
                'keywords' => '一時的な陰り・過信・楽観すぎ',
                'message' => '幸運の光は続いていますが、少し過信や見落としがあるかもしれません。謙虚さを忘れずに、喜びを大切にしてください。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 20,
                'isUpright' => true,
            ],
            'expected' => [
                'name' => '審判',
                'en' => 'Judgement',
                'img' => 'judgement',
                'keywords' => '覚醒・再生・召命・清算',
                'message' => '高いところからの呼びかけに、今のあなたは応える準備ができています。過去を清算し、真の使命に目覚めるタイミング。大きな転換点に立つあなたへのメッセージは「今こそ本当の自分として生きよ」です。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 20,
                'isUpright' => false,
            ],
            'expected' => [
                'name' => '審判',
                'en' => 'Judgement',
                'img' => 'judgement',
                'keywords' => '自己批判・過去への固執・決断の先延ばし',
                'message' => '過去の失敗や後悔を手放せていないかもしれません。自分を責めることをやめ、前を向く勇気を持つことが今の課題です。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 21,
                'isUpright' => true,
            ],
            'expected' => [
                'name' => '世界',
                'en' => 'The World',
                'img' => 'world',
                'keywords' => '完成・統合・達成・新サイクルの扉',
                'message' => '大アルカナの完成形があなたを祝福しています！一つのサイクルの完全なる達成と成就。今のあなたには、物事を完成に導く力が宿っています。喜んで受け取り、次の大きな旅への扉を開いてください。すべてが整っています。',
            ],
        ],
        [
            'input' => [
                'deckVersion' => 1,
                'cardOrder' => 21,
                'isUpright' => false,
            ],
            'expected' => [
                'name' => '世界',
                'en' => 'The World',
                'img' => 'world',
                'keywords' => '未完成・遅延・近道を探す',
                'message' => 'もう少しで完成というところで、何かが滞っているかもしれません。焦らず、残りのピースを丁寧に埋めていきましょう。',
            ],
        ],
    ],
];
