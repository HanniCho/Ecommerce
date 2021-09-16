@extends('frontend.main_master')
@section('main_content')
@section('title')
Checkout Page
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{url('/')}}">Home</a></li>
				<li class='active'>Checkout</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<div class="row">
                <form class="register-form" method="POST" action="{{route('checkout.info.store')}}">
                    @csrf
                    <div class="col-md-7">                
                        <div class="panel-group checkout-steps" id="accordion">
                            <!-- checkout-step-01  -->
                            <div class="panel panel-default checkout-step-01">
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <!-- panel-body  -->
                                    <div class="panel-body">
                                        <div class="row">	                                        
                                                                                    
                                            <div class="col-md-6 col-sm-6 already-registered-login">
                                                <h4 class="checkout-subtitle"><b>Shipping Address</b></h4>
                                            
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1">Shipping Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="shipping_name" class="form-control unicase-form-control text-input" id="exampleInputEmail1" value="{{Auth::user()->name}}" placeholder="Full Name" required="">
                                                </div>    
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1">Email<span class="text-danger">*</span></label>
                                                    <input type="email" name="shipping_email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" value="{{Auth::user()->email}}" placeholder="Email" required="">
                                                </div>     
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1">Phone<span class="text-danger">*</span></label>
                                                    <input type="number" name="shipping_phone" class="form-control unicase-form-control text-input" id="exampleInputEmail1" value="{{Auth::user()->phone}}" placeholder="Phone" required="">
                                                </div>                                      
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1">Post Code<span class="text-danger"></span></label>
                                                    <input type="text" name="post_code" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Post Code">
                                                </div>   
                                            </div>	<!-- already-registered-login -->
                                            <div class="col-md-6 col-sm-6 already-registered-login">
                                                <div class="form-group">
                                                    <h5><b>Division</b><span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="division_id" class="form-control" required="" >
                                                            <option value="" selected="" disabled="">Select Division</option>
                                                            @foreach($divisions as $division)
                                                                <option value="{{ $division->id }}">{{ $division->division_name }}</option>	
                                                            @endforeach
                                                        </select>
                                                        @error('division_id') 
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror 
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5><b>District</b><span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="district_id" class="form-control"  required="">
                                                            <option value="" selected="" disabled="">Select District</option>                                                            
                                                        </select>
                                                        @error('district_id') 
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror 
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5><b>State</b><span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="state_id" class="form-control"required="" >
                                                            <option value="" selected="" disabled="">Select State</option>                                                            
                                                        </select>
                                                        @error('state_id') 
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror 
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1"><b>Notes</b><span class="text-danger"></span></label>
                                                    <textarea name="notes" class="form-control" cols="30" rows="5" placeholder="Notes"></textarea>
                                                </div>  
                                                
                                            </div><!-- already-registered-login -->	                                        
                                        </div>			
                                    </div>
                                    <!-- panel-body  -->
                                </div>
                            </div><!-- checkout-step-01  -->	

                        </div><!-- /.checkout-steps -->
                    </div>

                    <div class="col-md-5">
                    
                        <div class="checkout-progress-sidebar ">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">Your Checkout Product Lists</h4>
                                    </div>
                                    <div class="row">
                                        <ul class="nav nav-checkout-progress list-unstyled">
                                            @foreach($carts as $item)
                                            <li>
                                                <img src="{{ asset($item->options->image) }}" style="height: 50px; width: 50px;">
                                                <strong>Qty: </strong> ({{$item->qty}})
                                               
                                                <strong>Color: </strong> 
                                                @if($item->options->color == NULL)
                                                ...
                                                @else
                                                    {{$item->options->color}}
                                                @endif
                                                
                                                <strong>Size: </strong> 
                                                @if($item->options->size == NULL)
                                                ...
                                                @else
                                                {{$item->options->size}}                                        
                                                @endif

                                            </li>
                                            <hr>
                                            @endforeach
                                            <hr>   
                                            <li>
                                                @if(Session::has('coupon'))
                                                    <strong>SubTotal: </strong> ${{ $cartTotal }} <hr>
                                                    <strong>Coupon Name : </strong> {{ session()->get('coupon')['coupon_name'] }}
                                                    ( {{ session()->get('coupon')['coupon_discount'] }} % )     <hr>
                                                    <strong>Coupon Discount : </strong> ${{ session()->get('coupon')['discount_amount'] }}<hr>
                                                    <strong class="text-primary">Grand Total : ${{ session()->get('coupon')['total_amount'] }}</strong> <hr>
                                                @else
                                                    <strong>SubTotal: </strong> ${{ $cartTotal }} <hr>
                                                    <strong class="text-primary">Grand Total :  ${{ $cartTotal }} </strong><hr>
                                                @endif 
                                            </li>
                                        </ul>		
                                    </div>
                                </div>
                            </div>
                        </div>  <!-- checkout-progress-sidebar -->

                        <div class="checkout-progress-sidebar ">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">Select Payment Method</h4>
                                    </div>
                                    <div class="row">   
                                        <div class="col-md-3">
                                            <label for="stripe">Stripe</label>
                                            <input type="radio" name="payment_method" value="stripe">
                                            <img src="{{asset('frontend\assets\images\payments\4.png')}}" alt="">
                                        </div><!-- col-md-3 -->
                                        <div class="col-md-3">
                                            <label for="card">Card</label>
                                            <input type="radio" name="payment_method" value="card">
                                            <img src="{{asset('frontend\assets\images\payments\3.png')}}" alt="">
                                        </div><!-- col-md-3 -->
                                        <div class="col-md-3">
                                            <label for="card">PayPal</label>
                                            <input type="radio" name="payment_method" value="paypal">
                                            <img src="{{asset('frontend\assets\images\payments\1.png')}}" alt="">
                                        </div><!-- col-md-3 -->
                                        <div class="col-md-3">
                                            <label for="cash">Cash</label>
                                            <input type="radio" name="payment_method" value="cash">
                                            <img src="{{asset('frontend\assets\images\payments\6.png')}}" alt="">
                                        </div><!-- col-md-3 -->
                                        <hr>
                                    </div> <!-- row -->
                                    <hr>
                                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Proceed To Payment</button>

                                </div>
                            </div>
                        </div>                     
                        <!-- checkout-progress-sidebar -->	                    		
                    </div>
                </form>  
            </div><!-- /.row -->
        </div><!-- /.checkout-box -->

        <!-- ==== ================== BRANDS CAROUSEL ============================================== -->
        @include('frontend.body.brands')
        <!-- ==== ================== BRANDS CAROUSEL :END ============================================== -->
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
    $('select[name="division_id"]').on('change', function(){
        var division_id = $(this).val();
        if(division_id) {
            $.ajax({
                url: "{{  url('/district-get/ajax') }}/" + division_id,
                type:"GET",
                dataType:"json",
                success:function(data) {
                    var d =$('select[name="district_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="district_id"]').append('<option value="'+ value.id +'">' + value.district_name + '</option>');
                        });
                },
            });
        } else {
            alert('danger');
        }
    });
});
</script>
<script type="text/javascript">
    $(document).ready(function() {
    $('select[name="district_id"]').on('change', function(){
        var district_id = $(this).val();
        if(district_id) {
            $.ajax({
                url: "{{  url('/state-get/ajax') }}/" + district_id,
                type:"GET",
                dataType:"json",
                success:function(data) {
                    var d =$('select[name="state_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="state_id"]').append('<option value="'+ value.id +'">' + value.state_name + '</option>');
                        });
                },
            });
        } else {
            alert('danger');
        }
    });
});
</script>
@endsection