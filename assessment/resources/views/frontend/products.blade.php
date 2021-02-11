<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<style>
        .product_view .modal-dialog{max-width: 800px; width: 100%;}
        .pre-cost{text-decoration: line-through; color: #a5a5a5;}
        .space-ten{padding: 10px 0;}
</style>
 
<div class="container">

    <div class="row">
    @forelse($product as $k => $products)
        <div class="col-md-4">
        
              <div class="thumbnail">
                <img src="http://tech.firstpost.com/wp-content/uploads/2014/09/Apple_iPhone6_Reuters.jpg" alt="" class="img-responsive">
                
                <div class="caption">
               
                  <h4 class="">{{$products->product_name}}</h4>
                  <h4 class="">{{$products->sku}}</h4>
                  <h4 class="">{{$products->quantity}}</h4>
                  <h4><a href="#">Mobile Product</a></h4>
                  <img  src="{{ asset('storage/images/'.$products->product_image) }}" style="width:50%;  height:70px;"/>
                </div>
                <div class="ratings">
                  <p>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                     (15 reviews)
                  </p>
                  
                </div>
                
                <div class="space-ten"></div>
                <div class="btn-ground text-center">
                    <button type="button" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>BUY</button>
                    
                    
                </div>
                <div class="space-ten"></div>
              </div>
            </div>
    </div>
    
</div>

  @empty
@endforelse 