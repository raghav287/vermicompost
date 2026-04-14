<!DOCTYPE html>
<?php require_once 'admin/db.php'; ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    <title>Home - Vermi Compost</title>
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/images/favicon/site.webmanifest">
    <link rel="shortcut icon" href="assets/images/favicon/favicon.ico">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/mobile_menu.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/scroll_button.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/venobox.min.css">
    <link rel="stylesheet" href="assets/css/select2.min.css">
    <link rel="stylesheet" href="assets/css/jquery.pwstabs.css">
    <link rel="stylesheet" href="assets/css/range_slider.css">
    <link rel="stylesheet" href="assets/css/multiple-image-video.css">
    <link rel="stylesheet" href="assets/css/animated_barfiller.css">
    <link rel="stylesheet" href="assets/css/custom_spacing.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body class="default_home">

    <!--=========================
        HEADER START
    ==========================-->
    <?php include("includes/header.php") ?>
    <!--=========================
        HEADER END
    ==========================-->


    <!--=========================
        BANNER START
    ==========================-->
    <style>
        :root {
            --leaf: #2d8659; /* hsl(142, 50%, 35%) */
            --leaf-light: #ccecd9; /* hsl(142, 35%, 85%) */
            --foreground: #2e261f; /* hsl(30, 20%, 15%) */
            --primary-foreground: #fcfbf4; /* hsl(45, 30%, 97%) */
            --gold: #e6b800; /* hsl(45, 80%, 50%) */
        }
        .hero-section {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding-top: 8rem; /* Increased default padding for mobile */
            padding-bottom: 4rem;
            overflow: hidden;
            color: var(--primary-foreground);
        }
        @media (min-width: 992px) {
            .hero-section {
                padding-top: 4rem; /* Reset for desktop where vertically centered */
            }
        }
        .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .hero-bg img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(46, 38, 31, 0.95), rgba(46, 38, 31, 0.8), rgba(46, 38, 31, 0.4));
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background-color: rgba(45, 134, 89, 0.2);
            color: var(--leaf-light);
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            margin-bottom: 1.5rem;
            font-weight: 500;
            font-size: 0.875rem;
        }
        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem; /* Mobile font size */
            font-weight: 700;
            color: var(--primary-foreground);
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }
        @media (min-width: 768px) {
            .hero-title { font-size: 3.5rem; }
        }
         @media (min-width: 992px) {
            .hero-title { font-size: 4.5rem; }
        }
        .hero-title span {
            display: block;
            color: var(--leaf-light);
            font-size: 1.1em; /* Scales relative to parent */
        }
        .hero-desc {
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            color: rgba(252, 251, 244, 0.8);
            margin-bottom: 2rem;
            max-width: 600px;
            line-height: 1.6;
        }
        @media (min-width: 768px) {
            .hero-desc { font-size: 1.25rem; }
        }
        .hero-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.875rem 1.75rem;
            font-weight: 600;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .hero-btn-primary {
            background-color: var(--leaf);
            color: white;
        }
        .hero-btn-primary:hover {
            background-color: #246d48;
            color: white;
            transform: translateX(5px);
        }
        .hero-btn-outline {
            border: 2px solid var(--primary-foreground);
            color: var(--primary-foreground);
            margin-left: 0; /* Reset for mobile */
        }
        @media (min-width: 576px) {
            .hero-btn-outline { margin-left: 1rem; }
        }
        .hero-btn-outline:hover {
            background-color: var(--primary-foreground);
            color: var(--foreground);
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(252, 251, 244, 0.2);
        }
        .stat-value {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--leaf-light);
        }
        @media (min-width: 768px) {
            .stat-value { font-size: 2rem; }
        }
        .stat-label {
            font-size: 0.75rem;
            color: rgba(252, 251, 244, 0.7);
        }
        @media (min-width: 768px) {
            .stat-label { font-size: 0.875rem; }
        }
        .animate-fade-up {
            animation: fadeUp 0.8s ease-out forwards;
            opacity: 0;
            transform: translateY(30px);
        }
        @keyframes fadeUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <section class="hero-section">
        <div class="hero-bg">
            <img src="assets/images/hero-vermicompost.jpg" alt="Rich vermicompost soil">
            <div class="hero-overlay"></div>
        </div>

        <div class="container position-relative" style="z-index: 10;">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Badge -->
                    <div class="hero-badge animate-fade-up">
                        <i class="fas fa-seedling me-2"></i>
                        <span class="text-white">100% Organic & Sustainable</span>
                    </div>

                    <!-- Heading -->
                    <h1 class="hero-title animate-fade-up" style="animation-delay: 0.1s;">
                        Nature's Best
                        <span>Soil Enrichment</span>
                    </h1>

                    <!-- Description -->
                    <p class="hero-desc animate-fade-up" style="animation-delay: 0.2s;">
                        Transform your garden with premium vermicompost. Our worm-powered fertilizer delivers nutrient-rich organic matter for healthier plants and sustainable growing.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="d-flex flex-wrap gap-3 animate-fade-up" style="animation-delay: 0.3s;">
                        <a href="shop" class="hero-btn hero-btn-primary">
                            Shop Now
                            <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                        <a href="about_us" class="hero-btn hero-btn-outline">
                            Learn More
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="stats-grid animate-fade-up" style="animation-delay: 0.4s;">
                        <div>
                            <div class="stat-value">5K+</div>
                            <div class="stat-label">Happy Farmers</div>
                        </div>
                        <div>
                            <div class="stat-value">100%</div>
                            <div class="stat-label">Organic</div>
                        </div>
                        <div>
                            <div class="stat-value">10+</div>
                            <div class="stat-label">Years Experience</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Decorative Elements -->
        <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 8rem; background: linear-gradient(to top, var(--foreground), transparent);"></div>
    </section>
    <!--=========================
        BANNER END
    ==========================-->

    <!--=========================
        WHY CHOOSE US START
    ==========================-->
    <!--=========================
        BENEFITS SECTION START
    ==========================-->
    <style>
        .benefits-section {
            padding: 5rem 0 8rem;
            background-color: var(--primary-foreground); /* #fcfbf4 */
        }
        .section-tag {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--leaf);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: block;
            margin-bottom: 1rem;
        }
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--foreground);
            margin-bottom: 1.5rem;
        }
        @media (min-width: 768px) {
            .section-title { font-size: 3rem; }
        }
        .text-gradient {
            background: linear-gradient(135deg, var(--leaf) 0%, #3d5a80 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .section-desc {
            font-size: 1.125rem;
            color: #6c757d;
            max-width: 650px;
            /* margin: 0 auto 4rem; */
            line-height: 1.6;
        }
        .section-desc1 {
            font-size: 1.125rem;
            color: #6c757d;
            max-width: 650px;
            margin: 0 auto 4rem;
            line-height: 1.6;
        }
        .benefit-card {
            background-color: #ffffff; /* Card bg from original was var(--card) which is 95% lightness, using white for clean look or slightly off-white */
            background-color: #faf9f6; /* Matching closely to --card: 45 25% 95% */
            border: 1px solid rgba(46, 38, 31, 0.1);
            border-radius: 1rem;
            padding: 2rem;
            transition: all 0.3s ease;
            height: 100%;
        }
        .benefit-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px -8px rgba(46, 38, 31, 0.15); /* shadow-elevated */
        }
        .icon-box {
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 0.75rem;
            background: linear-gradient(135deg, var(--leaf) 0%, #4a6fa5 100%); /* hero-gradient approximation */
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            color: white;
            font-size: 1.5rem;
            transition: transform 0.3s ease;
        }
        .benefit-card:hover .icon-box {
            transform: scale(1.1);
        }
        .benefit-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--foreground);
            margin-bottom: 0.75rem;
        }
        .benefit-text {
            color: #6c757d; /* muted-foreground */
            line-height: 1.6;
            margin-bottom: 0;
        }
    </style>
    <section class="benefits-section" id="benefits">
        <div class="container">
            <!-- Section Header -->
            <div class="text-center mb-5">
                <span class="section-tag">Why Choose Us</span>
                <h2 class="section-title">
                    Benefits of <span class="section-title text-gradient">Vermicompost</span>
                </h2>
                <p class="section-desc1">
                    Discover why thousands of farmers and gardeners trust our premium vermicompost for healthier, more productive plants.
                </p>
            </div>

            <!-- Benefits Grid -->
            <div class="row g-4">
                <!-- 1. Organic -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="benefit-card">
                        <div class="icon-box">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <h3 class="benefit-title">100% Organic</h3>
                        <p class="benefit-text">
                            Pure, natural compost made entirely from organic waste materials and earthworm activity.
                        </p>
                    </div>
                </div>

                <!-- 2. Soil Structure -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="benefit-card">
                        <div class="icon-box">
                            <i class="fas fa-tint"></i>
                        </div>
                        <h3 class="benefit-title">Improves Soil Structure</h3>
                        <p class="benefit-text">
                            Enhances water retention and aeration, creating the perfect growing environment.
                        </p>
                    </div>
                </div>

                <!-- 3. Nutrients -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="benefit-card">
                        <div class="icon-box">
                            <i class="fas fa-sun"></i>
                        </div>
                        <h3 class="benefit-title">Rich in Nutrients</h3>
                        <p class="benefit-text">
                            Packed with nitrogen, phosphorus, potassium, and essential micronutrients.
                        </p>
                    </div>
                </div>

                <!-- 4. Disease Resistant -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="benefit-card">
                        <div class="icon-box">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="benefit-title">Disease Resistant</h3>
                        <p class="benefit-text">
                            Natural beneficial microbes help protect plants from soil-borne diseases.
                        </p>
                    </div>
                </div>

                <!-- 5. Eco-Friendly -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="benefit-card">
                        <div class="icon-box">
                            <i class="fas fa-recycle"></i>
                        </div>
                        <h3 class="benefit-title">Eco-Friendly</h3>
                        <p class="benefit-text">
                            Sustainable solution that recycles organic waste into valuable plant food.
                        </p>
                    </div>
                </div>

                <!-- 6. Boosts Yield -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                    <div class="benefit-card">
                        <div class="icon-box">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="benefit-title">Boosts Yield</h3>
                        <p class="benefit-text">
                            Proven to increase crop yields by up to 30% compared to chemical fertilizers.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========================
        WHY CHOOSE US END
    ==========================-->





    <?php
    // Fetch Active Products Directly
    $prod_sql = "SELECT p.*, 
                        (SELECT image_path FROM product_images WHERE product_id = p.id AND is_primary = 1 LIMIT 1) as image,
                        (SELECT price FROM product_variants v2 JOIN product_sizes s2 ON v2.product_size_id = s2.id WHERE s2.product_id = p.id ORDER BY v2.price ASC LIMIT 1) as min_price,
                        (SELECT strike_price FROM product_variants v3 JOIN product_sizes s3 ON v3.product_size_id = s3.id WHERE s3.product_id = p.id ORDER BY v3.price ASC LIMIT 1) as min_strike_price,
                        (SELECT MAX(price) FROM product_variants v4 JOIN product_sizes s4 ON v4.product_size_id = s4.id WHERE s4.product_id = p.id) as max_price
                 FROM products p 
                 WHERE p.status = 'active'
                 ORDER BY p.id DESC LIMIT 8"; 
    $prod_res = $conn->query($prod_sql);

    if ($prod_res->num_rows > 0) {
        ?>
        <!--================================
            ALL PRODUCTS SECTION START
        ==================================-->
        <section class="new_arrival_2 mt_95 mb_95">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-sm-9">
                        <div class="section_heading_2 section_heading">
                            <h3>Our <span>Products</span></h3>
                        </div>
                    </div>
                    <div class="col-xl-6 col-sm-3 d-none d-md-block">
                        <div class="view_all_btn_area">
                            <a class="view_all_btn" href="shop">View all</a>
                        </div>
                    </div>
                </div>
                <div class="row mt_15">
                    <?php
                    while ($prod = $prod_res->fetch_assoc()) {
                        $p_img = !empty($prod['image']) ? "assets/uploads/products/" . $prod['image'] : "assets/images/products/placeholder.png";
                        
                        // Price Display Logic
                        $min_price = $prod['min_price'];
                        $max_price = $prod['max_price'];
                        $strike_price = $prod['min_strike_price'];

                        $price_html = "";

                        if ($min_price === null) {
                            $price_html = "Price Not Available";
                        } else {
                            // If there's a range
                            if ($max_price > $min_price) {
                                // Show "From ₹XXX" or "₹XXX - ₹YYY"
                                // If strike price exists for the min price variant, show it?
                                // Usually ranges don't show strike price well, but let's try:
                                if ($strike_price > $min_price) {
                                    $price_html = "<span class='text-decoration-line-through text-muted me-2' style='font-size: 0.9em;'>" . format_price($strike_price) . "</span>" . format_price($min_price) . " - " . format_price($max_price);
                                } else {
                                    $price_html = format_price($min_price) . " - " . format_price($max_price);
                                }
                            } else {
                                // Single price
                                if ($strike_price > $min_price) {
                                    $price_html = "<span class='text-decoration-line-through text-muted me-2' style='font-size: 0.9em;'>" . format_price($strike_price) . "</span>" . format_price($min_price);
                                } else {
                                    $price_html = format_price($min_price);
                                }
                            }
                        }
                        ?>
                        <div class="col-xl-3 col-6 col-md-4 wow fadeInUp">
                            <div class="product_item_2 product_item">
                                <div class="product_img">
                                    <img src="<?php echo $p_img; ?>" alt="<?php echo htmlspecialchars($prod['name']); ?>"
                                        class="img-fluid w-100">
                                </div>
                                <div class="product_text">
                                    <a class="title"
                                        href="shop-details?id=<?php echo $prod['id']; ?>"><?php echo htmlspecialchars($prod['name']); ?></a>
                                    <p class="price"><?php echo $price_html; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="row d-md-none mt-3">
                    <div class="col-12">
                        <div class="view_all_btn_area justify-content-center">
                            <a class="view_all_btn" href="shop">View all</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php
    } // End if products > 0
    ?>

    <!--=========================
        HOW IT WORKS SECTION START
    ==========================-->
    <style>
        .process-section {
            padding: 5rem 0 8rem;
            background-color: var(--background); /* white */
        }
        .step-circle {
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--leaf) 0%, #4a6fa5 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-family: 'Playfair Display', serif;
            font-size: 1.125rem; /* text-lg */
            font-weight: 700;
            flex-shrink: 0;
            transition: transform 0.3s ease;
        }
        .step-item:hover .step-circle {
            transform: scale(1.1);
        }
        .step-content {
            flex: 1;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e2e8f0; /* border-color */
        }
        .step-item:last-child .step-content {
            border-bottom: none;
            padding-bottom: 0;
        }
        .step-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem; /* text-xl */
            font-weight: 600;
            color: var(--foreground);
            margin-bottom: 0.5rem;
        }
        .step-desc {
            color: #6c757d; /* muted-foreground */
            margin-bottom: 0;
            line-height: 1.6;
        }
        .process-image-container {
            position: relative;
        }
        .main-img {
            border-radius: 1rem;
            box-shadow: 0 12px 40px -8px rgba(46, 38, 31, 0.15);
            width: 100%;
        }
        .overlay-img {
            position: absolute;
            bottom: -2.5rem;
            left: -2.5rem;
            width: 12rem !important;
            height: 12rem !important;
            object-fit: cover;
            border-radius: 1rem;
            border: 4px solid #ffffff;
            box-shadow: 0 12px 40px -8px rgba(46, 38, 31, 0.15);
        }
        @media (max-width: 768px) {
            .overlay-img {
                display: none;
            }
            .process-image-container {
                margin-top: 3rem;
            }
        }
    </style>
    <section class="process-section" id="process">
        <div class="container">
            <div class="row align-items-center g-5">
                <!-- Left Content -->
                <div class="col-lg-6">
                    <span class="section-tag">How It Works</span>
                    <h2 class="section-title">
                        From Waste to <span class="section-title text-gradient">Wonder</span>
                    </h2>
                    <p class="section-desc mb-5">
                        Our meticulous process ensures every bag of vermicompost meets the highest quality standards for your plants.
                    </p>

                    <div class="step-list">
                        <!-- Step 1 -->
                        <div class="d-flex gap-4 step-item mb-4">
                            <div class="step-circle">01</div>
                            <div class="step-content">
                                <h3 class="step-title">Collection</h3>
                                <p class="step-desc">We collect organic waste materials from sustainable sources - kitchen scraps, agricultural residues, and green waste.</p>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="d-flex gap-4 step-item mb-4">
                            <div class="step-circle">02</div>
                            <div class="step-content">
                                <h3 class="step-title">Composting</h3>
                                <p class="step-desc">The organic matter is fed to thousands of red wiggler earthworms in controlled vermicomposting beds.</p>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="d-flex gap-4 step-item mb-4">
                            <div class="step-circle">03</div>
                            <div class="step-content">
                                <h3 class="step-title">Processing</h3>
                                <p class="step-desc">Worms break down the material over 60-90 days, creating nutrient-rich castings full of beneficial microbes.</p>
                            </div>
                        </div>

                        <!-- Step 4 -->
                        <div class="d-flex gap-4 step-item">
                            <div class="step-circle">04</div>
                            <div class="step-content">
                                <h3 class="step-title">Quality Check</h3>
                                <p class="step-desc">Each batch is tested for nutrient content, pH balance, and pathogen-free certification before packaging.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Images -->
                <div class="col-lg-6">
                    <div class="process-image-container">
                        <img src="assets/images/vermicompost-hands.jpg" alt="Rich Vermicompost" class="main-img img-fluid">
                        <img src="assets/images/healthy-garden.jpg" alt="Healthy Garden" class="overlay-img d-none d-md-block">
                        
                        <!-- Decorative Circles (optional) -->
                        <div style="position: absolute; top: -1.5rem; right: -1.5rem; width: 8rem; height: 8rem; border-radius: 50%; background: rgba(45, 134, 89, 0.1); filter: blur(40px); z-index: -1;"></div>
                        <div style="position: absolute; bottom: -1.5rem; right: 25%; width: 6rem; height: 6rem; border-radius: 50%; background: rgba(230, 184, 0, 0.1); filter: blur(30px); z-index: -1;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!--=========================
        TESTIMONIALS SECTION START
    ==========================-->
    <style>
        .testimonial-section {
            padding: 5rem 0 8rem;
            background-color: var(--foreground); /* Dark background */
            color: var(--primary-foreground);
        }
        .testimonial-tag {
            color: #d4eeda; /* earth-light approx */
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .testimonial-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem; /* text-4xl */
            font-weight: 700;
            margin-top: 1rem;
            margin-bottom: 1.5rem;
            color: var(--primary-foreground);
        }
        .testimonial-desc {
            color: rgba(252, 251, 244, 0.7); /* primary-foreground/70 */
            font-size: 1.125rem;
            max-width: 42rem;
            margin: 0 auto 4rem;
        }
        .testimonial-card {
            background-color: rgba(255, 255, 255, 0.1); /* backdrop-blur equivalent */
            backdrop-filter: blur(4px);
            border: 1px solid rgba(252, 251, 244, 0.1);
            border-radius: 1rem;
            padding: 2rem;
            transition: all 0.3s ease;
            height: 100%;
        }
        .testimonial-card:hover {
            background-color: rgba(255, 255, 255, 0.15);
        }
        .quote-icon {
            color: #ccecd9; /* leaf-light */
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            opacity: 0.8;
        }
        .star-rating {
            display: flex;
            gap: 0.25rem;
            margin-bottom: 1rem;
        }
        .star-icon {
            color: var(--gold);
            font-size: 1rem;
        }
        .testimonial-text {
            color: rgba(252, 251, 244, 0.9);
            line-height: 1.7;
            margin-bottom: 1.5rem;
            font-style: italic;
        }
        .author-name {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            color: var(--primary-foreground);
            font-size: 1.1rem;
        }
        .author-role {
            font-size: 0.875rem;
            color: rgba(252, 251, 244, 0.6);
        }
        
        /* Slick Slider Customization */
        .slick-dots {
            display: flex;
            justify-content: center;
            padding: 0;
            margin: 2rem 0 0;
            list-style: none;
            gap: 0.5rem;
        }
        .slick-dots li button {
            font-size: 0;
            line-height: 0;
            display: block;
            width: 12px;
            height: 12px;
            padding: 5px;
            cursor: pointer;
            color: transparent;
            border: 0;
            outline: none;
            background: rgba(252, 251, 244, 0.2);
            border-radius: 50%;
            transition: all 0.3s ease;
        }
        .slick-dots li.slick-active button {
            background: var(--gold);
            transform: scale(1.2);
        }
        
        /* Gap between slides */
        .testi_slider .slick-slide {
            margin: 0 1rem; /* Adds gap */
        }
        /* Fix slider row overflow showing scrollbar sometimes */
        .testi_slider.slick-slider {
            margin-left: -1rem;
            margin-right: -1rem;
        }
    </style>
    <section class="testimonial-section" id="testimonials">
        <div class="container">
            <!-- Section Header -->
            <div class="text-center mb-5">
                <span class="testimonial-tag">Testimonials</span>
                <h2 class="testimonial-title">
                    Loved by Farmers & Gardeners
                </h2>
                <p class="testimonial-desc">
                    See what our customers have to say about their experience with Vermi Compost.
                </p>
            </div>

            <!-- Testimonials Grid -->
            <div class="row testi_slider">
                <!-- Testimonial 1 -->
                <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="testimonial-card">
                        <div class="quote-icon">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <div class="star-rating">
                            <i class="fas fa-star star-icon"></i>
                            <i class="fas fa-star star-icon"></i>
                            <i class="fas fa-star star-icon"></i>
                            <i class="fas fa-star star-icon"></i>
                            <i class="fas fa-star star-icon"></i>
                        </div>
                        <p class="testimonial-text">
                            "I've been using Vermi Compost for 3 years now. My crop yields have increased by 40% and the soil quality has improved dramatically. This is truly nature's gold!"
                        </p>
                        <div>
                            <div class="author-name">Ramesh Patel</div>
                            <div class="author-role">Organic Farmer, Gujarat</div>
                        </div>
                    </div>
                </div>
              

                <!-- Testimonial 2 -->
                <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="testimonial-card">
                        <div class="quote-icon">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <div class="star-rating">
                            <i class="fas fa-star star-icon"></i>
                            <i class="fas fa-star star-icon"></i>
                            <i class="fas fa-star star-icon"></i>
                            <i class="fas fa-star star-icon"></i>
                            <i class="fas fa-star star-icon"></i>
                        </div>
                        <p class="testimonial-text">
                            "My terrace garden has never looked better! The vegetables are healthier, tastier, and I feel good knowing I'm using a sustainable product. Highly recommend!"
                        </p>
                        <div>
                            <div class="author-name">Priya Sharma</div>
                            <div class="author-role">Home Gardener, Mumbai</div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="testimonial-card">
                        <div class="quote-icon">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <div class="star-rating">
                            <i class="fas fa-star star-icon"></i>
                            <i class="fas fa-star star-icon"></i>
                            <i class="fas fa-star star-icon"></i>
                            <i class="fas fa-star star-icon"></i>
                            <i class="fas fa-star star-icon"></i>
                        </div>
                        <p class="testimonial-text">
                            "As a professional, I need consistent quality and this compost delivers every time. My customers love the results and keep coming back for more plants."
                        </p>
                        <div>
                            <div class="author-name">Suresh Kumar</div>
                            <div class="author-role">Nursery Owner, Bangalore</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========================
        TESTIMONIALS SECTION END
    ==========================-->
    <!--=========================
        FOOTER 2 START
    ==========================-->
    <?php include("includes/footer.php") ?>
    <!--=========================
        FOOTER 2 END
    ==========================-->


    <!--==========================
        SCROLL BUTTON START
    ===========================-->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!--==========================
        SCROLL BUTTON END
    ===========================-->


    <!--jquery library js-->
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <!--bootstrap js-->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!--font-awesome js-->
    <script src="assets/js/Font-Awesome.js"></script>
    <!--counter js-->
    <script src="assets/js/jquery.waypoints.min.js"></script>
    <script src="assets/js/jquery.countup.min.js"></script>
    <!--nice select js-->
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <!--select 2 js-->
    <script src="assets/js/select2.min.js"></script>
    <!--simply countdown js-->
    <script src="assets/js/simplyCountdown.js"></script>
    <!--slick slider js-->
    <script src="assets/js/slick.min.js"></script>
    <!--venobox js-->
    <script src="assets/js/venobox.min.js"></script>
    <!--wow js-->
    <script src="assets/js/wow.min.js"></script>
    <!--marquee js-->
    <script src="assets/js/jquery.marquee.min.js"></script>
    <!--pws tabs js-->
    <script src="assets/js/jquery.pwstabs.min.js"></script>
    <!--scroll button js-->
    <script src="assets/js/scroll_button.js"></script>
    <!--youtube background js-->
    <script src="assets/js/jquery.youtube-background.min.js"></script>
    <!--range slider js-->
    <script src="assets/js/range_slider.js"></script>
    <!--sticky sidebar js-->
    <script src="assets/js/sticky_sidebar.js"></script>
    <!--multiple image upload js-->
    <script src="assets/js/multiple-image-video.js"></script>
    <!--animated barfiller js-->
    <script src="assets/js/animated_barfiller.js"></script>
    <!--main/custom js-->
    <script src="assets/js/custom.js"></script>

    <script>
        // Visits Counter Script
        document.addEventListener("DOMContentLoaded", () => {
            const counterElement = document.getElementById("visit_counter");
            if (counterElement) {
                let visits = localStorage.getItem("total_visits");

                // Initialize or parse visits
                if (!visits) {
                    visits = 20000;
                } else {
                    visits = parseInt(visits, 10);
                    if (isNaN(visits)) visits = 20000;
                }

                // Function to update display
                const updateDisplay = () => {
                    counterElement.innerText = visits.toLocaleString('en-IN');
                };

                updateDisplay();

                // Simulate increasing visits
                setInterval(() => {
                    const increment = Math.floor(Math.random() * 3) + 1;
                    visits += increment;
                    localStorage.setItem("total_visits", visits);
                    updateDisplay();
                }, 2500);
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            fetch("https://api.exchangerate-api.com/v4/latest/USD")
                .then(res => res.json())
                .then(data => {
                    const rate = data.rates.INR;
                    convertDollarToRupee(rate);
                })
                .catch(err => console.error("Currency API Error:", err));
        });

        function convertDollarToRupee(rate) {
            // Select ALL text nodes containing $
            const walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT);

            let node;
            while (node = walker.nextNode()) {
                if (node.nodeValue.includes("$")) {
                    node.nodeValue = node.nodeValue.replace(/\$(\d+(\.\d+)?)/g, (match, amount) => {
                        return "₹" + (parseFloat(amount) * rate).toFixed(2);
                    });
                }
            }
        }
    </script>




</body>

</html>
