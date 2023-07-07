<template>
  <div id="app">
    <MonkeyComponent /> <!-- Updated component name -->
    <TextGenerator />
  </div>
</template>

<script>
import MonkeyComponent from './components/Monkey.vue'; // Updated import statement
import TextGenerator from './components/TextGenerator.vue';

export default {
  name: 'App',
  components: {
    MonkeyComponent, // Updated component name
    TextGenerator
  }
};
</script>

<style>
/* App styles go here */
</style>
