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
body, html, #app {
  margin: 0;
  padding: 0;
  background-color: #ffcc99;
  height: 100%;
}
</style>
