<div class="row">
  <div class="form-group col-sm-6">
    <label for="name">Nombre*</label>
    <input type="text" name="name" class="form-control" value="{{ isset($model) ? $model->name : old('name') }}">
  </div>

  <div class="form-group col-sm-6">
    <label for="email">Email*</label>
    <input type="email" name="email" class="form-control" value="{{ isset($model) ? $model->email : old('email') }}">
  </div>

  <div class="form-group col-sm-6">
    <label for="address">Dirección*</label>
    <input type="text" address="address" class="form-control" value="{{ isset($model) ? $model->address : old('address') }}">
  </div>

  <div class="form-group col-sm-6">
    <label for="phone">Teléfono*</label>
    <input type="text" name="phone" class="form-control" value="{{ isset($model) ? $model->phone : old('phone') }}">
  </div>

  <div class="form-group col-sm-12">
    <label for="additional_info">Información Adicional</label>
    <textarea name="additional_info" id="additional_info" class="form-control" rows="3" cols="80">{{ isset($model) ? $model->additional_info : old('additional_info') }}</textarea>
  </div>
</div>

<order-product-manager />
