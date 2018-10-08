<nav class="navbar navbar-expand-md navbar-dark sticky-top">
  <?php
    $this->renderLink('', 'Belbinův test online', 'navbar-brand');
  ?>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon">&nbsp;</span>
  </button>

  <div class="collapse navbar-collapse" id="navbar">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?=($this->raw_path == 'o-testu') ? 'active' : ''; ?>">
        <?php
          $this->renderLink('o-testu', 'O testu', 'nav-link');
        ?>
      </li>

      <li class="nav-item <?=($this->raw_path == 'tymove-role') ? 'active' : ''; ?>">
        <?php
          $this->renderLink('tymove-role', 'Týmové role', 'nav-link');
        ?>
      </li>

      <li class="nav-item <?=($this->raw_path == 'statistiky') ? 'active' : ''; ?>">
        <?php
          $this->renderLink('statistiky', 'Statistiky', 'nav-link');
        ?>
      </li>
    </ul>

    <ul class="navbar-nav">
      <a class="btn btn-success" href="<?=$this->url('test') ?>" rel="nofollow" role="button">Zahájit test &raquo;</a>
    </ul>
  </div>
</nav>
