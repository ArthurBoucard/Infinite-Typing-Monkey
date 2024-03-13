<template>
  <div id="app">
    <MonkeyComponent />
    <SimpleKeyboard />
    <TextGenerator />
  </div>
</template>

<script>
import MonkeyComponent from './components/Monkey.vue';
import TextGenerator from './components/TextGenerator.vue';
import SimpleKeyboard from './components/Keyboard.vue';

export default {
  name: 'App',
  components: {
    MonkeyComponent,
    TextGenerator,
    SimpleKeyboard
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
</style>./components/SimpleKeyboard.vue
