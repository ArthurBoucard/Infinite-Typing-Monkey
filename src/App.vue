<template>
  <div id="app">
    <MonkeyComponent />
    <SimpleKeyboard
      @onChange="onChange"
      @onKeyPress="onKeyPress"
      :input="generatedText"
    />
    <textarea
      :value="input"
      class="input"
      @input="onInputChange"
      placeholder="Tap on the virtual keyboard to start"
    ></textarea>
    <TextGenerator @textGenerated="setText"/>
  </div>
</template>

<script>
import MonkeyComponent from './components/Monkey.vue';
import TextGenerator from './components/TextGenerator.vue';
import SimpleKeyboard from './components/Keyboard.vue';
import { eventBus } from './main';

export default {
  name: 'App',
  components: {
    MonkeyComponent,
    TextGenerator,
    SimpleKeyboard
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
    onChange(input) {
      this.input = input;
    },
    onKeyPress(button) {
      console.log("button", button);
    },
    onInputChange(input) {
      this.input = input.target.value;
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
