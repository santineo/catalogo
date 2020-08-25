<template>
  <transition name="fade">
    <div v-show="loading">
      <div class="position-absolute d-flex align-items-center justify-content-center" style="z-index: 10;top:0; left:0; right:0; bottom:0; background-color: rgba(255, 255,255, 0.7);">
        <div class="text-center">
          <div style="font-size: 1.6rem;"><i class="fas fa-spinner fa-spin"></i></div>
          <div>{{ text ? text : 'Cargando...' }}</div>
        </div>
      </div>
  </div>
  </transition>
</template>

<script>
export default {
  props: ['loading', 'text']
}
</script>
