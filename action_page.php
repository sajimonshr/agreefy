<!DOCTYPE html>
<html lang="en">
<head>
  <title>Ebay Prooduct Details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container mt-3">
    <div class="row">
        <div class="col-md-11">
            <h2>Ebay Product Details</h2>
        </div>
        <div class="col-md-1">
            <a href="index.php" class="btn btn-primary pull-right">Back</a>
        </div>
    </div>
    <hr>
    
    
<?php 
    require 'simple_html_dom.php';
    if(isset($_POST['products'])){
        if(!empty($_POST['products'])){
            $products = $_POST['products'];
            foreach ($products as $key => $product) {
                $publicURL = 'https://www.ebay.com/itm/'.$product;
                $html =  @file_get_html($publicURL,false);
                if($html === FALSE) {?>
                    <table class="table table-striped table-bordered table-responsive">
                        <tr>
                            <th style="width: 300px;">Product ID</td>
                            <td style="width: 810px;"><?=$product?></td>
                        </tr>
                        <tr>
                            <th colspan="2"style="width: 1110px;"><center>Invalid Product</center></td>
                        </tr>
                    </table>
                <?php } else {
                    $title = $html->find('title', 0);
                    $mainImage = $html->find('#icImg',0);
                    $mainImage = $mainImage->src;?>
                    <table class="table table-striped table-bordered table-responsive">
                        <tr>
                            <th style="width: 300px;">Product ID</td>
                            <td style="width: 810px;"><?=$product?></td>
                        </tr>
                        <tr>
                            <th style="width: 300px;">Public URL</td>
                            <td style="width: 810px;">
                                <a href="<?=$publicURL?>" target="_blank"><?=$publicURL?></a>
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 300px;">Product Title</td>
                            <td style="width: 810px;"><?=$title->plaintext?></td>
                        </tr>
                        <tr>
                            <th style="width: 300px;">Product Image</td>
                            <td style="width: 810px;">
                                <a href="<?=$mainImage?>" target="_blank"><?=$mainImage?></a>
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 300px;">Thump Images</td>
                            <td style="width: 810px;">
                                <ul>
                                    <?php 
                                    $count = 1;
                                    foreach ($html->find('.tdThumb') as $thumbImage) {
                                        $imageDiv = $thumbImage->find("div",0);
                                        $image = $thumbImage->find("img",0);
                                        if($count<=5){?>
                                            <li class="show">
                                                <a href="<?=$image->src?>" target="_blank"><?=$image->src?></a>
                                            </li>    
                                        <?php } else {?>
                                            <li class="hide-<?=$product?> d-none">
                                                <a href="<?=$image->src?>" target="_blank"><?=$image->src?></a>
                                            </li>
                                        <?php }
                                        $count++;
                                    }
                                    if($count!=1 && $count>5){?>
                                        
                                            <span class="more more-<?=$product?>" data-product="<?=$product?>"><b>More</b>
                                            </span>
                                        
                                            <span class="less less-<?=$product?> d-none" data-product="<?=$product?>"><b>Less</b></span>
                                        
                                    <?php }?>
                                </ul>
                                <?php 
                                if($count==1){?>
                                    <span>Images not available</span>
                                <?php }?>
                            </td>
                        </tr>
                    </table>
                    <br>
                <?php }
            }
        }
    } else {
        header("Location: index.php"); 
        exit();
    }
?>   
<script type="text/javascript">
    $('.more').click(function(){
        var product = $(this).data('product');
        $('.hide-'+product).removeClass('d-none');
        $('.more-'+product).addClass('d-none');
        $('.less-'+product).removeClass('d-none');
    });

    $('.less').click(function(){
        var product = $(this).data('product');
        $('.hide-'+product).addClass('d-none');
        $('.more-'+product).removeClass('d-none');
        $('.less-'+product).addClass('d-none');
    });

</script>                   
</div>
</body>
</html>