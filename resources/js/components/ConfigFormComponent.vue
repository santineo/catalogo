<template>
  <div>
    <div v-if="saved" class="alert alert-success">Se ha guardado con éxito</div>
    <div v-if="error" class="alert alert-danger">Se ha encontrado un problema al guardar los datos</div>
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
      <li class="nav-item">
        <a class="nav-link px-5 active" id="pills-general-tab" data-toggle="pill" href="#pills-general" role="tab" aria-controls="pills-general" aria-selected="true">General</a>
      </li>
      <li class="nav-item">
        <a class="nav-link px-5" id="pills-social-tab" data-toggle="pill" href="#pills-social" role="tab" aria-controls="pills-social" aria-selected="false">Redes Sociales</a>
      </li>
      <li class="nav-item">
        <a class="nav-link px-5" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="false">Home</a>
      </li>
    </ul>
    <!-- Arreglar estilos en linea -->
    <div class="tab-content" id="pills-tabContent" style="border: 1px solid #ccc;padding: 20px;background-color: #fdfdfd;">

      <!-- PANE GENERAL -->
      <div class="tab-pane fade show active" id="pills-general" role="tabpanel" aria-labelledby="pills-general-tab">

        <div class="row">
          <div class="form-group col-sm-6">
            <label for="">Nombre del Sitio</label>
            <input type="text" class="form-control" v-model="form.site_name.value">
            <span class="text-danger small" v-if="form.site_name.required">Este campo es requerido</span>
          </div>

          <div class="form-group col-sm-6">
            <label for="">Logo</label>
            <image-input :saved="form.logo.upload" :mwidth="100" :psize="'url'" :index="form.logo.index" @changed="setUpload"></image-input>
          </div>

          <div class="form-group col-sm-6">
            <label for="">Email</label>
            <input type="email" class="form-control" v-model="form.email.value">
            <span class="text-danger small" v-if="form.email.required">Este campo es requerido</span>
          </div>

          <div class="form-group col-sm-6">
            <label for="">Teléfono</label>
            <input type="text" class="form-control" v-model="form.phone.value">
            <span class="text-danger small" v-if="form.phone.required">Este campo es requerido</span>
          </div>
          <div class="form-group col-sm-6">
            <label for="">Descripción</label>
            <textarea v-model="form.description.value" rows="4" class="form-control" placeholder="Esta es una marca de venta de ropa, etc..."></textarea>
            <span class="text-danger small" v-if="form.description.required">Este campo es requerido</span>
          </div>
        </div>
      </div>



    <!-- PANE SOCIAL -->
    <div class="tab-pane fade" id="pills-social" role="tabpanel" aria-labelledby="pills-social-tab">
      <div class="row">

        <div class="form-group col-sm-6">
          <label for="">Instagram</label>
          <input type="text" class="form-control" v-model="form.instagram.value">
        </div>

        <div class="form-group col-sm-6">
          <label for="">Facebook</label>
          <input type="text" class="form-control" v-model="form.facebook.value">
        </div>

        <div class="form-group col-sm-6">
          <label for="">Youtube</label>
          <input type="text" class="form-control" v-model="form.youtube.value">
        </div>

        <div class="form-group col-sm-6">
          <label for="">Pinterest</label>
          <input type="text" class="form-control" v-model="form.pinterest.value">
        </div>

        <div class="form-group col-sm-6">
          <label for="">Linkedin</label>
          <input type="text" class="form-control" v-model="form.linkedin.value">
        </div>

      </div>
    </div>

    <!-- PANE CATEGORIAS -->
    <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
      <div class="row" v-if="categories">
        <div class="col-sm-12"><h3>Portada</h3></div>
        <div class="form-group col-sm-6">
          <label for="">Título</label>
          <input type="text" class="form-control" v-model="form.slider_title.value">
          <span class="text-danger small" v-if="form.slider_title.required">Este campo es requerido</span>
        </div>

        <div class="form-group col-sm-6">
          <label for="">Imagen de Portada</label>
          <image-input :saved="form.slider_image.upload" :mwidth="100" :psize="'url'" :index="form.slider_image.index" @changed="setUpload"></image-input>
        </div>

        <div class="form-group col-sm-6">
          <label for="">Link de Botón</label>
          <input type="text" class="form-control" v-model="form.slider_button_link.value">
          <span class="text-danger small" v-if="form.slider_button_link.required">Este campo es requerido</span>
        </div>

        <div class="form-group col-sm-6">
          <label for="">Texto del Botón</label>
          <input type="text" class="form-control" v-model="form.slider_button_text.value">
          <span class="text-danger small" v-if="form.slider_button_text.required">Este campo es requerido</span>
        </div>

        <div class="my-5 w-100" style="height:1px; background: #cecece;"></div>

        <div class="col-sm-12"><h3>Categorías</h3></div>

        <div class="form-group col-sm-6">
          <label for="">Categoria 1</label>
          <select class="custom-select" v-model="form.category_1.value">
            <option selected>Elige una categoría</option>
            <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
          </select>
        </div>

        <div class="form-group col-sm-6">
          <label for="">Imagen de Categoría 1</label>
          <image-input :saved="form.category_image_1.upload" :mwidth="100" :psize="'url'" :index="form.category_image_1.index" @changed="setUpload"></image-input>
        </div>

        <div class="form-group col-sm-6">
          <label for="">Categoria 2</label>
          <select class="custom-select" v-model="form.category_2.value">
            <option selected>Elige una categoría</option>
            <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
          </select>
        </div>

        <div class="form-group col-sm-6">
          <label for="">Imagen de Categoría 2</label>
          <image-input :saved="form.category_image_2.upload" :mwidth="100" :psize="'url'" :index="form.category_image_2.index" @changed="setUpload"></image-input>
        </div>

      </div>
    </div>

    <div class="text-right mt-3">
      <button type="button" class="btn btn-primary" @click.prevent="save()">Guardar</button>
    </div>

  </div>
</div>
</template>

<script>
import ImageInput from './ImageInputComponent.vue';
export default {
  components: {
    'image-input': ImageInput
  },
  props: ['stored_configs'],
  data(){
    return {
      saved: false,
      error: false,
      categories: false,
      form: {
        site_name: {
          index: 'site_name',
          value: this.getIndexValue('site_name'),
          validation: false,
          required: true
        },
        email: {
          index: 'email',
          value: this.getIndexValue('email'),
          validation: false,
          required: true
        },
        phone: {
          index: 'phone',
          value: this.getIndexValue('phone'),
          validation: false,
          required: true
        },
        description: {
          index: 'description',
          value: this.getIndexValue('description'),
          validation: false,
          required: true
        },
        instagram: {
          index: 'instagram',
          value: this.getIndexValue('instagram'),
          validation: false
        },
        facebook: {
          index: 'facebook',
          value: this.getIndexValue('facebook'),
          validation: false
        },
        youtube: {
          index: 'youtube',
          value: this.getIndexValue('youtube'),
          validation: false
        },
        pinterest: {
          index: 'pinterest',
          value: this.getIndexValue('pinterest'),
          validation: false
        },
        linkedin: {
          index: 'linkedin',
          value: this.getIndexValue('linkedin'),
          validation: false
        },
        slider_title: {
          index: 'slider_title',
          value: this.getIndexValue('slider_title'),
          validation: false
        },
        slider_button_link: {
          index: 'slider_button_link',
          value: this.getIndexValue('slider_button_link'),
          validation: false
        },
        slider_button_text: {
          index: 'slider_button_text',
          value: this.getIndexValue('slider_button_text'),
          validation: false
        },
        logo: {
          index: 'logo',
          validation: false,
          required: true,
        },
        category_1: {
          index: 'category_1',
          value: this.getIndexValue('category_1'),
          validation: false,
          required: true,
        },
        category_image_1: {
          index: 'category_image_1',
          validation: false,
          required: true,
        },
        category_2: {
          index: 'category_2',
          value: this.getIndexValue('category_2'),
          validation: false,
          required: true,
        },
        category_image_2: {
          index: 'category_image_2',
          validation: false,
          required: true,
        },
        slider_image: {
          index: 'slider_image',
          validation: false,
          required: true,
        }
      }
    }
  },
  created(){
    this.setUploads([
      'logo',
      'category_image_1',
      'category_image_2',
      'slider_image'
    ]);

    axios.get('/administracion/categorias')
    .then((response) => {
      this.categories = response.data.categories;
    })
  },
  methods:{
    save(){
      axios.post('/administracion/configuracion', {configs: this.form})
      .then(() => {
        this.saved = true;
      })
      .catch(() => {
        this.error = true;
      })
      .then(() => {
        window.scroll({
          top: 0,
          left: 0,
          behavior: 'smooth'
        });
      });
    },
    getIndexValue(index){
      const indexConfig = this.stored_configs.find(config => config.index == index);
      return indexConfig ? indexConfig.value : '';
    },
    setUploads(indexs){
      indexs.forEach((index) => this.setUpload(index));
    },
    setUpload(index, upload){
      var indexConfigUpload = upload;

      if(!indexConfigUpload){
        let indexConfig = this.stored_configs.find(config => config.index == index);
        indexConfigUpload = indexConfig && indexConfig.uploads.length > 0 ? indexConfig.uploads[0] : false;
      }

      this.form[index].upload = indexConfigUpload ? indexConfigUpload : null;
      this.form[index].upload_id = indexConfigUpload ? indexConfigUpload.id : null;
    }
  }
}
</script>
