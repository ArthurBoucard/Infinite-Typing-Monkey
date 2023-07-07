<template>
  <div id="app">
    <MonkeyComponent />
    <TextGenerator />
  </div>
</template>

<script>
import MonkeyComponent from './components/Monkey.vue';
import TextGenerator from './components/TextGenerator.vue';

export default {
  name: 'App',
  components: {
    MonkeyComponent,
    TextGenerator
  }
};
</script>

<style>
/* App styles go here */
</style>
