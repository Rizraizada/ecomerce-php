<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/HomeController.php");

## ===*=== [O]BJECT DEFINED ===*=== ##
$homeCtrl = new HomeController;
$eloquent = new Eloquent;

## ===*=== [F]ETCH SLIDER DATA FOR HOME PAGE SLIDER ===*=== ##
$columnName = $tableName = null;
$columnName = "*";
$tableName = "slides";
$slidesList = $eloquent->selectData($columnName, $tableName);
## ===*=== [F]ETCH SLIDER DATA FOR HOME PAGE SLIDER ===*=== ##

## ===*=== [F]ETCH ALL CATEGORIES ===*=== ##
$categories = $eloquent->selectData(["id", "category_name"], "categories");
## ===*=== [F]ETCH ALL CATEGORIES ===*=== ##

?>

<!--=*= HOME SECTION START =*=-->
<main class="main">
<div class="home-top-container">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="home-slider owl-carousel owl-carousel-lazy">
						
					<?php 
						#== DYNAMIC SLIDER IMAGES
						foreach($slidesList AS $eachSlide)
						{
							echo '
							<div class="home-slide">
								<img class="owl-lazy" src="public/assets/images/lazy.png" data-src="'.$GLOBALS['SLIDES_DIRECTORY'] . $eachSlide['slider_file'].'" alt="slider image">
								<div class="home-slide-content">
									<h1 class="text-primary">'.$eachSlide['slider_title'].'</h1>
								</div>
							</div>';
						}
					?>
					
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="info-boxes-container">
		<div class="container">
			<div class="info-box">
				<i class="icon-shipping"></i>
				<div class="info-box-content">
					<h4>FREE SHIPPING & RETURN</h4>
					<p>Free shipping on all orders over $99.</p>
				</div>
			</div>
			<div class="info-box">
				<i class="icon-us-dollar"></i>
				<div class="info-box-content">
					<h4>MONEY BACK GUARANTEE</h4>
					<p>100% money back guarantee</p>
				</div>
			</div>
			<div class="info-box">
				<i class="icon-support"></i>
				<div class="info-box-content">
					<h4>ONLINE SUPPORT 24/7</h4>
					<p>Lorem ipsum dolor sit amet.</p>
				</div>
			</div>
		</div>
	</div>
    <div class="container">
        <?php
        // Loop through each category
        foreach ($categories as $category) {
            // Fetch products for the current category
            $columnName = $tableName = $whereValue = $inColumn = $inValue = $formatBy = $paginate = null;
            $columnName["1"] = "id";
            $columnName["2"] = "product_name";
            $columnName["3"] = "product_price";
            $columnName["4"] = "product_master_image";
            $tableName = "products";
            $whereValue["category_id"] = $category['id'];
            $whereValue["product_status"] = "In Stock";
            $formatBy["DESC"] = "id";
            $paginate["POINT"] = 0;
            $paginate["LIMIT"] = 8;
            $products = $eloquent->selectData($columnName, $tableName, @$whereValue, @$inColumn, @$inValue, @$formatBy, @$paginate);

            // Display products for the current category
            echo '<div class="row">
                    <div class="col-lg-12">
                        <div class="home-product-tabs">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="featured-products-tab" data-toggle="tab" href="#'.$category['category_name'].'" role="tab" aria-controls="'.$category['category_name'].'" aria-selected="true">'.$category['category_name'].'</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="'.$category['category_name'].'" role="tabpanel" aria-labelledby="featured-products-tab">
                                    <div class="row row-sm">';
                                        // Display products for the current category
                                        $homeCtrl->productLister($products);
                                    echo '</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
        }
        ?>
    </div>
	<div class="partners-container">
		<div class="container">
			<div class="partners-carousel owl-carousel owl-theme">
				<a href="#" class="partner">
					<img src="public/assets/images/brand/brand(1).png" alt="logo">
				</a>
				<a href="#" class="partner">
					<img src="public/assets/images/brand/brand(2).png" alt="logo">
				</a>
				<a href="#" class="partner">
					<img src="public/assets/images/brand/brand(3).png" alt="logo">
				</a>
				<a href="#" class="partner">
					<img src="public/assets/images/brand/brand(4).png" alt="logo">
				</a>
				<a href="#" class="partner">
					<img src="public/assets/images/brand/brand(5).png" alt="logo">
				</a>				
				<a href="#" class="partner">
					<img src="public/assets/images/brand/brand(1).png" alt="logo">
				</a>				
				<a href="#" class="partner">
					<img src="public/assets/images/brand/brand(2).png" alt="logo">
				</a>
			</div>
		</div>
	</div>
</main>
<!--=*= HOME SECTION START =*=-->
