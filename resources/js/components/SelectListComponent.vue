<template>
  <div>
  <div class="row" v-if="list.length">
    <div class="col-sm-6">
      <div class="h5">
        {{ label }} Disponibles
      </div>
      <ul v-if="availables.length" class="list-group">
        <li v-for="item in availables" class="list-group-item py-2 d-flex align-items-center justify-content-between" :key="item.id">
          <div>{{ item.name }}</div>
          <a href="javascript: void(0)" class="text-success" @click.prevent="add(item.id)"><i class="fas fa-plus"></i></a>
        </li>
      </ul>
      <div class="alert alert-info py-2" v-if="!availables.length">
        Se han agregado todos los items de la lista
      </div>
    </div>
    <div class="col-sm-6">
      <div class="h5">{{ label }} Asignados</div>
      <ul v-if="selected.length" class="list-group">
        <li v-for="item in reserved" class="list-group-item py-2 d-flex align-items-center justify-content-between" :key="item.id">
          <div>
            {{ item.name }}
            <input v-if="name" type="hidden" :name="`${name}[]`" :value="item.id">
          </div>
          <a href="javascript: void(0)" class="text-danger" @click.prevent="remove(item.id)"><i class="fas fa-times"></i></a>
        </li>
      </ul>
      <div class="alert alert-info py-2" v-if="!selected.length">
        Aún no se han agregado items.
      </div>
    </div>
  </div>
  <div v-if="!list.length" class="alert alert-warning py-2">
    No hay items creados
  </div>
</div>
</template>

<script>
export default {
  props: ['feed_uri', 'name', 'saved', 'label'],
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
    if(this.saved) this.saved.forEach(id => this.selected.push(id));

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
      this.update()
    },
    add(id){
      this.selected.push(id);
      this.update()
    },
    update(){
      this.$emit('updated', this.selected);
    }
  }
}
</script>

<style scoped>
  .list-group{
    max-height: 220px;
    overflow-y: auto;
  }
</style>
