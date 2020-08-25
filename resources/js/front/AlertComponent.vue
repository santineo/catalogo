<template>
  <div v-if="Alert.show" class="alert position-relative" :class="Alert.type">
    <a href="javascript: void(0);" class="alert-close" @click.prevent="Alert.close()" v-if="Alert.canClose"><i class="fas fa-times"></i></a>
    <div class="alert-title" v-if="Alert.title" v-html="Alert.title">{{ Alert.title }}</div>
    <div class="alert-message" v-if="Alert.message" v-html="Alert.message"></div>
  </div>
</template>

<script>
export default {
  props: ['show', 'type', 'title','message'],
  data(){
    return {
      Alert
    }
  },
  created(){
    if(this.show) Alert.open(this.type, this.message, this.title);
  }
}
</script>
