@extends('layout')
@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Giỏ hàng</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<?php
                use Gloudemans\Shoppingcart\Facades\Cart;
				$content = Cart::content();
				?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="description">Tên sản phẩm</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Tổng tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@foreach($content as $v_content)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to('public/uploads/product/'.$v_content -> options -> image)}}" width="50" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$v_content ->name}}</a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($v_content ->price).' '.'VND'}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
								  <form action="{{URL::to('/update-cart-quantity')}}" method="POST">
								    {{csrf_field()}}
									<input class="cart_quantity_input" type="text" name="quantity_cart" value="{{$v_content ->qty}}" autocomplete="off" size="2">
									<input class="cart_quantity_input" type="submit" name="update_qty" value="Cập nhật">
									<input class="cart_quantity_input" type="hidden" name="rowId_cart" value="{{$v_content ->rowId}}">
								  </form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									<?php
									$subtotal = $v_content -> price * $v_content->qty;
									echo number_format($subtotal). ' '. 'VND';
									?>
								</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/' .$v_content->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>Lựa chọn tiếp theo của bạn?</h3>
				<p>Lựa chọn mã giảm giá hoặc điểm thưởng và kiểm tra lại tổng số tiền các mục mà bạn phải thanh toán.</p>
			</div>
			<div class="row">
				<!-- <div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				 -->
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng tiền<span>{{Cart::subtotal().' '.'VND'}}</span></li>
							<li>Thuế <span>{{Cart::tax().' '.'VND'}}</span></li>
							<li>Phí vận chuyển <span>Miễn phí</span></li>
							<li>Thành tiền <span>{{Cart::total().' '.'VND'}}</span></li>
						</ul>
						        <?php
                                use Illuminate\Support\Facades\Session;
								$customer_id = Session::get('customer_id');
								if($customer_id!=Null){
								?>
								<a class="btn btn-default update" href="{{URL::to('/checkout')}}">Thanh toán</a>
								<?php
								}else{
								?>
								<a class="btn btn-default update" href="{{URL::to('/login-checkout')}}">Thanh toán</a>
                                <?php
								}
								?>
							<!-- <a class="btn btn-default update" href="{{URL::to('/login-checkout')}}">Thanh toán</a> -->
							<!-- <a class="btn btn-default check_out" href=""></a> -->
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

@endsection