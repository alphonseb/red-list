<?php foreach($selectedSpeciesArray['newArray'] as $_single_species): ?>
    <a class="async" href="<?= URL.explode('/',$_GET['q'])[0].'/'.strtolower(str_replace(' ', '_', $_single_species['scientific_name'])) ?>" title="<?= $_single_species['scientific_name'] ?>">    
        <div class="region__scroll-content__tiles__single-tile">
            <div class="img-container">
                <img src="<?= $_single_species['url'] ?>" alt="<?= $_single_species['main_common_name'] ?>">
            </div>
            <div class="description">
                <div class="details">
                    <span><?= $_single_species['kingdom'] ?> - <?= $_single_species['class'] ?></span>
                    <span><?= $_single_species['family'] ?></span>
                </div>
                    <?php if(!empty($_single_species['main_common_name'])): ?>
                        <h3><?= $_single_species['main_common_name'] ?></h3>
                    <?php else: ?>
                        <h3><?= $_single_species['scientific_name'] ?></h3>
                    <?php endif; ?>
                    <?php if(!empty($_single_species['main_common_name'])): ?>
                        <p class="italic"><?= $_single_species['scientific_name'] ?></p>
                    <?php endif; ?>
                <div class="status">
                    <div class="status__arrow">
                        <span><?= $_single_species['population_trend'] ?></span>
                        <?php if($_single_species['population_trend'] == 'Decreasing'): ?>
                            <img src="<?= URL ?>dist/img/arrow_decrease.png" alt="Decreasing">
                        <?php elseif($_single_species['population_trend'] == 'Increasing'): ?>
                            <img src="<?= URL ?>dist/img/arrow_increase.png" alt="Increasing">
                        <?php else: ?>
                            <img src="<?= URL ?>dist/img/stable.png" alt="Stable">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </a>
<?php endforeach; ?>