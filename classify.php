<?php session_start(); ?>
<?php include_once "head.php" ?>
<body>
    <?php include_once "header.php" ?>
    <div class="container classify-container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Plant Classification Header -->
                <div class="classification-header text-center mb-4">
                    <h2>Plant Classification</h2>
                </div>

                <!-- Card: Understanding Families, Genus, and Species -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title classify-titles">Understanding Families, Genus, and Species</h5>
                        <p class="card-text">In plant taxonomy, plants are classified in hierarchical categories. The three most important categories are Family, Genus, and Species.</p>
                    </div>
                </div>

                <!-- Card: Family -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title classify-titles">Family</h5>
                        <p class="card-text">The <strong>Family</strong> is a broader classification, grouping together plants that share several characteristics, such as flower structure or reproductive features. Families can include multiple genera (plural of genus).</p>
                    </div>
                </div>

                <!-- Card: Genus -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title classify-titles">Genus</h5>
                        <p class="card-text">The <strong>Genus</strong> is a group of species that are closely related and share common traits. The genus name is always capitalized, and it precedes the species name in the binomial nomenclature.</p>
                    </div>
                </div>

                <!-- Card: Species -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title classify-titles">Species</h5>
                        <p class="card-text">The <strong>Species</strong> is the most specific level of classification. It represents individual plants that are capable of interbreeding. The species name follows the genus name and is not capitalized.</p>
                    </div>
                </div>

                <!-- Card: Classification Hierarchy Image -->
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="img/Plants Classification.jpg" alt="Plant Classification Hierarchy" class="img-fluid mb-3">
                        <p class="card-text">Figure: Hierarchy of Plant Classification from Family to Species</p>
                    </div>
                </div>

                <!-- Card: Example Classification -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title classify-titles">An Example of Plant Classification</h5>
                        <p class="card-text">In this example, we will explore the classification of a plant from the <strong>Dipterocarpaceae</strong> family, focusing on the <strong>Dipterocarpus</strong> genus and the species <em>Dipterocarpus confertus</em>.</p>
                    </div>
                </div>

                <!-- Card: Family -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title classify-titles">Family: Dipterocarpaceae</h5>
                        <p class="card-text">The Dipterocarpaceae family consists of tropical trees that are primarily found in Southeast Asia. These trees are known for their timber and resin.</p>
                    </div>
                    <!-- Example Images for Family -->
                    <div class="card-body text-center">
                        <img src="img/family_image1.jpg" alt="Family Example 1" class="img-fluid mb-3">
                        <p class="card-text">Figure 1: An example of the Dipterocarpaceae family</p>
                        <img src="img/family_image2.jpg" alt="Family Example 2" class="img-fluid mb-3">
                        <p class="card-text">Figure 2: Another example of the Dipterocarpaceae family</p>
                    </div>
                </div>

                <!-- Card: Genus -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title classify-titles">Genus: Dipterocarpus</h5>
                        <p class="card-text">The genus <em>Dipterocarpus</em> includes large trees that produce two-winged fruits. These trees are commonly found in rainforests and contribute significantly to forest ecology.</p>
                    </div>
                    <!-- Example Images for Genus -->
                    <div class="card-body text-center">
                        <img src="img/genus_image1.jpg" alt="Genus Example 1" class="img-fluid mb-3">
                        <p class="card-text">Figure 1: An example of the Dipterocarpus genus</p>
                        <img src="img/genus_image2.jpg" alt="Genus Example 2" class="img-fluid mb-3">
                        <p class="card-text">Figure 2: Another example of the Dipterocarpus genus</p>
                    </div>
                </div>

                <!-- Card: Species -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title classify-titles">Species: Dipterocarpus confertus</h5>
                        <p class="card-text"><em>Dipterocarpus confertus</em> is a species native to tropical rainforests. It is known for its durable timber and plays a role in maintaining forest canopy structures.</p>
                    </div>
                    <!-- Example Images for Species -->
                    <div class="card-body text-center">
                        <img src="img/species_image1.jpg" alt="Species Example 1" class="img-fluid mb-3">
                        <p class="card-text">Figure 1: A photograph of <em>Dipterocarpus confertus</em></p>
                        <img src="img/species_image2.jpg" alt="Species Example 2" class="img-fluid mb-3">
                        <p class="card-text">Figure 2: Another example of a <em>Dipterocarpus</em> species</p>
                    </div>
                </div>

                <!-- Card: Additional Resources -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title classify-titles">Additional Resources</h5>
                        <p class="card-text">For more information on plant classification, you can explore the following resources:</p>
                        <ul>
                            <li><a href="https://www.sciencedirect.com/science/article/pii/S0925231221014934" target="_blank">Science Direct: Plant Classification Study</a></li>
                            <li><a href="https://www.americanmeadows.com/content/general-guides/plant-classification?srsltid=AfmBOoovhnywl-QVkIywNQ3jeJ5UmmNwn2mpk_Sdn-yYzJHIiDrHR4Ag" target="_blank">American Meadows: Plant Classification Guide</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php include_once "footer.php" ?>
</body>
