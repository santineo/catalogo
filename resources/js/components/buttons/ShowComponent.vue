<template>
  <button type="button" @click="showModal" class="btn btn-sm btn-primary text-light"><i class="fas fa-eye"></i><span class="sr-only">Ver</span></button>
</template>

<script>
export default {
  props: ['url'],
  methods:{
    showModal(){
      Modal.show({
        title: 'Contacto'
        text: false,
        loading: true
      });
      axios.get(this.url)
      .then((response) => {
        Modal.text = response.view;
      })
      .catch((error) => {
        Modal.throw();
      })
      .then((response) => {
        Modal.loading = false;
      })
    }
  }
}
</script>
