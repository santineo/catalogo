<div class="row">
  <div class="form-group col-sm-6">
    <label for="title">Título*</label>
    <input type="text" name="title" class="form-control" value="{{ isset($model) ? $model->title : old('title') }}">
  </div>


  <div class="form-group col-sm-6">
    <price-input :model_price="{{ isset($model) ? $model->price : old('price', 0) }}" :model_selling_type="{{ isset($model) ? $model->selling_type : old('selling_type', 1) }}"></price-input>
  </div>

  <div class="form-group col-sm-6">
    <label for="category">Categoría*</label>
    <create-select :default_options="{{ json_encode(\App\Category::all()) }}" :input_name="'category_id'" :placeholder="'Seleccione una categoría'" :title="'Categoría'" :callback="'addCategory'" :default_value="'{{ isset($model) ? $model->category_id : old('category_id') }}'"></create-select>
  </div>

  <div class="form-group col-sm-6">
    <label for="brand">Marca</label>
    <create-select :default_options="{{ json_encode(\App\Brand::all()) }}" :input_name="'brand_id'" :placeholder="'Seleccione una marca'" :title="'Marca'" :callback="'addBrand'" :default_value="'{{ isset($model) ? $model->brand_id : old('brand_id') }}'"></create-select>
  </div>

  <div class="form-group col-sm-12 d-none">
    <stock-input :model_stock="{{ isset($model) ? $model->stock : old('stock', 0) }}" :model_validate_stock="{{ isset($model) ? $model->validate_stock : old('validate_stock', 0) }}"></stock-input>
  </div>

  <div class="form-group col-sm-12">
    <label for="description">Descripción*</label>
    <textarea name="description" id="description" class="form-control" rows="8" cols="80">{{ isset($model) ? $model->description : old('description') }}</textarea>
  </div>


  <div class="form-group col-sm-6">
    <div class="mb-2">Imagen</div>
    <image-input :saved="{{ isset($model) ? json_encode($model->uploads->first()) : 'false' }}"></image-input>
  </div>

</div>
