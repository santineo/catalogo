@extends('layouts.front')

@section('content')
  <div id="contact">


      @include('front.partials.nav')
    

    <section class="container" style="padding-top: 66px; padding-bottom: 123px;">
      <h2 style="font-size: 34px; font-weight: 300; margin-bottom: 60px;">Contacto</h2>
      <div class="row">
        <div class="col-md-7">
          <div style="max-width: 542px;">

            <h3 class="text-uppercase" style="margin-bottom: 43px; font-size: 20px; font-weight: 500;">Dejanos tu mensaje</h3>

            <div class="form-group" style="margin-bottom: 25px;">
              <label for="" style="font-size: 18px; color: #3e3e3e;">Tu nombre*</label>
              <input type="text" class="form-control" style="border-radius: 10px; height: 49px;">
            </div>

            <div class="form-group" style="margin-bottom: 25px;">
              <label for="" style="font-size: 18px; color: #3e3e3e;">Email*</label>
              <input type="text" class="form-control" style="border-radius: 10px; height: 49px;">
            </div>

            <div class="form-group" style="margin-bottom: 25px;">
              <label for="" style="font-size: 18px; color: #3e3e3e;">Teléfono*</label>
              <input type="text" class="form-control" style="border-radius: 10px; height: 49px;">
            </div>

            <div class="form-group" style="margin-bottom: 25px;">
              <label for="" style="font-size: 18px; color: #3e3e3e;">Mensaje*</label>
              <textarea rows="6" cols="80"class="form-control" style="border-radius: 10px; resize: none;"></textarea>
            </div>

            <div class="d-flex align-items-center justify-content-between">
              <div>*Campos obligatorios</div>
              <button type="submit" class="btn btn-secondary text-uppercase" style="font-weight: 600; font-size:13px; padding: 15px 32px; border-radius: 50px;">Enviar Mensaje</button>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <h3 class="text-uppercase" style="margin-bottom: 43px; font-size: 20px; font-weight: 500;">Dejanos tu mensaje</h3>

          <div style="margin-bottom: 69px;">
            <h4 class="d-flex align-items-center" style="margin-bottom: 14px; font-size:18px; font-weight: 500; color: #3e3e3e; line-height: 1.55;"><i class="icon icon-location text-secondary" style="font-size:16px; margin-right: 10px;"></i> <span>Dirección</span></h4>
            <p style="font-size: 18px; font-weight:300; color: #3e3e3e; line-height:2.17">1234 Calle Santa Rosa, Buenos Aires, Argentina</p>
          </div>

          <div style="margin-bottom: 69px;">
            <h4 class="d-flex align-items-center" style="margin-bottom: 14px; font-size:18px; font-weight: 500; color: #3e3e3e; line-height: 1.55;"><i class="icon icon-phone text-secondary" style="font-size:16px; margin-right: 10px;"></i> <span>Teléfono</span></h4>
            <p style="font-size: 18px; font-weight:300; color: #3e3e3e; line-height:2.17">+5411 555 7843 / +5411 901 2231</p>
          </div>

          <div style="margin-bottom: 69px;">
            <h4 class="d-flex align-items-center" style="margin-bottom: 14px; font-size:18px; font-weight: 500; color: #3e3e3e; line-height: 1.55;"><i class="icon icon-mail-alt text-secondary" style="font-size:16px; margin-right: 10px;"></i> <span>E-Mail</span></h4>
            <p style="font-size: 18px; font-weight:300; color: #3e3e3e; line-height:2.17">contacto@tiendadequesos.com</p>
          </div>

          <div>
            <h4 class="d-flex align-items-center" style="margin-bottom: 14px; font-size:18px; font-weight: 500; color: #3e3e3e; line-height: 1.55;"><i class="icon icon-heart text-secondary" style="font-size:16px; margin-right: 10px;"></i> <span>Redes Sociales</span></h4>
            @include('front.partials.social')
          </div>

        </div>
      </div>
    </section>
  </div>
@endsection
