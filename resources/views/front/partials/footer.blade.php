<footer class="container border-top" style="padding: 55px 0">
  <div class="row">
    <div class="col-lg-4 col-md-6">
      <h2 class="text-primary" style="font-size: 19px; font-weight:500; margin-bottom: 42px;">La casa del Salamín</h2>
      <p style="color:#808080; font-size: 13px; line-height: 2; margin-bottom: 27px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

      <div class="d-flex">
        <div><a href="#">F</a></div>
        <div style="margin-left: 33px;"><a href="#">T</a></div>
        <div style="margin-left: 33px;"><a href="#">L</a></div>
        <div style="margin-left: 33px;"><a href="#">I</a></div>
        <div style="margin-left: 33px;"><a href="#">Y</a></div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 ml-auto">
      <div class="d-flex justify-content-between">

        <div>
          <h4 style="margin-bottom: 30px; font-size:14px; font-weight:600;" class="text-primary">Tienda</h4>
          <ul class="list-unstyled">
            @for ($i=0; $i < 4; $i++)
              <li style="font-size: 13px; font-weight: 500; margin-bottom: 10px;" ><a href="#" class="text-dark">Quesos</a></li>
            @endfor
          </ul>
        </div>

        <div>
          <h4 style="margin-bottom: 30px; font-size:14px; font-weight:600;" class="text-primary">Contacto</h4>
          <ul class="list-unstyled">

            <li style="font-size: 13px; font-weight: 500; margin-bottom: 10px;"><a href="mailto:info@e-shop.com" class="text-dark">info@e-shop.com</a></li>
            <li style="font-size: 13px; font-weight: 500; margin-bottom: 10px;">Tel: <a href="tel:+1131138138" class="text-dark">+1131138138</a></li>

          </ul>
        </div>

      </div>
    </div>
  </div>
</footer>
