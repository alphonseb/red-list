<?php
$country = str_replace('_', ' ', explode('/',$_GET['q'])[0]);

$species = $selectedSpeciesArray['newArray'];
?>

<?php include './views/partials/header.php' ?>

<script>
    const countryCode = <?= json_encode($countryArray->country) ?>;
</script>

<div class="region">
    <?php include './views/partials/sidebar.php' ?>
    <div class="region__scroll-content">
        <div class="region__scroll-content__stats">
            <h2>Statistics</h2>
            <div class="container">
                <div class="total-count">
                    <h3>Endangered Species in <span><?= $country ?><span></h3>
                    <p><?= $countryArray->count ?></p>
                </div>
                <div class="donut-chart">
                    <h3>Percentage by category of endangerment</h3>
                </div>
            </div>
        </div>
        <div class="region__scroll-content__header">
            <h2>Browse the species</h2>
            <div class="filter">You can filter here</div>
            <form action="" class="categoryForm" method="post">
                <div class="category">
                    <input <?= empty($_POST['cat'])? 'checked':''; ?> type="radio" name="cat" id="lc" value="LC">
                    <label for="lc">Least Concern</label>
                </div>
                <div class="category">
                    <input <?= (!empty($_POST['cat']) && $_POST['cat'] == 'NT')? 'checked':''; ?> type="radio" name="cat" id="nv" value="NT">
                    <label for="nv">Never Threatened</label>
                </div>
                <div class="category">
                    <input <?= (!empty($_POST['cat']) && $_POST['cat'] == 'VU')? 'checked':''; ?> type="radio" name="cat" id="vu" value="VU">
                    <label for="vu">Vulnerable</label>
                </div>
                <div class="category">
                    <input <?= (!empty($_POST['cat']) && $_POST['cat'] == 'EN')? 'checked':''; ?> type="radio" name="cat" id="en" value="EN">
                    <label for="en">Endangered</label>
                </div>
                <div class="category">
                    <input <?= (!empty($_POST['cat']) && $_POST['cat'] == 'CR')? 'checked':''; ?> type="radio" name="cat" id="ce" value="CR">
                    <label for="ce">Critically Endangered</label>
                </div>
                <div class="category">
                    <input <?= (!empty($_POST['cat']) && $_POST['cat'] == 'EW')? 'checked':''; ?> type="radio" name="cat" id="ew" value="EW">
                    <label for="ew">Extinct in the wild</label>
                </div>
                <div class="category">
                    <input <?= (!empty($_POST['cat']) && $_POST['cat'] == 'EX')? 'checked':''; ?> type="radio" name="cat" id="ex" value="EX">
                    <label for="ex">Extinct</label>
                </div>
            </form>
        </div>
        <div class="region__scroll-content__tiles">
            <?php foreach($species as $_single_species): ?>
                <a href="<?= URL.explode('/',$_GET['q'])[0].'/'.strtolower(str_replace(' ', '_', $_single_species['scientific_name'])) ?>" title="<?= $_single_species['scientific_name'] ?>">    
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
        </div>
        <p class="empty-cat <?= count($species) != 0 ? 'hidden' : '' ?>">No species found !</p>
        <?php if ($selectedSpeciesArray['oldArray']['count'] > 0): ?>
            <div class="full-loader">
                <div class="loader-container">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                        <circle cx="25" cy="25" r="20" />
                    </svg>
                </div>
                <button class="js-load-more load-more">Load more</button>
            </div>
        <?php endif; ?>
    </div>
</div>
<script>
    const count = <?= json_encode($categoryCountArray['category']) ?>;
    let selectedSpecies = <?= json_encode($selectedSpeciesArray) ?>;
</script>
<script src="https://d3js.org/d3.v5.min.js"></script>
<?php include './views/partials/footer.php'; ?>