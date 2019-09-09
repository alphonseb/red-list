<?php include './views/partials/header.php' ?>

<div class="about">
    
    <?php include './views/partials/navigation.php' ?>
    
    
    <div class="container">
    
        <div class="article article-1">
            <div class="text">
                <div class="title">
                    <h2>Background & History</h2>
                    <img src="<?= URL ?>dist/img/paw.png" alt="logo">
                </div>
                <p>Deforestation and overexploitation of land, unsustainable use of natural resources, the introduction of invasive species, poaching and illegal trade in species, as well as climate change and pollution are putting unprecedented pressure on wild nature.</p>
                <p>Wildlife is essential to the balance of nature and our well-being. Nearly two million animal and plant species have been identified to date and millions more have not yet been discovered. This incredible biodiversity is essential to our life on Earth. However, more than one in three species is now threatened with extinction.</p>
            </div>
            <img src="<?= URL ?>dist/img/tiger.png" alt="tiger">  
    
        </div>
        
        <div class="article article-2">
            <img src="<?= URL ?>dist/img/elephant.png" alt="elephant">
            <div class="text">
                <div class="title">
                    <h2>Who are we?</h2>
                    <img src="<?= URL ?>dist/img/paw.png" alt="logo">
                </div>
                <p>We are a group of web students committed to this animal cause: our goal is to raise awareness among as many people as possible in order to preserve Nature.</p>
            </div>
        </div>
    
        <div class="article article-3">
            <div class="text">
                <div class="title">
                    <h2>Our goal</h2>
                    <img src="<?= URL ?>dist/img/paw.png" alt="logo">
                </div>
                <p>In order to raise awareness of endangered animals around the world, we have created a planisphere that groups all endangered animals by region of the world..</p>
            </div>
            <img src="<?= URL ?>dist/img/rhino.png" alt="rhino">
    
        </div>
    
        <div class="article article-4">
            <img src="<?= URL ?>dist/img/gorilla.png" alt="gorilla">
            <div class="text">
                <div class="title">
                    <h2>Actions</h2>
                    <img src="<?= URL ?>dist/img/paw.png" alt="logo">
                </div>
                <p>People can react to this: there are many actions that can significantly reduce the number of endangered animal species and save them, starting with consumption. Consumption leads to the destruction of wildlife habitats to fulfill consumer needs. Consuming less, to save more.  For example: eat less fish, do not buy products containing palm oil, save electricity, use less car etc...</p>
            </div>
        </div>
    
    
        <div class="article article-map">
            
            <div class="map">
                <div class="text">
                    <p>Come and see our work !</p>
                    <img src="<?= URL ?>dist/img/arrow.svg" alt="arrow">  
                </div>
                <a href="<?= URL ?>map" title="The map">
                    <?php include './views/partials/world_svg.php' ?>
                </a>
            </div>
    
        </div>
    </div>
</div>

<?php include './views/partials/footer.php' ?>