<th class="text-center small-12 large-6 columns {{ isset($class) ? $class : '' }}" style="Margin:0 auto;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:30px;padding-right:15px;text-align:center;width:260px">
  @if(isset($product) && $product)
    <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
      <tr style="padding:0;text-align:left;vertical-align:top">
        <th style="Margin:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left"><img src="{{ $product->getPrimaryImage('thumb') }}" alt="{{ $product->title }}" style="-ms-interpolation-mode:bicubic;clear:both;display:block;margin:0 auto;max-width:100%;outline:0;text-decoration:none;width:auto">
          <table class="spacer" style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
            <tbody>
              <tr style="padding:0;text-align:left;vertical-align:top">
                <td height="10px" style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:10px;font-weight:400;hyphens:auto;line-height:10px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">&#xA0;</td>
              </tr>
            </tbody>
          </table>
          <h5 style="Margin:0;Margin-bottom:10px;color:inherit;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:700;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left;word-wrap:normal">{{ $product->title }}</h5>
          <div style="font-size:18px;font-weight:700;color:#bf0f2c">
            @if ($product->offer)
              <small style="color:#cacaca;font-size:80%;text-decoration:line-through">€{{ $product->offer }}</small>
            @endif
            €{{ number_format($product->price, 2, ',', ' ') }}
          </div>
          <table class="spacer" style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
            <tbody>
              <tr style="padding:0;text-align:left;vertical-align:top">
                <td height="10px" style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:10px;font-weight:400;hyphens:auto;line-height:10px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">&#xA0;</td>
              </tr>
            </tbody>
          </table>
          <table class="button" style="Margin:0 0 16px 0;border-collapse:collapse;border-spacing:0;margin:0 0 16px 0;padding:0;text-align:left;vertical-align:top;width:auto">
            <tr style="padding:0;text-align:left;vertical-align:top">
              <td style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                  <tr style="padding:0;text-align:left;vertical-align:top">
                    <td style="-moz-hyphens:auto;-webkit-hyphens:auto;Margin:0;background:#2199e8;border:2px solid #2199e8;border-collapse:collapse!important;color:#fefefe;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word"><a href="{{ $product->public_path }}" style="Margin:0;border:0 solid #2199e8;border-radius:3px;color:#fefefe;display:inline-block;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:700;line-height:1.3;margin:0;padding:8px 16px 8px 16px;text-align:left;text-decoration:none">Ver más</a></td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </th>
      </tr>
    </table>
  @endif
</th>
