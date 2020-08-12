@extends('layouts.front', ['noFooter' => true])

@section('content')

  <div id="checkout">

    <div class="container">
      @include('front.partials.nav', ['noMenu' => 'Compra 100% protegida'])
    </div>

    <section style="padding-top: 66px; padding-bottom: 123px; border-top: 1px solid #d8d8d8;">
      <div class="container">

        <div class="row">
          <div class="col-md-8">
            <div style="padding-right: 33px;">

              <h2 style="text-transform: uppercase; margin-bottom: 51px;font-size: 20px; font-weight: 600;">Formulario de Compra</h2>

              <div>
                <h3 style="font-size: 14px; font-weight:600; color: #3e3e3e; margin-bottom: 22px;">Datos de Contacto</h3>
                <div class="form-group" style="margin-bottom: 25px;">
                  <label for="" class="sr-only">Email</label>
                  <input type="email" class="form-control" placeholder="Email" style="border-radius: 30px; height: 49px; padding-left: 28px; font-size: 13px;">
                </div>
                <div style="font-size: 14px;"><span style="font-weight: 600;">¿Ya tenes una cuenta?.</span> <a href="#" class="text-dark">Iniciá sesión</a></div>
              </div>

              <h2 style="text-transform: uppercase; margin-top: 65px; font-size: 20px; font-weight: 600;">Dirección de Entrega</h2>
              <div style="margin-top: 18px;">
                <h3 style="font-size: 14px; font-weight:600; color: #3e3e3e; margin-bottom: 22px;">Datos del Destinatario</h3>

                <div class="form-group" style="margin-bottom: 16px;">
                  <label for="" class="sr-only">Nombre</label>
                  <input type="text" class="form-control" placeholder="Nombre" style="border-radius: 30px; height: 49px; padding-left: 28px; font-size: 13px;">
                </div>

                <div class="form-group" style="margin-bottom: 16px;">
                  <label for="" class="sr-only">Apellido</label>
                  <input type="text" class="form-control" placeholder="Apellido" style="border-radius: 30px; height: 49px; padding-left: 28px; font-size: 13px;">
                </div>

                <div class="form-group" style="margin-bottom: 16px;">
                  <label for="" class="sr-only">Teléfono</label>
                  <input type="text" class="form-control" placeholder="Teléfono" style="border-radius: 30px; height: 49px; padding-left: 28px; font-size: 13px;">
                </div>

              </div>

              <div style="margin-top: 46px;">
                <h3 style="font-size: 14px; font-weight:600; color: #3e3e3e; margin-bottom: 22px;">Domicilio del Destinatario</h3>

                <div class="form-group" style="margin-bottom: 16px;">
                  <label for="" class="sr-only">País</label>
                  <input type="text" class="form-control" value="Argentina" disabled placeholder="País" style="border-radius: 30px; height: 49px; padding-left: 28px; font-size: 13px;">
                </div>

                <div class="form-group" style="margin-bottom: 16px;">
                  <label for="" class="sr-only">Calle</label>
                  <input type="text" class="form-control" placeholder="Calle" style="border-radius: 30px; height: 49px; padding-left: 28px; font-size: 13px;">
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group" style="margin-bottom: 16px;">
                      <label for="" class="sr-only">Número</label>
                      <input type="text" class="form-control" placeholder="Número" style="border-radius: 30px; height: 49px; padding-left: 28px; font-size: 13px;">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group" style="margin-bottom: 16px;">
                      <label for="" class="sr-only">Dpto</label>
                      <input type="text" class="form-control" placeholder="Dpto" style="border-radius: 30px; height: 49px; padding-left: 28px; font-size: 13px;">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group" style="margin-bottom: 16px;">
                      <label for="" class="sr-only">Ciudad</label>
                      <input type="text" class="form-control" placeholder="Ciudad" style="border-radius: 30px; height: 49px; padding-left: 28px; font-size: 13px;">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group" style="margin-bottom: 16px;">
                      <label for="" class="sr-only">Código Postal</label>
                      <input type="text" class="form-control" placeholder="Código Postal" style="border-radius: 30px; height: 49px; padding-left: 28px; font-size: 13px;">
                    </div>
                  </div>
                </div>


                <div class="form-group" style="margin-bottom: 16px;">
                  <label for="" class="sr-only">Localidad</label>
                  <input type="text" class="form-control" placeholder="Localidad" style="border-radius: 30px; height: 49px; padding-left: 28px; font-size: 13px;">
                </div>

              </div>

              <div class="text-right" style="margin-top: 64px;">
                <button type="button" class="btn btn-secondary" style="font-size: 13px; font-weight: 600; text-transform: uppercase; border-radius: 50px; padding: 15px 104px;">Continuar</button>
              </div>


            </div>
          </div>
          <div class="col-md-4 position-relative" style="padding-top:28px;">
            <div style="background-color: #f8f8f8; padding: 50px 50px 32px 50px;" class="sticky-top">
              <h3 style="margin-bottom: 37px; font-size:18px; font-weight: 600;">Tu Carrito</h3>

              <div style="margin-bottom: 31px;">

                @for ($i=0; $i < 10; $i++)

                  <div class="d-flex" style="margin-bottom: {{ $i == 9 ? '0' : '31' }}px;">
                    <div style="width: 57px; height: 57px; border-radius: 100%; overflow: hidden; background-image: url('{{ asset('images/example-show-product-1.png') }}'); background-position: center center; background-repeat: no-repeat; background-size: 100%" class="position-relative"></div>
                    <div style="margin-left:12px">
                      <h3 style="font-size: 14px;font-weight: 600; margin-bottom: 13px;">Queso Gouda</h3>
                      <div style="color: #c4c4c4; font-size:12px; font-weight: 300;">#1261311</div>
                    </div>
                    <div class="ml-auto" style="font-size: 14px;font-weight: 600; margin-bottom: 13px;">$89.99</div>
                  </div>

                @endfor
              </div>

              <div class="d-flex align-items-center" style="border-top: 1px solid #d8d8d8; border-bottom: 1px solid #dedede; padding: 17px 0;">
                <div class="text-secondary" style="font-weight: 300;">Total</div>
                <div class="ml-auto" style="font-weight: 600;">$159,98</div>
              </div>
              <div style="margin-top: 17px; color: #868686; font-size: 14px;">¿Tenes un cupón de descuento?</div>

            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
