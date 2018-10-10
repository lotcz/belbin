<?php
  $question = $this->getData('question');
  if (isset($question)) {
    $q_index = $question->ival('belbin_question_index');
  } else {
    $q_index = 0;
  }
  $q_total = $this->getData('questions_count', 0);
?>

<nav class="navbar navbar-expand-md navbar-dark sticky-top">
  <span class="navbar-brand">Belbinův test online</span>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon">&nbsp;</span>
  </button>

  <div class="collapse navbar-collapse" id="navbar">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <div>
          <span class="navbar-text">Otázky: <?= $q_index . '/' . $q_total ?></span>
          <div style="margin-left:1rem;display:inline-block;width:50px">
            <div class="progress">
              <div id="test_progress" class="progress-bar bg-success" role="progressbar" style="display:block;width:<?=z::safeDivide($q_index,$q_total)*100 ?>%" aria-valuenow="<?=$q_index ?>" aria-valuemin="1" aria-valuemax="<?=$q_total ?>"></div>
            </div>
          </div>
        </div>
      </li>
    </ul>

    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="btn btn-warning" href="<?=$this->url('') ?>" role="button">Opustit test</a>
      </li>
    </ul>
  </div>
</nav>
