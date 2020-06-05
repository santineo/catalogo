<template>
  <div>
  <div class="row" v-if="list.length">
    <div class="col-sm-6">
      <div class="h5">
        Grupos Disponibles
      </div>
      <ul v-if="availables.length">
        <li v-for="item in availables" class="d-flex align-items-center justify-content-between" :key="item.id">
          <div>{{ item.name }}</div>
          <button type="button" class="btn btn-sm btn-success" @click="selected.push(item.id)"><i class="fas fa-plus"></i></button>
        </li>
      </ul>
      <div class="alert alert-info" v-if="!availables.length">
        Se han agregado todos los items de la lista
      </div>
    </div>
    <div class="col-sm-6">
      <div class="h5">Grupos Asignados</div>
      <ul v-if="selected.length">
        <li v-for="item in reserved" class="d-flex align-items-center justify-content-between" :key="item.id">
          <div>
            {{ item.name }}
            <input type="hidden" :name="`${name}[]`" :value="item.id">
          </div>
          <button type="button" class="btn btn-sm btn-danger" @click="remove(item.id)"><i class="fas fa-times"></i></button>

        </li>
      </ul>
      <div class="alert alert-info" v-if="!selected.length">
        Aún no se han agregado items.
      </div>
    </div>
  </div>
  <div v-if="!list.length" class="alert alert-warning">
    No hay items creados
  </div>
</div>
</template>

<script>
export default {
  props: ['feed_uri', 'name', 'saved'],
  data(){
    return {
      selected: [],
      list: [],
    }
  },
  computed:{
    availables(){
      return this.list.filter((item) => {
        return !this.selected.length || this.selected.find(selection => selection != item.id);
      }).sort();
    },
    reserved(){
      return this.list.filter((item) => {
        return this.selected.find(selection => selection == item.id);
      }).sort();
    }
  },
  created(){
    this.saved.forEach(id => this.selected.push(id));
    axios.get(this.feed_uri)
    .then((response) => {
      this.list = response.data.list;
    })
    .catch((error) => {

    })
  },
  methods:{
    remove(id){
      this.selected.splice(this.selected.indexOf(id),1);
    }
  }
}
</script>
