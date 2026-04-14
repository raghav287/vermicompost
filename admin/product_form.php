<?php
require_once 'check_session.php';
require_once 'db.php';

$page_title = "Add Product";
$product = null;
$variants = [];
$specs = [];
$images = [];
$all_colors = []; // Distinct colors from variants

if (isset($_GET['id'])) {
    $page_title = "Edit Product";
    $id = intval($_GET['id']);

    // Fetch Product
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();

        // Fetch ALL Variants (flattened, easier to work with)
        $var_sql = "SELECT v.*, s.size as variant_name, s.id as size_id 
                    FROM product_variants v 
                    JOIN product_sizes s ON v.product_size_id = s.id 
                    WHERE s.product_id = $id
                    ORDER BY s.size, v.color";
        $var_result = $conn->query($var_sql);
        while ($row = $var_result->fetch_assoc()) {
            $variants[] = $row;
            if (!empty($row['color']) && !in_array($row['color'], $all_colors)) {
                $all_colors[] = $row['color'];
            }
        }

        // Fetch Specs
        $s_sql = "SELECT * FROM product_specifications WHERE product_id = $id";
        $s_result = $conn->query($s_sql);
        while ($row = $s_result->fetch_assoc())
            $specs[] = $row;

        // Fetch Images (NOW with color column)
        $i_sql = "SELECT * FROM product_images WHERE product_id = $id ORDER BY is_primary DESC, color";
        $i_result = $conn->query($i_sql);
        while ($row = $i_result->fetch_assoc())
            $images[] = $row;
    }
}

// Fetch categories for dropdown
$cat_sql = "SELECT * FROM categories WHERE status='active' ORDER BY name";
$categories_result = $conn->query($cat_sql);
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        <?php echo $page_title; ?> - Admin
    </title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- STYLE CSS -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- Plugins CSS -->
    <link href="assets/css/plugins.css" rel="stylesheet">

    <!--- FONT-ICONS CSS -->
    <link href="assets/css/icons.css" rel="stylesheet">

    <!-- INTERNAL Switcher css -->
    <link href="assets/switcher/css/switcher.css" rel="stylesheet">
    <link href="assets/switcher/demo.css" rel="stylesheet">

    <style>
        .variant-row {
            border-bottom: 1px solid #eee;
            padding: 10px 0;
        }

        .variant-row:hover {
            background: #f8f9fa;
        }

        .image-preview {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
            margin: 5px;
            border-radius: 4px;
        }

        .color-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 8px;
            border-radius: 4px;
            background: #f8f9fa;
            margin: 2px;
        }

        .color-swatch {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid #fff;
            box-shadow: 0 0 0 1px #ddd;
        }

        .add-more-btn {
            margin-top: 10px;
        }

        #variantTable th {
            background: #f8f9fa;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .tab-content {
            min-height: 400px;
        }
    </style>
</head>

<body class="app sidebar-mini ltr light-mode">

    <!-- GLOBAL-LOADER (Commented out - was causing infinite loading) -->
    <!-- <div id="global-loader">
        <img src="assets/images/loader.svg" class="loader-img" alt="Loader">
    </div> -->

    <div class="page">
        <div class="page-main">

            <!-- app-Header -->
            <?php include 'includes/header.php' ?>
            <!-- app-Header -->

            <!--APP-SIDEBAR-->
            <?php include 'includes/sidebar.php' ?>
            <!--/APP-SIDEBAR-->

            <!-- APP-CONTENT OPEN -->
            <div class="main-content app-content mt-0">
                <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <!-- PAGE-HEADER -->
                        <div class="page-header">
                            <h1 class="page-title">
                                <?php echo $page_title; ?>
                            </h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="products.php">Products</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <?php echo $page_title; ?>
                                    </li>
                                </ol>
                            </div>
                        </div>

                        <!-- ACTUAL FORM -->
                        <form action="product_save.php" method="POST" enctype="multipart/form-data" id="productForm">
                            <?php if ($product): ?>
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <?php endif; ?>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Product Information</h3>
                                        </div>
                                        <div class="card-body">

                                            <!-- TABS -->
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#basic"
                                                        role="tab">
                                                        <i class="fe fe-info"></i> Basic Info
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#variants"
                                                        role="tab">
                                                        <i class="fe fe-grid"></i> Variants <span
                                                            class="badge bg-primary" id="variantCount">0</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#images" role="tab">
                                                        <i class="fe fe-image"></i> Images <span
                                                            class="badge bg-success" id="imageCount">0</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#specs" role="tab">
                                                        <i class="fe fe-list"></i> Specifications
                                                    </a>
                                                </li>
                                            </ul>

                                            <div class="tab-content mt-3">

                                                <!-- TAB 1: BASIC INFO -->
                                                <div class="tab-pane active" id="basic" role="tabpanel">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label class="form-label">Product Name <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" name="name"
                                                                    value="<?php echo $product['name'] ?? ''; ?>"
                                                                    required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="form-label">Description</label>
                                                                <textarea class="form-control" name="description"
                                                                    rows="4"><?php echo $product['description'] ?? ''; ?></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <!-- Hidden Category Input (Defaulting to first available or existing) -->
                                                            <?php 
                                                            $default_cat = $product['category_id'] ?? null;
                                                            if (!$default_cat && $categories_result->num_rows > 0) {
                                                                $categories_result->data_seek(0); // Reset pointer
                                                                $first_cat = $categories_result->fetch_assoc();
                                                                $default_cat = $first_cat['id'];
                                                            }
                                                            ?>
                                                            <input type="hidden" name="category_id" value="<?php echo $default_cat; ?>">

                                                            <div class="form-group">
                                                                <label class="form-label">Status</label>
                                                                <select class="form-control" name="status">
                                                                    <option value="active" <?php echo (isset($product['status']) && $product['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                                                                    <option value="inactive" <?php echo (isset($product['status']) && $product['status'] == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- TAB 2: VARIANTS -->
                                                <div class="tab-pane" id="variants" role="tabpanel">
                                                    <div class="mb-3">
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                            onclick="addVariantRow()">
                                                            <i class="fe fe-plus"></i> Add VariantRow
                                                        </button>

                                                    </div>

                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-hover"
                                                            id="variantTable">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 15%">Size</th>

                                                                    <th style="width: 15%">Price</th>
                                                                    <th style="width: 15%">Strike Price</th>
                                                                    <th style="width: 10%">Stock</th>
                                                                    <th style="width: 5%"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="variantTableBody">
                                                                <?php if (!empty($variants)): ?>
                                                                    <?php foreach ($variants as $idx => $v): ?>
                                                                        <tr class="variant-row">
                                                                            <td>
                                                                                <input type="hidden"
                                                                                    name="variants[<?php echo $idx; ?>][id]"
                                                                                    value="<?php echo $v['id']; ?>">
                                                                                <input type="text"
                                                                                    class="form-control form-control-sm"
                                                                                    name="variants[<?php echo $idx; ?>][size]"
                                                                                    value="<?php echo $v['variant_name']; ?>"
                                                                                    placeholder="e.g. 5 kg">
                                                                            </td>

                                                                            <td><input type="number" step="0.01"
                                                                                    class="form-control form-control-sm"
                                                                                    name="variants[<?php echo $idx; ?>][price]"
                                                                                    value="<?php echo $v['price']; ?>"
                                                                                    placeholder="Base price"></td>
                                                                            <td><input type="number" step="0.01"
                                                                                    class="form-control form-control-sm"
                                                                                    name="variants[<?php echo $idx; ?>][strike_price]"
                                                                                    value="<?php echo $v['strike_price']; ?>"
                                                                                    placeholder="Original price"></td>
                                                                            <td><input type="number"
                                                                                    class="form-control form-control-sm"
                                                                                    name="variants[<?php echo $idx; ?>][stock]"
                                                                                    value="<?php echo $v['stock_quantity']; ?>"
                                                                                    placeholder="0"></td>
                                                                            <td><button type="button"
                                                                                    class="btn btn-sm btn-danger"
                                                                                    onclick="removeVariantRow(this)"><i
                                                                                        class="fe fe-trash-2"></i></button></td>
                                                                        </tr>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <!-- TAB 3: IMAGES -->
                                                <div class="tab-pane" id="images" role="tabpanel">
                                                

                                                    <!-- NEW DYNAMIC SECTIONS -->
                                                    <div id="dynamicImageSections">
                                                        <!-- Sections will be generated here by JS -->
                                                    </div>

                                                    <!-- HIDDEN CONTAINER FOR FILE INPUTS -->
                                                    <div id="hiddenUploadContainer" style="display:none;"></div>

                                                    <div class="mb-3">
                                                        <h6>Existing Images (<?php echo count($images); ?>)</h6>
                                                    </div>

                                                    <div id="imageRowsContainer">
                                                        <?php if (!empty($images)): ?>
                                                            <?php foreach ($images as $idx => $img): ?>
                                                                <div class="image-row border p-3 mb-2"
                                                                    data-index="<?php echo $idx; ?>">
                                                                    <div class="row align-items-center">
                                                                        <div class="col-md-3">
                                                                            <img src="../assets/uploads/products/<?php echo $img['image_path']; ?>"
                                                                                class="image-preview border"
                                                                                alt="Product Image">
                                                                            <input type="hidden"
                                                                                name="existing_images[<?php echo $idx; ?>][id]"
                                                                                value="<?php echo $img['id']; ?>">
                                                                            <input type="hidden"
                                                                                name="existing_images[<?php echo $idx; ?>][path]"
                                                                                value="<?php echo $img['image_path']; ?>">
                                                                        </div>
                                                                            <input type="hidden" name="existing_images[<?php echo $idx; ?>][color]" value="">
                                                                        <div class="col-md-2">
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox"
                                                                                    name="existing_images[<?php echo $idx; ?>][is_primary]"
                                                                                    value="1" <?php echo $img['is_primary'] ? 'checked' : ''; ?>>
                                                                                <label class="form-check-label">Primary
                                                                                    Image</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <button type="button" class="btn btn-sm btn-danger"
                                                                                onclick="removeExistingImage(this, <?php echo $img['id']; ?>)">
                                                                                <i class="fe fe-trash-2"></i> Remove
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </div>

                                                    <!-- Hidden field for deleted images -->
                                                    <input type="hidden" id="deletedImages" name="deleted_images"
                                                        value="">
                                                </div>

                                                <!-- TAB 4: SPECIFICATIONS -->
                                                <div class="tab-pane" id="specs" role="tabpanel">
                                                    <div class="mb-3">
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                            onclick="addSpecRow()">
                                                            <i class="fe fe-plus"></i> Add Specification
                                                        </button>
                                                    </div>

                                                    <div id="specRowsContainer">
                                                        <?php if (!empty($specs)): ?>
                                                            <?php foreach ($specs as $idx => $spec): ?>
                                                                <div class="row spec-row mb-2">
                                                                    <div class="col-md-5">
                                                                        <input type="hidden"
                                                                            name="specs[<?php echo $idx; ?>][id]"
                                                                            value="<?php echo $spec['id']; ?>">
                                                                        <input type="text" class="form-control"
                                                                            name="specs[<?php echo $idx; ?>][key]"
                                                                            value="<?php echo $spec['spec_key']; ?>"
                                                                            placeholder="e.g. Moisture">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="text" class="form-control"
                                                                            name="specs[<?php echo $idx; ?>][value]"
                                                                            value="<?php echo $spec['spec_value']; ?>"
                                                                            placeholder="e.g. 15-20%">
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <button type="button" class="btn btn-sm btn-danger"
                                                                            onclick="removeSpecRow(this)"><i
                                                                                class="fe fe-trash-2"></i></button>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="card-footer text-end">
                                            <a href="products.php" class="btn btn-secondary">Cancel</a>
                                            <button type="submit" class="btn btn-primary ms-2">
                                                <i class="fe fe-save"></i> Save Product
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JQUERY JS -->
    <script src="assets/js/jquery.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- SPARKLINE JS-->
    <script src="assets/js/jquery.sparkline.min.js"></script>

    <!-- Sticky js -->
    <script src="assets/js/sticky.js"></script>

    <!-- CHART-CIRCLE JS-->
    <script src="assets/js/circle-progress.min.js"></script>

    <!-- PIETY CHART JS-->
    <script src="assets/plugins/peitychart/jquery.peity.min.js"></script>
    <script src="assets/plugins/peitychart/peitychart.init.js"></script>

    <!-- SIDEBAR JS -->
    <script src="assets/plugins/sidebar/sidebar.js"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="assets/plugins/p-scroll/perfect-scrollbar.js"></script>
    <script src="assets/plugins/p-scroll/pscroll.js"></script>
    <script src="assets/plugins/p-scroll/pscroll-1.js"></script>

    <!-- INTERNAL CHARTJS CHART JS-->
    <script src="assets/plugins/chart/Chart.bundle.js"></script>
    <script src="assets/plugins/chart/utils.js"></script>

    <!-- INTERNAL SELECT2 JS -->
    <script src="assets/plugins/select2/select2.full.min.js"></script>

    <!-- INTERNAL Data tables js-->
    <script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
    <script src="assets/plugins/datatable/dataTables.responsive.min.js"></script>

    <!-- INTERNAL APEXCHART JS -->
    <script src="assets/js/apexcharts.js"></script>
    <script src="assets/plugins/apexchart/irregular-data-series.js"></script>

    <!-- INTERNAL Flot JS -->
    <script src="assets/plugins/flot/jquery.flot.js"></script>
    <script src="assets/plugins/flot/jquery.flot.fillbetween.js"></script>
    <script src="assets/plugins/flot/chart.flot.sampledata.js"></script>
    <script src="assets/plugins/flot/dashboard.sampledata.js"></script>

    <!-- INTERNAL Vector js -->
    <script src="assets/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- SIDE-MENU JS-->
    <script src="assets/plugins/sidemenu/sidemenu.js"></script>

    <!-- TypeHead js -->
    <script src="assets/plugins/bootstrap5-typehead/autocomplete.js"></script>
    <script src="assets/js/typehead.js"></script>

    <!-- INTERNAL INDEX JS -->
    <script src="assets/js/index1.js"></script>

    <!-- Color Theme js -->
    <script src="assets/js/themeColors.js"></script>

    <!-- CUSTOM JS -->
    <script src="assets/js/custom.js"></script>

    <!-- Custom-switcher -->
    <script src="assets/js/custom-swicher.js"></script>

    <!-- Switcher js -->
    <script src="assets/switcher/js/switcher.js"></script>



    <!-- BOOTSTRAP JS -->
    <!-- (Note: Already included at top of body, but assuming standard footer location for custom scripts) -->

    <script>
        $(document).ready(function () {
            $('.select2').select2();
            updateCounts();

            // Bind tab change to refresh sections
            $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
                if (e.target.getAttribute('href') === '#images') {
                    refreshImageSections();
                }
            });
        });

        let variantIndex = <?php echo count($variants); ?>;
        let specIndex = <?php echo count($specs); ?>;
        let imageIndex = <?php echo count($images); ?>;
        let deletedImages = [];

        function addVariantRow() {
            const html = `
            <tr class="variant-row">
                <td><input type="text" class="form-control form-control-sm" name="variants[${variantIndex}][size]" placeholder="e.g. 5 kg" required></td>
                <td><input type="number" step="0.01" class="form-control form-control-sm" name="variants[${variantIndex}][price]" placeholder="Base price" required></td>
                <td><input type="number" step="0.01" class="form-control form-control-sm" name="variants[${variantIndex}][strike_price]" placeholder="Original price"></td>
                <td><input type="number" class="form-control form-control-sm" name="variants[${variantIndex}][stock]" value="0" placeholder="0"></td>
                <td><button type="button" class="btn btn-sm btn-danger" onclick="removeVariantRow(this)"><i class="fe fe-trash-2"></i></button></td>
            </tr>
        `;
            $('#variantTableBody').append(html);
            variantIndex++;
            updateCounts();
        }

        function removeVariantRow(btn) {
            $(btn).closest('tr').fadeOut(300, function () {
                $(this).remove();
                updateCounts();
            });
        }

        function addSpecRow() {
            const html = `
            <div class="row spec-row mb-2">
                <div class="col-md-5">
                    <input type="text" class="form-control" name="specs[${specIndex}][key]" placeholder="e.g. Moisture">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="specs[${specIndex}][value]" placeholder="e.g. 15-20%">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeSpecRow(this)"><i class="fe fe-trash-2"></i></button>
                </div>
            </div>
        `;
            $('#specRowsContainer').append(html);
            specIndex++;
        }

        function removeSpecRow(btn) {
            $(btn).closest('.spec-row').fadeOut(300, function () {
                $(this).remove();
            });
        }



        // --- NEW IMAGE UPLOAD LOGIC ---

        function refreshImageSections() {
            // 1. Get unique colors from Variant Table
            const colors = new Set();
            $('.color-input').each(function () {
                const c = $(this).val().trim();
                // Treat empty color as "Universal/No Color"
                colors.add(c);
            });

            const container = $('#dynamicImageSections');
            // Don't wipe existing inputs, they are in hiddenUploadContainer.
            container.empty();

            // Simple Image Section
            const displayColor = "Product Images";
            const color = ""; 
            const colorCode = 'transparent';

            const sectionHtml = `
                    <div class="card mb-3 border">
                        <div class="card-header bg-light d-flex align-items-center justify-content-between p-2">
                             <div class="d-flex align-items-center">
                                <strong>${displayColor}</strong>
                             </div>
                             <button type="button" class="btn btn-sm btn-primary" onclick="triggerMultiUpload('${color}')">
                                <i class="fe fe-upload"></i> Upload Images
                             </button>
                             
                             <input type="file" id="upload_${color.replace(/\s+/g, '_')}" 
                                    style="display:none" multiple accept="image/*" 
                                    onchange="handleBatchUpload(this, '${color}')">
                        </div>
                        <div class="card-body p-2" id="preview_${color.replace(/\s+/g, '_')}">
                            <div class="text-muted small fst-italic">New images will appear here...</div>
                        </div>
                    </div>
                `;
            container.append(sectionHtml);
        }

        function triggerMultiUpload(color) {
            const safeColor = color.replace(/\s+/g, '_');
            $(`#upload_${safeColor}`).click();
        }

        function handleBatchUpload(input, color) {
            const files = input.files;
            if (files.length === 0) return;

            // CLIENT-SIDE SIZE VALIDATION
            const MAX_BATCH_SIZE_MB = 35; // set lower than server 40MB
            const MAX_BATCH_SIZE_BYTES = MAX_BATCH_SIZE_MB * 1024 * 1024;
            let totalBatchSize = 0;

            Array.from(files).forEach((file) => {
                totalBatchSize += file.size;
            });

            if (totalBatchSize > MAX_BATCH_SIZE_BYTES) {
                alert(`Error: This batch of images is too large (${(totalBatchSize / 1024 / 1024).toFixed(2)} MB). Please upload fewer images at a time. The limit is ${MAX_BATCH_SIZE_MB} MB.`);
                // Reset input
                $(input).val('');
                return;
            }

            const safeColor = color.replace(/\s+/g, '_');
            const previewContainer = $(`#preview_${safeColor}`);

            if (previewContainer.find('.text-muted').length) {
                previewContainer.empty();
            }

            // Generate a batch ID first so we can link previews to it
            // We use imageIndex as a running counter for batch IDs as well, to avoid collisions
            const batchId = imageIndex++;

            Array.from(files).forEach((file, idx) => {
                // Generate preview with remove button
                const reader = new FileReader();
                reader.onload = function (e) {
                    const previewHtml = `
                        <div class="d-inline-block position-relative m-1 border p-1" style="width: 100px;" id="preview_thumb_${batchId}_${idx}">
                            <img src="${e.target.result}" class="img-fluid " style="height: 80px; width: 100%; object-fit: cover;">
                            <div class="small text-truncate text-center mt-1">${file.name}</div>
                            <div class="badge bg-secondary position-absolute top-0 start-0 m-1">${color ? color : 'General'}</div>
                            <button type="button" class="btn btn-danger btn-sm p-0 position-absolute top-0 end-0 " 
                                    style="width: 20px; height: 20px; line-height: 18px;" 
                                    onclick="removeNewUpload(${batchId}, ${idx})">&times;</button>
                        </div>
                    `;
                    previewContainer.append(previewHtml);
                }
                reader.readAsDataURL(file);
            });

            // Hack for "Multiple to Structured Array":
            // We clone the input because we cannot set 'files' property of a new input easily.
            const clone = $(input).clone();
            clone.attr('name', `bulk_uploads[${batchId}][files][]`);
            clone.removeAttr('id'); // remove id to avoid collision
            clone.removeAttr('onchange');
            clone.hide();

            const colorInput = `<input type="hidden" name="bulk_uploads[${batchId}][color]" value="${color}">`;

            $('#hiddenUploadContainer').append(clone);
            $('#hiddenUploadContainer').append(colorInput);

            // Reset the original input for more uploads
            $(input).val('');

            updateCounts();
        }

        function removeNewUpload(batchId, fileIndex) {
            // 1. Remove preview visually
            $(`#preview_thumb_${batchId}_${fileIndex}`).remove();

            // 2. Add hidden input to tell server to ignore this specific file index for this batch
            // name="remove_upload[batchId][]" value="fileIndex"
            const hiddenInput = `<input type="hidden" name="remove_upload[${batchId}][]" value="${fileIndex}">`;
            $('#hiddenUploadContainer').append(hiddenInput);

            updateCounts();
        }

        function removeExistingImage(btn, imageId) {
            if (confirm('Are you sure you want to delete this image?')) {
                deletedImages.push(imageId);
                $('#deletedImages').val(JSON.stringify(deletedImages));
                $(btn).closest('.image-row').fadeOut(300, function () {
                    $(this).remove();
                    updateCounts();
                });
            }
        }

        function updateCounts() {
            const variantCount = $('#variantTableBody tr').length;
            const imageCount = $('#imageRowsContainer .image-row').length + $('#hiddenUploadContainer input[type="file"]').length;
            $('#variantCount').text(variantCount);
            $('#imageCount').text(imageCount);
        }
    </script>
</body>

</html>
