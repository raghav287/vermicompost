<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'admin/db.php';
include 'includes/price_helper.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    <title>About Us - Vermi Compost</title>
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
    
    <style>
        .about_text_2 p {
            margin-bottom: 20px;
            line-height: 1.8;
            color: #555;
        }
        .about_text_2 h2 {
            margin-bottom: 25px;
            color: var(--colorPc);
        }
        .mission-vision-card {
            background: #f9f9f9;
            padding: 40px;
            border-radius: 10px;
            height: 100%;
            transition: all 0.3s ease;
            border: 1px solid #eee;
        }
        .mission-vision-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            border-color: var(--colorPc);
        }
        .mission-vision-card i {
            font-size: 40px;
            color: var(--colorPc);
            margin-bottom: 20px;
            display: inline-block;
        }
        .mission-vision-card h3 {
            margin-bottom: 15px;
            font-size: 24px;
        }
    </style>
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
        PAGE BANNER START
    ==========================-->
    <section class="page_banner" style="background: url(assets/images/background/breadcrumb-bg.jpg);">
        <div class="page_banner_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="page_banner_text wow fadeInUp">
                            <h1>About Us</h1>
                            <ul>
                                <li><a href="index"><i class="fal fa-home-lg"></i> Home</a></li>
                                <li><a href="#">About Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========================
        PAGE BANNER END
    ==========================-->


    <!--=========================
        ABOUT US START
    ==========================-->
    <!--=========================
        ABOUT US START
    ==========================-->


    <!-- MISSION SECTION -->
    <section class="about_mission pt_100 pb_100 xs_pt_70 xs_pb_70" style="overflow: hidden;">
        <div class="container">
            <div class="row align-items-center gx-lg-5">
                <div class="col-xl-6 col-lg-6 mb-5 mb-lg-0 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="about_text_2">
                        <span class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill mb-4" 
                              style="background: rgba(139, 69, 19, 0.1); color: #8B4513; font-size: 0.85em; font-weight: 600; border: 1px solid rgba(139, 69, 19, 0.2);">
                            <!-- Earth color approximation #8B4513 -->
                            <i class="fas fa-bullseye"></i> Our Mission
                        </span>
                        <div class="section_heading section_heading_left mb_30">
                            <h2 style="font-size: 3rem; line-height: 1.2;">Empowering Sustainable Agriculture</h2>
                        </div>
                        <p style="font-size: 1.1rem; color: #666; line-height: 1.8; margin-bottom: 25px;">
                            At Vermi Compost, our mission is to provide farmers and gardeners with the highest quality organic vermicompost, enabling them to grow healthier crops while protecting our environment. We believe that sustainable farming practices are not just good for the planet—they're essential for our future.
                        </p>
                        <p style="font-size: 1.1rem; color: #666; line-height: 1.8; margin-bottom: 35px;">
                            Through innovative vermiculture techniques and a commitment to excellence, we're helping transform the way people think about soil health and organic gardening. Every bag of Vermi Compost represents our dedication to quality, sustainability, and the well-being of our customers.
                        </p>
                        
                        <div class="d-flex flex-wrap gap-3">
                            <div class="d-flex align-items-center px-3 py-2 rounded-pill" style="background: rgba(var(--leaf-rgb), 0.05); border: 1px solid rgba(var(--leaf-rgb), 0.2);">
                                <i class="fas fa-shield-alt me-2" style="color: var(--leaf);"></i>
                                <span style="font-weight: 500; font-size: 0.9rem; color: #222;">USDA Organic</span>
                            </div>
                            <div class="d-flex align-items-center px-3 py-2 rounded-pill" style="background: rgba(var(--leaf-rgb), 0.05); border: 1px solid rgba(var(--leaf-rgb), 0.2);">
                                <i class="fas fa-check-circle me-2" style="color: var(--leaf);"></i>
                                <span style="font-weight: 500; font-size: 0.9rem; color: #222;">India Organic</span>
                            </div>
                            <div class="d-flex align-items-center px-3 py-2 rounded-pill" style="background: rgba(var(--leaf-rgb), 0.05); border: 1px solid rgba(var(--leaf-rgb), 0.2);">
                                <i class="fas fa-award me-2" style="color: var(--leaf);"></i>
                                <span style="font-weight: 500; font-size: 0.9rem; color: #222;">ISO 9001:2015</span>
                            </div>
                            <div class="d-flex align-items-center px-3 py-2 rounded-pill" style="background: rgba(var(--leaf-rgb), 0.05); border: 1px solid rgba(var(--leaf-rgb), 0.2);">
                                <i class="fas fa-star me-2" style="color: var(--leaf);"></i>
                                <span style="font-weight: 500; font-size: 0.9rem; color: #222;">FSSAI Approved</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                    <div class="position-relative">
                        <!-- Glow Effect -->
                        <div style="position: absolute; top: -20px; left: -20px; right: -20px; bottom: -20px; background: linear-gradient(135deg, rgba(var(--leaf-rgb), 0.2), rgba(139, 69, 19, 0.2)); filter: blur(40px); border-radius: 2rem; z-index: -1;"></div>
                        
                        <div class="about_img_2 position-relative" style="border-radius: 1.5rem; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);">
                            <img src="assets/images/vermicompost-hands.jpg" alt="Mission" class="img-fluid w-100" style="height: 500px; object-fit: cover;">
                            
                            <div class="position-absolute w-100" style="bottom: 0; left: 0; background: linear-gradient(to top, rgba(0,0,0,0.4), transparent); height: 50%;"></div>
                            
                            <div class="position-absolute" style="bottom: 24px; left: 24px; right: 24px;">
                                <div class="bg-white p-4" style="border-radius: 1rem; background: rgba(255,255,255,0.9); backdrop-filter: blur(4px); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);">
                                    <p class="mb-0" style="font-weight: 600; color: #1a1a1a; font-size: 0.95rem;">"Nurturing the earth, one handful at a time"</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========================
        ABOUT US END
    ==========================-->


    <!-- VALUES SECTION -->
    <section class="about_values pt_100 pb_100 xs_pt_70 xs_pb_70" style="background: linear-gradient(to bottom, #f8f9fa, #fff);">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb_50">
                    <span class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill mb-3" 
                          style="background: hsla(142, 45%, 28%, 0.1); color: hsl(142, 45%, 28%); font-size: 0.85em; font-weight: 600; border: 1px solid hsla(142, 45%, 28%, 0.2);">
                        <i class="fas fa-heart"></i> What We Stand For
                    </span>
                    <h2 class="section_heading_2" style="font-size: 2.5rem; color: hsl(142, 45%, 28%);">Our Core Values</h2>
                    <p style="color: #666; max-width: 700px; margin: 0 auto;">These principles guide everything we do at Vermi Compost, from production to customer service.</p>
                </div>
            </div>
            <div class="row">
                <!-- Sustainability -->
                <div class="col-xl-3 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="value_card p-4 rounded-4 bg-white h-100 position-relative" 
                         style="border: 1px solid #eee; transition: all 0.3s ease; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.03);">
                         
                        <div class="position-absolute" style="top: 0; right: 0; width: 8rem; height: 8rem; background: hsla(142, 45%, 28%, 0.05); border-radius: 50%; filter: blur(24px); pointer-events: none;"></div>

                        <div class="icon_box mb-4 d-inline-flex align-items-center justify-content-center rounded-3" 
                             style="width: 64px; height: 64px; background: linear-gradient(135deg, hsl(142, 45%, 28%), hsl(30, 45%, 25%)); color: white; font-size: 32px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <h4 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 10px; color: hsl(30, 20%, 15%);">Sustainability</h4>
                        <p style="color: #666; font-size: 0.95rem; line-height: 1.6;">Eco-friendly practices protecting our planet for future generations through organic recycling.</p>
                    </div>
                </div>
                <!-- Quality -->
                <div class="col-xl-3 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="value_card p-4 rounded-4 bg-white h-100 position-relative" 
                         style="border: 1px solid #eee; transition: all 0.3s ease; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.03);">
                         
                        <div class="position-absolute" style="top: 0; right: 0; width: 8rem; height: 8rem; background: hsla(142, 45%, 28%, 0.05); border-radius: 50%; filter: blur(24px); pointer-events: none;"></div>

                        <div class="icon_box mb-4 d-inline-flex align-items-center justify-content-center rounded-3" 
                             style="width: 64px; height: 64px; background: linear-gradient(135deg, hsl(142, 45%, 28%), hsl(30, 45%, 25%)); color: white; font-size: 32px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h4 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 10px; color: hsl(30, 20%, 15%);">Quality</h4>
                        <p style="color: #666; font-size: 0.95rem; line-height: 1.6;">Every batch of vermicompost meets the highest standards of excellence and purity.</p>
                    </div>
                </div>
                <!-- Community -->
                <div class="col-xl-3 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="value_card p-4 rounded-4 bg-white h-100 position-relative" 
                         style="border: 1px solid #eee; transition: all 0.3s ease; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.03);">
                         
                        <div class="position-absolute" style="top: 0; right: 0; width: 8rem; height: 8rem; background: hsla(142, 45%, 28%, 0.05); border-radius: 50%; filter: blur(24px); pointer-events: none;"></div>
                        
                        <div class="icon_box mb-4 d-inline-flex align-items-center justify-content-center rounded-3" 
                             style="width: 64px; height: 64px; background: linear-gradient(135deg, hsl(142, 45%, 28%), hsl(30, 45%, 25%)); color: white; font-size: 32px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 10px; color: hsl(30, 20%, 15%);">Community</h4>
                        <p style="color: #666; font-size: 0.95rem; line-height: 1.6;">Building strong, lasting relationships with farmers and gardeners worldwide.</p>
                    </div>
                </div>
                <!-- Innovation -->
                <div class="col-xl-3 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="value_card p-4 rounded-4 bg-white h-100 position-relative" 
                         style="border: 1px solid #eee; transition: all 0.3s ease; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.03);">
                         
                        <div class="position-absolute" style="top: 0; right: 0; width: 8rem; height: 8rem; background: hsla(142, 45%, 28%, 0.05); border-radius: 50%; filter: blur(24px); pointer-events: none;"></div>
                        
                        <div class="icon_box mb-4 d-inline-flex align-items-center justify-content-center rounded-3" 
                             style="width: 64px; height: 64px; background: linear-gradient(135deg, hsl(142, 45%, 28%), hsl(30, 45%, 25%)); color: white; font-size: 32px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);">
                            <i class="fas fa-award"></i>
                        </div>
                        <h4 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 10px; color: hsl(30, 20%, 15%);">Innovation</h4>
                        <p style="color: #666; font-size: 0.95rem; line-height: 1.6;">Constantly improving to deliver the best organic solutions for modern agriculture.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .value_card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.08) !important;
            border-color: hsla(142, 45%, 28%, 0.4) !important;
        }
    </style>

    <!-- WHAT SETS US APART SECTION -->
    <section class="about_story pt_100 pb_100 xs_pt_70 xs_pb_70" style="overflow: hidden;">
        <div class="container">
            <div class="row align-items-center gx-lg-5">
                <div class="col-lg-6 mb-5 mb-lg-0 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="position-relative">
                        <!-- Glow Effect -->
                        <div style="position: absolute; -inset: 1.5rem; background: linear-gradient(135deg, hsla(30, 45%, 25%, 0.2), hsla(142, 45%, 28%, 0.2)); filter: blur(40px); border-radius: 2rem; z-index: -1;"></div>
                        
                        <div class="position-relative rounded-4 overflow-hidden shadow-lg">
                            <img src="assets/images/healthy-garden.jpg" alt="Healthy garden" class="img-fluid w-100" style="height: 500px !important; object-fit: cover;">
                            <div class="position-absolute w-100" style="bottom: 0; left: 0; background: linear-gradient(to top, rgba(0,0,0,0.4), transparent); height: 50%;"></div>
                        </div>

                        <!-- Floating stats card -->
                        <div class="position-absolute bg-white p-4 rounded-4 shadow-lg border" 
                             style="bottom: -24px; right: -24px; border-color: #eee; max-width: 240px; z-index: 2;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="d-flex align-items-center justify-content-center rounded-3" 
                                     style="width: 56px; height: 56px; background: linear-gradient(135deg, hsl(142, 45%, 28%), hsl(30, 45%, 25%)); color: white; font-size: 24px;">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <div>
                                    <div style="font-size: 1.5rem; font-weight: 700; color: #1a1a1a;">98%</div>
                                    <div style="font-size: 0.85rem; color: #666; line-height: 1.2;">Customer Satisfaction</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                    <div class="about_text_2 ps-lg-4">
                        <span class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill mb-4" 
                              style="background: hsla(142, 45%, 28%, 0.1); color: hsl(142, 45%, 28%); font-size: 0.85em; font-weight: 600; border: 1px solid hsla(142, 45%, 28%, 0.2);">
                            <i class="fas fa-seedling"></i> Why Choose Us
                        </span>
                        <h2 class="section_heading_2 mb-5" style="font-size: 2.5rem; color: #1a1a1a;">What Sets Us Apart</h2>
                        
                        <div class="d-flex flex-column gap-4">
                            <!-- Feature 1 -->
                            <div class="d-flex gap-4">
                                <div class="d-flex align-items-center justify-content-center flex-shrink-0 rounded-3" 
                                     style="width: 48px; height: 48px; background: hsla(142, 45%, 28%, 0.1); color: hsl(142, 45%, 28%); font-size: 20px;">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h3 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 5px; color: #1a1a1a;">Premium Quality Control</h3>
                                    <p style="color: #666; font-size: 0.95rem; margin: 0;">Every batch is tested in our lab to ensure consistent nutrient content and purity.</p>
                                </div>
                            </div>

                            <!-- Feature 2 -->
                            <div class="d-flex gap-4">
                                <div class="d-flex align-items-center justify-content-center flex-shrink-0 rounded-3" 
                                     style="width: 48px; height: 48px; background: hsla(142, 45%, 28%, 0.1); color: hsl(142, 45%, 28%); font-size: 20px;">
                                    <i class="fas fa-wind"></i>
                                </div>
                                <div>
                                    <h3 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 5px; color: #1a1a1a;">Odor-Free Processing</h3>
                                    <p style="color: #666; font-size: 0.95rem; margin: 0;">Our advanced techniques produce clean, earthy-smelling compost perfect for indoor use.</p>
                                </div>
                            </div>

                            <!-- Feature 3 -->
                            <div class="d-flex gap-4">
                                <div class="d-flex align-items-center justify-content-center flex-shrink-0 rounded-3" 
                                     style="width: 48px; height: 48px; background: hsla(142, 45%, 28%, 0.1); color: hsl(142, 45%, 28%); font-size: 20px;">
                                    <i class="fas fa-globe-asia"></i>
                                </div>
                                <div>
                                    <h3 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 5px; color: #1a1a1a;">Nationwide Delivery</h3>
                                    <p style="color: #666; font-size: 0.95rem; margin: 0;">Fast, reliable shipping to all states with eco-friendly packaging materials.</p>
                                </div>
                            </div>

                            <!-- Feature 4 -->
                            <div class="d-flex gap-4">
                                <div class="d-flex align-items-center justify-content-center flex-shrink-0 rounded-3" 
                                     style="width: 48px; height: 48px; background: hsla(142, 45%, 28%, 0.1); color: hsl(142, 45%, 28%); font-size: 20px;">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div>
                                    <h3 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 5px; color: #1a1a1a;">Expert Support</h3>
                                    <p style="color: #666; font-size: 0.95rem; margin: 0;">Our team of agricultural experts is available to guide you on best practices.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ SECTION -->
    <section class="about_faq pt_100 pb_100 xs_pt_70 xs_pb_70" style="background-color: #f9f9f9;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb_50">
                    <span class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill mb-3" 
                          style="background: hsla(142, 45%, 28%, 0.1); color: hsl(142, 45%, 28%); font-size: 0.85em; font-weight: 600; border: 1px solid hsla(142, 45%, 28%, 0.2);">
                        <i class="fas fa-question-circle"></i> Common Questions
                    </span>
                    <h2 class="section_heading_2" style="font-size: 2.5rem; color: #1a1a1a;">Frequently Asked Questions</h2>
                    <p style="color: #666; max-width: 700px; margin: 0 auto;">Find answers to the most common questions about our products and services</p>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="faq_area">
                        <!-- FAQ 1 -->
                        <div class="faq_item mb-3 wow fadeInUp" data-wow-delay="0.1s" style="background: #fff; border-radius: 15px; border: 1px solid #eee; overflow: hidden; transition: all 0.3s ease;">
                             <div class="faq_question p-4 d-flex align-items-center justify-content-between" style="cursor: pointer;">
                                <h3 style="font-size: 1.1rem; font-weight: 600; color: #1a1a1a; margin: 0; display: flex; align-items: center; gap: 15px;">
                                    <span style="width: 24px; height: 24px; background: hsla(142, 45%, 28%, 0.1); color: hsl(142, 45%, 28%); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700;">1</span>
                                    What makes VermiGold different from other composts?
                                </h3>
                            </div>
                            <div class="faq_answer p-4 pt-0" style="color: #666; line-height: 1.6;">
                                <p class="mb-0">VermiGold is 100% pure vermicompost produced by red wiggler earthworms. Unlike regular compost, it contains beneficial microbes, humic acids, and plant growth hormones that dramatically improve soil health and plant growth.</p>
                            </div>
                        </div>

                        <!-- FAQ 2 -->
                        <div class="faq_item mb-3 wow fadeInUp" data-wow-delay="0.2s" style="background: #fff; border-radius: 15px; border: 1px solid #eee; overflow: hidden; transition: all 0.3s ease;">
                             <div class="faq_question p-4 d-flex align-items-center justify-content-between" style="cursor: pointer;">
                                <h3 style="font-size: 1.1rem; font-weight: 600; color: #1a1a1a; margin: 0; display: flex; align-items: center; gap: 15px;">
                                    <span style="width: 24px; height: 24px; background: hsla(142, 45%, 28%, 0.1); color: hsl(142, 45%, 28%); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700;">2</span>
                                    How long does vermicompost take to show results?
                                </h3>
                            </div>
                            <div class="faq_answer p-4 pt-0" style="color: #666; line-height: 1.6;">
                                <p class="mb-0">Most gardeners notice improved plant health within 2-4 weeks of application. For best results, we recommend regular application every 4-6 weeks during the growing season.</p>
                            </div>
                        </div>

                        <!-- FAQ 3 -->
                        <div class="faq_item mb-3 wow fadeInUp" data-wow-delay="0.3s" style="background: #fff; border-radius: 15px; border: 1px solid #eee; overflow: hidden; transition: all 0.3s ease;">
                             <div class="faq_question p-4 d-flex align-items-center justify-content-between" style="cursor: pointer;">
                                <h3 style="font-size: 1.1rem; font-weight: 600; color: #1a1a1a; margin: 0; display: flex; align-items: center; gap: 15px;">
                                    <span style="width: 24px; height: 24px; background: hsla(142, 45%, 28%, 0.1); color: hsl(142, 45%, 28%); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700;">3</span>
                                    Is vermicompost safe for all plants?
                                </h3>
                            </div>
                            <div class="faq_answer p-4 pt-0" style="color: #666; line-height: 1.6;">
                                <p class="mb-0">Yes! Our vermicompost is gentle yet effective for all plants including vegetables, fruits, flowers, and ornamentals. It won't burn roots like synthetic fertilizers.</p>
                            </div>
                        </div>

                        <!-- FAQ 4 -->
                        <div class="faq_item mb-3 wow fadeInUp" data-wow-delay="0.4s" style="background: #fff; border-radius: 15px; border: 1px solid #eee; overflow: hidden; transition: all 0.3s ease;">
                             <div class="faq_question p-4 d-flex align-items-center justify-content-between" style="cursor: pointer;">
                                <h3 style="font-size: 1.1rem; font-weight: 600; color: #1a1a1a; margin: 0; display: flex; align-items: center; gap: 15px;">
                                    <span style="width: 24px; height: 24px; background: hsla(142, 45%, 28%, 0.1); color: hsl(142, 45%, 28%); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700;">4</span>
                                    Do you offer bulk orders for farms?
                                </h3>
                            </div>
                            <div class="faq_answer p-4 pt-0" style="color: #666; line-height: 1.6;">
                                <p class="mb-0">Absolutely! We offer special pricing for bulk orders over 500kg. Contact our sales team for custom quotes and delivery arrangements.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!--=========================
        FOOTER START
    ==========================-->
    <?php include("includes/footer.php") ?>
    <!--=========================
        FOOTER END
    ==========================-->


    <!--jquery library js-->
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <!--bootstrap js-->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!--font-awesome js-->
    <script src="assets/js/Font-Awesome.js"></script>
    <!--nice-select js-->
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <!--slick js-->
    <script src="assets/js/slick.min.js"></script>
    <!--venobox js-->
    <script src="assets/js/venobox.min.js"></script>
    <!--animated_barfiller js-->
    <script src="assets/js/animated_barfiller.js"></script>
    <!--wow js-->
    <script src="assets/js/wow.min.js"></script>
    <!--counterup js-->
    <script src="assets/js/jquery.waypoints.min.js"></script>
    <script src="assets/js/jquery.countup.min.js"></script>
    <!--select2 js-->
    <script src="assets/js/select2.min.js"></script>
    <!--range_slider js-->
    <script src="assets/js/range_slider.js"></script>
    <!--isotope js-->
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <!--multiple-image-video js-->
    <script src="assets/js/multiple-image-video.js"></script>
    <!--jquery.pwstabs js-->
    <script src="assets/js/jquery.pwstabs-1.2.1.js"></script>

    <!--main/custom js-->
    <script src="assets/js/custom.js"></script>
</body>

</html>
