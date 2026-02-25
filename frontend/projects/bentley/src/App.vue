<script setup>
  import { RouterView } from 'vue-router'
  import Nav from './components/base/Nav.vue'
  import Footer from './components/base/Footer.vue'

  import { onMounted } from 'vue';
  import { TranslationStore } from '@/stores/translations';

  const translationStore = TranslationStore();

  onMounted(() => {
    translationStore.fetchTranslations();
  });
</script>

<template>
  <Nav />
  <RouterView />
  <Footer />
</template>

<style scoped>

</style>
