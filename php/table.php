<div class="table">
    <div class="table-header">
        <div class="header__item"><a id="x-table" class="filter__link" href="#">X</a></div>
        <div class="header__item"><a id="y-table" class="filter__link filter__link--number" href="#">Y</a></div>
        <div class="header__item"><a id="r-table" class="filter__link filter__link--number" href="#">R</a></div>
        <div class="header__item"><a id="result-table" class="filter__link filter__link--number" href="#">result</a></div>
        <div class="header__item"><a id="time-table" class="filter__link filter__link--number" href="#">Time</a></div>
        <div class="header__item"><a id="cr-time-table" class="filter__link filter__link--number" href="#">Benchmark</a></div>
    </div>
    <?php foreach ($_SESSION['history'] as $value) { ?>
        <div class="table-content">
            <div class="table-row">
                <div class="table-data"><?php echo $value[0] ?></div>
                <div class="table-data"><?php echo $value[1] ?></div>
                <div class="table-data"><?php echo $value[2] ?></div>
                <div class="table-data"><?php echo $value[3] ?></div>
                <div class="table-data"><?php echo $value[4] ?></div>
                <div class="table-data"><?php echo number_format($value[5], 10, ".", "")*1000000 ?></div>
            </div>
        </div>
    <?php }?>
</div>
