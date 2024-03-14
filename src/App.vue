<template>
  <div id="app">
    <MonkeyComponent />
    <!-- <SimpleKeyboard
      @onChange="onChange"
      :input="generatedText"
    /> -->
    <TextGenerator @textGenerated="setText"/>
  </div>
</template>

<script>
import MonkeyComponent from './components/Monkey.vue';
import TextGenerator from './components/TextGenerator.vue';
// import SimpleKeyboard from './components/Keyboard.vue';
import { eventBus } from './main';

export default {
  name: 'App',
  components: {
    MonkeyComponent,
    TextGenerator,
    // SimpleKeyboard
  },
  data: () => ({
    input: "",
    generatedText: ""
  }),
  mounted() {
    eventBus.$on('textGenerated', (text) => {
      this.generatedText = text;
    });
  },
  methods: {
    onChange(generatedText) {
      this.input = generatedText.slice(-1);
    },
    onInputChange(generatedText) {
      this.input = generatedText.slice(-1);
    },
    setText(text) {
      this.generatedText = text;
    }
  },
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
