<div class="row">
  <div class="form-group col-sm-6">
    <label for="name">Nombre</label>
    <input type="text" name="name" class="form-control" value="{{ isset($model) ? $model->name : old('name') }}">
  </div>
</div>
