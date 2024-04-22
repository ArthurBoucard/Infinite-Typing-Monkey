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
      <div class="preview">
        <TextGenerator @textGenerated="setText"/>
      </div>
      <p>{{ storedText }}{{ generatedText }}</p>
    </div>
  </div>
</template>

<script>
import TextGenerator from './components/TextGenerator.vue';
// import SimpleKeyboard from './components/Keyboard.vue';
import axios from 'axios';

export default {
  name: 'App',
  components: {
    TextGenerator,
    // SimpleKeyboard
  },
  data: () => ({
    input: "",
    generatedText: "",
    storedText: "",
  }),
  mounted() {
    let apiText = '';
    axios.get('http://127.0.0.1:8000/text')
      .then((response) => {
        response.data.forEach(element => {
          apiText += element.content
        });
        this.storedText = apiText;
      })
      .catch((error) => {
        console.error(error);
      });

    this.interval = setInterval(this.generateText, 10);
  },
  methods: {
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
