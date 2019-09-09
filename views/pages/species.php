<?php
    $country = str_replace('_', ' ', explode('/', $_GET['q'])[0]);
    
    $common_name = $speciesInfosArray['general'][0]->main_common_name;
    $scientific_name = $speciesInfosArray['general'][0]->scientific_name;
    
    $threats_text = $speciesInfosArray['narrative'][0]->threats;
    $measures_text = $speciesInfosArray['narrative'][0]->conservationmeasures;
    
    $threats = $speciesInfosArray['threats'];
    $measures = $speciesInfosArray['measures'];
    
    $category = $speciesInfosArray['general'][0]->category;
    $categories = [
        'LC',
        'NV',
        'VU',
        'EN',
        'CE',
        'EW',
        'EX'
    ];
    
    $marine_system = $speciesInfosArray['general'][0]->marine_system;
    $freshwater_system = $speciesInfosArray['general'][0]->freshwater_system;
    $terrestrial_system = $speciesInfosArray['general'][0]->terrestrial_system;
    
    $population_trend = $speciesInfosArray['general'][0]->population_trend;

    $geographic_range = $speciesInfosArray['narrative'][0]->geographicrange;
    
    if ($marine_system) {
        $system = 'Marine';
    }
    else if ($freshwater_system) {
        $system = 'Freshwater';
    }
    else if ($terrestrial_system) {
        $system = 'Terrestrial';
    }
    
    $habitats = $speciesInfosArray['habitats'];
?>
<?php include './views/partials/header.php'; ?>
<script>
    const countryCode = <?= json_encode($_GET['country']) ?>;
</script>
<div class="species">
    <?php include './views/partials/sidebar.php'; ?>
    <div class="species__scroll-content">
        <div class="species__scroll-content__main">
            <div class="title">
                <h1><?= !empty($common_name) ? $common_name : $scientific_name  ?></h1>
                <a href="<?= URL.$country ?>" title="Back to country" class="js-go-back">Back</a>
            </div>
            <p class="italic scientific"><?= !empty($common_name) ? $scientific_name : '' ?></p>
            <?php if(empty($threats) && empty($measures)): ?>
                <p>Not enough data for this species !</p>
            <?php endif; ?>
            <?php if(!empty($threats)): ?>
                <h2>Threats</h2>
                <?php if(!empty($threats_text)): ?>
                    <p><?= $threats_text ?></p>
                <?php endif; ?>
                <ul>
                <?php foreach($threats as $_threat): ?>
                    <li><?= $_threat->title ?></li>
                <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <?php if(!empty($measures)): ?>
                <h2>Conservation actions needed</h2>
                <?php if (!empty($measures_text)): ?>
                    <p><?=$measures_text ?></p>
                <?php endif; ?>
                <ul>
                    <?php foreach($measures as $_measure): ?>
                        <li><?= $_measure->title ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
        <div class="species__scroll-content__sidebar">
            <div class="img-container">
                <img src="<?= $speciesInfosArray['general'][0]->url ?>" alt="">
            </div>
            <div class="title">
                <h1><?= !empty($common_name) ? $common_name : $scientific_name  ?></h1>
                <a href="<?= URL.$country ?>" title="Back to country" class="js-go-back">Back</a>
            </div>
            <p class="italic scientific"><?= !empty($common_name) ? $scientific_name : '' ?></p>
            <div class="description">
                <div class="categories">
                    <?php foreach($categories as $_category): ?>
                        <p <?= $_category == $category ? 'class="is-selected"' : '' ?>><?= $_category ?></p>
                    <?php endforeach; ?>
                </div>
                <?php if(empty($population_trend) && empty($habitats) && empty($geographic_range)): ?>
                    <p> Not enough data for this species !</p>
                <?php endif; ?>
                <?php if(!empty($population_trend)): ?>
                    <p> Population : <strong><?= $population_trend ?></strong></p>
                <?php endif; ?>
                <h2>Habitat and Ecology</h2>
                <p>System : <strong><?= $system ?></strong></p>
                <?php if(!empty($habitats)): ?>
                    <p>Habitats : </p>
                    <ul>
                        <?php foreach($habitats as $_habitat): ?>
                            <li><?= $_habitat->habitat ?></li>
                        <?php endforeach ; ?>
                    </ul>
                <?php endif; ?>
                <?php if(!empty($geographic_range)): ?>
                    <h2>Geographic Range</h2>
                    <p class="light"><?= $geographic_range ?></p>
                <?php endif; ?>
            </div>
        </div>
        
        
    </div>
</div>

<?php include './views/partials/footer.php'; ?>
