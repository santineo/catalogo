<template>
  <div>
    <a class="navbar-icon navbar-icon-search" href="javascript: void(0)" @click.prevent="searching = true"><i class="icon-search"></i><span class="sr-only">{{ label }}</span></a>
    <transition name="fade">
      <div class="navbar-search" v-show="searching">
        <form action="/productos" id="search" role="search" :aria-label="aria" @submit="onSubmit">
          <input class="navbar-search-input" type="text" name="term" :placeholder="placeholder" v-model="term">
          <button class="navbar-search-submit" type="submit" :disabled="!canSubmit"><span class="sr-only">{{ label }}</span> <i class="icon-search"></i></button>
          <a href="javascript: void(0)" class="navbar-search-close" @click.prevent="searching = false"><span class="sr-only">Close {{ label }}</span><i class="icon icon-cancel"></i></a>
        </form>
      </div>
    </transition>
  </div>
</template>

<script>
export default {
  props: ['label', 'placeholder', 'aria'],
  data(){
    return {
      searching: false,
      term: ''
    }
  },
  computed:{
    canSubmit(){
      return this.term.length > 2;
    }
  },
  methods: {
    onSubmit(e){
      if(!this.canSubmit) e.preventDefault();
    }
  }
}
</script>
