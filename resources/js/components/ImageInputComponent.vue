<template>
  <div>
    <div v-if="upload">
      <img :src="upload.thumb" alt="">
      <input type="hidden" name="uploads[]" :value="upload.id">
    </div>
    <div class="p-1">
      <input type="file" id="upload" class="sr-only" ref="file" @change="save()" />
      <label for="upload"class="btn btn-info text-white">{{ label }}</label>
      <errors v-if="errors" :errors="errors"></errors>
    </div>
  </div>
</template>

<script>
export default {
  props: ['saved'],
  data(){
    return {
      upload: this.saved,
      errors: false,
    }
  },
  computed: {
    label(){
      return this.upload ? 'Cambiar Imagen' : 'Subir Imagen';
    }
  },
  methods:{
    save(){
      this.errors = false;
      let formData = new FormData();
      formData.append('image', this.$refs.file.files[0]);
      axios.post('/administracion/uploads',
      formData,
      {headers: {'Content-Type': 'multipart/form-data'}})
      .then((response) => {
        this.upload = response.data.image;
      })
      .catch((error) => {
        if (error.response.status == 422){
          this.errors = error.response.data.errors;
         }
      });
    }
  }
}
</script>

<style lang="css">
</style>
