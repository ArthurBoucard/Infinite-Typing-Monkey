<template>
  <div id="app">
    <div class="header">
      <img src="./assets/monkey.gif" alt="Monkey" class="image" />
      <div class="content">
        <h1>Infinite Typing Monkey</h1>
        <p><a href="https://en.wikipedia.org/wiki/Infinite_monkey_theorem">The Infinite Typing Monkey Theorem</a> states that a monkey hitting keys at random on a typewriter keyboard for an infinite amount of time will almost surely type a given text, such as the complete works of William Shakespeare.</p>
      </div>
    </div>
    <!-- <SimpleKeyboard
      @onChange="onChange"
      :input="generatedText"
    /> -->
    <div class="generatedText">
      <TextGenerator @textGenerated="setText"/>
    </div>
  </div>
</template>

<script>
import TextGenerator from './components/TextGenerator.vue';
// import SimpleKeyboard from './components/Keyboard.vue';
import { eventBus } from './main';

export default {
  name: 'App',
  components: {
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

.header {
  display: flex;
  align-items: center;
}

.image {
  width: 150px;
  height: auto;
  margin-right: 20px;
}

.content {
  flex: 1;
}

.generatedText {
  margin: 20px;
  width: 98%;
  word-break: break-word;
}
</style>./components/SimpleKeyboard.vue
