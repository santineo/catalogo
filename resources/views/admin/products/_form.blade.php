<div class="row">
  <div class="form-group col-sm-6">
    <label for="title">Título*</label>
    <input type="text" name="title" class="form-control" value="{{ isset($model) ? $model->title : old('title') }}">
  </div>
  <div class="form-group col-sm-6">
    <label for="price">Precio*</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">$</span>
      </div>
      <input type="text" name="price" class="form-control" value="{{ isset($model) ? $model->price : old('price') }}">
    </div>
  </div>
  <div class="form-group col-sm-6">
    <label for="category">Categoría*</label>
    <select class="custom-select" id="category" name="category_id">
      <option {{ !(isset($model) ? $model->category_id : old('category_id')) ? 'selected' : '' }}>Seleccione una categoría</option>
      @foreach (\App\Category::all() as $key => $category)
        <option value="{{ $category->id }}" {{ (isset($model) ? $model->category_id : old('category_id')) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group col-sm-6">
    <label for="brand">Marca</label>
    <select class="custom-select" id="brand" name="brand_id">
      <option {{ !(isset($model) ? $model->brand_id : old('brand_id')) ? 'selected' : '' }}>Seleccione una marcas</option>
      @foreach (\App\Brand::all() as $key => $brand)
        <option value="{{ $brand->id }}" {{ (isset($model) ? $model->category_id : old('brand_id')) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group col-sm-12">
    <label for="description">Descripción*</label>
    <textarea name="description" id="description" class="form-control" rows="8" cols="80">{{ isset($model) ? $model->description : old('description') }}</textarea>
  </div>
  <div class="form-group col-sm-6">
    <label>Imagen</label>
    <image-input :saved="{{ isset($model) ? json_encode($model->uploads->first()) : 'false' }}"></image-input>
  </div>
</div>
