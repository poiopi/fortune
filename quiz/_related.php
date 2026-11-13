<?php
// みつぼしの4択：解説ページの下に「同じ区分の4択」を出す（_quiz-kaisetsu-a.php・-b.php から読む。$quiz が必要）
require_once __DIR__ . '/_list.php';
$_relList  = quiz_related($quiz, 3);
$_relTheme = quiz_theme_labels()[$quiz['themes'][0] ?? ''] ?? null;
if ($_relList !== [] && $_relTheme !== null):
?>
<style>
.quiz-related{margin:2rem 0 0}
.quiz-related-title{font-family:var(--ff-serif);font-size:1rem;font-weight:600;color:var(--text);margin-bottom:.8rem;letter-spacing:.04em}
.quiz-related-title small{font-family:var(--ff-sans);font-size:.75rem;color:var(--muted);font-weight:400;margin-left:.4rem}
.quiz-related-list{list-style:none;display:flex;flex-direction:column;gap:.6rem}
.quiz-related-list a{display:block;background:var(--card);border:1.5px solid var(--border2);border-radius:14px;padding:.8rem 1.1rem;text-decoration:none;color:var(--text);transition:border-color .2s}
.quiz-related-list a:hover{border-color:var(--accent)}
.quiz-related-type{display:inline-block;font-size:.68rem;color:var(--accent-dk);border:1px solid var(--border2);border-radius:20px;padding:0 .55rem;margin-bottom:.25rem}
.quiz-related-q{font-family:var(--ff-serif);font-weight:600;font-size:.95rem;line-height:1.6}
</style>
<section class="quiz-related" aria-label="同じ区分の4択">
  <h2 class="quiz-related-title">同じ区分の4択<small><?= htmlspecialchars($_relTheme['label'], ENT_QUOTES, 'UTF-8') ?></small></h2>
  <ul class="quiz-related-list">
    <?php foreach ($_relList as $_rq): ?>
    <li><a href="/quiz/<?= htmlspecialchars($_rq['slug'], ENT_QUOTES, 'UTF-8') ?>/">
      <span class="quiz-related-type"><?= ($_rq['series'] ?? '') === 'B' ? '正解はどれ？' : 'あなたはどれ？' ?></span>
      <p class="quiz-related-q"><?= htmlspecialchars($_rq['question'], ENT_QUOTES, 'UTF-8') ?></p>
    </a></li>
    <?php endforeach; ?>
  </ul>
</section>
<?php endif; unset($_relList, $_relTheme, $_rq); ?>
