<template>
  <div>
    <div v-if="error" class="alert alert-danger">Ha ocurrido un error al crear {{ title }}</div>
    <div class="d-flex">
      <model-select
      :options="options"
      v-model="item"
      :placeholder="(placeholder ? placeholder : 'Seleccione uno')">
    </model-select>
    <button type="button" class="btn btn-sm btn-primary" v-if="callback" :disabled="loading" @click="modalAdd()"><i class="fas fa-plus"></i></button>
    <input type="hidden" :name="input_name" v-model="item">
  </div>
</div>
</template>

<script>
import 'vue-search-select/dist/VueSearchSelect.css'
import { ModelSelect } from 'vue-search-select'
export default {
  props: ['default_options', 'default_value', 'placeholder', 'callback', 'title', 'input_name'],
  components: {
    ModelSelect
  },
  data(){
    return {
      loading: false,
      options: [],
      item: '',
      error: false
    }
  },
  created(){
    this.assignOptions(this.default_options);
    this.assignValue(this.default_value);
  },
  methods:{
    handleCreated(name){
      const option = GlobalFunctions[this.callback](name, (option) => {
        if(!option) {
          this.error = true;
          return;
        }
        this.error = false;
        this.assignOption(option);
        this.assignValue(option.value);
      });
    },
    modalAdd(){
      Modal.create({
        input:{
          label: 'Nombre',
          value: ''
        },
        callback: this.handleCreated,
        title: 'Agregar ' + this.title
      });
    },
    assignValue(value){
      if(value) this.item = parseInt(value);
    },
    assignOption(option){
      this.options.push(option);
    },
    assignOptions(options){
      if(!options) return;

      options.forEach((option) => {
        this.assignOption({
          value: option.id,
          text: option.name
        });
      })
    }
  }
}
</script>
