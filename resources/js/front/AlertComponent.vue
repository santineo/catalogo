<template>
  <div v-if="Alert.show" class="alert position-relative" :class="`alert-${Alert.type}`">
    <a href="javascript: void(0);" @click.prevent="Alert.close()" class="position-absolute" style="top: 10px; right:10px;"><i class="fas fa-times"></i></a>
    <div style="font-size: 1.25rem" class="font-weight-bold" v-if="Alert.title" v-html="Alert.title">{{ Alert.title }}</div>
    <div v-if="Alert.message" v-html="Alert.message"></div>
  </div>
</template>

<script>
export default {
  data(){
    return {
      Alert
    }
  }
}
</script>
