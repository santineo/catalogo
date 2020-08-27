<div class="row">
  <div class="form-group col-sm-6">
    <label for="name">Nombre</label>
    <input type="text" name="name" class="form-control" value="{{ isset($model) ? $model->name : old('name') }}">
  </div>
  <div class="form-group col-sm-6">
    <label for="email">Email</label>
    <input type="email" name="email" class="form-control" value="{{ isset($model) ? $model->email : old('email') }}">
  </div>
  <div class="form-group col-sm-6">
    <label for="phone">Teléfono</label>
    <input type="text" name="phone" class="form-control" value="{{ isset($model) ? $model->phone : old('phone') }}">
  </div>
  <div class="form-group col-sm-12">
    <label for="name">Información Adicional</label>
    <textarea name="information" class="form-control">{{ isset($model) ? $model->information : old('information') }}</textarea>
  </div>
</div>
<input type="hidden" name="status" value="1">
<select-list :saved="{{ json_encode(isset($model) ? $model->groups->pluck('id') : []) }}" :label="'Grupos'" :feed_uri="'{{ route('grupos.index') }}'" :name="'groups'"></select-list>
