<footer>
   <div class="container">
      <div class="row">
         <div class="col-md-4">
            <div class="full">
               <div class="logo_footer">
                  <a href="#"><img width="210" src="images/logo.png" alt="#" /></a>
               </div>
               <div class="information_f">
                  <p><strong>ADDRESS:</strong> Bharatpur, Chitwan, Nepal</p>
                  <p><strong>TEL NUMBER:</strong> 056-123456</p>
                  <p><strong>EMAIL:</strong> SereneCartfashion@gmail.com</p>
               </div>
            </div>
         </div>
         <div class="col-md-8">
            <div class="row">
               <div class="col-md-7">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="widget_menu">
                           <h3>Menu</h3>
                           <ul>
                              <li><a href="#">Home</a></li>
                              <li><a href="#">About</a></li>
                              <li><a href="{{ url('/products') }}">Products</a></li>
                              <li><a href="#">Testimonial</a></li>
                           </ul>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="widget_menu">
                           <h3>Account</h3>
                           <ul>
                              <li><a href="{{ route('profile.show') }}">Account</a></li>
                              <li><a href="{{ url('/show_cart') }}">Cart</a></li>
                              <li><a href="{{ url('/show_order') }}">Order</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</footer>