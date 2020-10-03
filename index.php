<!DOCTYPE html>
<html lang="en">
<head>
  <title>Ebay Products</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container mt-3">
    <h3>Ebay Products</h3>
    <p>To view your Ebay products details please enter the product IDs in the below form.</p>
    <p>Note : Maximum 5 products at a time</p>
    <p>Use + or - button for adding or removing product IDs</p>
    <form id="product-form"action="action_page.php" method="post">
        <div id="sample_products">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Enter your product ID" id="product-id-1" name="products[]" required>
                <div class="input-group-append">
                    <span class="input-group-text add-product" id="plus-1" data-number="1">+</span>
                </div>
            </div>
        </div>
        <button id="submit-products" type="submit" class="btn btn-primary">Submit</button>
        <div class="spinner-border d-none"></div>

    </form>
</div>
<script type="text/javascript">
$(document).on('click', '.add-product', function(){
    var tab_number  = $(this).data('number');
    $(this).addClass('d-none');
    var next_tab    = tab_number + 1;
    var appenddata = '<div class="input-group mb-3">'
    +'<input type="text" class="form-control" placeholder="Enter your product ID" id="product-id-'+next_tab+'" name="products[]" required>'
    +'<div class="input-group-append">';
        if(tab_number!=4){
            appenddata+='<span class="input-group-text add-product" id="plus-'+next_tab+'" data-number="'+next_tab+'">+</span>';
        }
        appenddata+='<span class="input-group-text remove-product" id="minus-'+next_tab+'" data-number="'+next_tab+'">-</span>'
        +'</div>'
    +'</div>'; 
    $('#sample_products').append(appenddata);
});

$(document).on('click', '.remove-product', function(){
    var tab_number  = $(this).data('number');
    previous_tab = tab_number -1;
    $(this).closest('.input-group').remove();
    if(previous_tab==1){
        $('#plus-'+previous_tab).removeClass('d-none');    
    }   
});

$('#product-form').submit(function() {
    $('#submit-products').addClass('d-none');
    $('.spinner-border').removeClass('d-none');
});


/*$('.form-control').change(function() {
    $current = $(this);
    $('.form-control').each(function(val,index) {
        alert($('.form-control').length);
        if ($(this).val() == $current.val()){
            alert('duplicate found!');
        }
    });
  });*/
</script>

</body>
</html>

