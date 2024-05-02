<template>
  <div id="generatedtext">
    <div class="header">
      <img src="./assets/monkey.gif" alt="Monkey" class="gif-monkey" />
      <div class="content">
        <h1>Infinite Typing Monkey</h1>
        <p><a href="https://en.wikipedia.org/wiki/Infinite_monkey_theorem">The Infinite Typing Monkey Theorem</a> states that a monkey hitting keys at random on a typewriter keyboard for an infinite amount of time will almost surely type a given text, such as the complete works of William Shakespeare.</p>
        <div class="column-flex">
          <div class="preview">
            <h3 ref="liveTyping" @click="startBottomScroll">⌨️ Live typing :</h3>
            <img  @click="startBottomScroll" src="./assets/typewriter.png" alt="typewriter" class="png-typewriter" />
            <TextGenerator  @click="startBottomScroll" class="TextGenerator" @textGenerated="setText"/>
          </div>
          <!-- <WordSearcher /> -->
          <div class="statistics">
            <h3>📊 Live statistics</h3>
            <p>Total characters: <b>{{ formatTotalLength(generatedText.length) }}</b></p>
            <p>Time spent typing: <b>{{ formattedTime }}</b></p>
          </div>
          <div class="router">
            <h3><RouterLink to="/fulltext">📄 Go to already typed text</RouterLink></h3>
          </div>
        </div>
      </div>
    </div>
    <div class="divider"></div>
    <!-- <SimpleKeyboard
      @onChange="onChange"
      :input="generatedText"
    /> -->
    <div class="generatedText">
      <p>...{{ generatedText }}</p>
    </div>
  </div>
</template>

<script>
import TextGenerator from './components/TextGenerator.vue';
// import SimpleKeyboard from './components/Keyboard.vue';
// import WordSearcher from './components/WordSearcher.vue';

export default {
  name: 'generatedText',
  components: {
    TextGenerator,
    // WordSearcher,
    // SimpleKeyboard
  },
  data: () => ({
    input: "",
    generatedText: "",
    storedText: "",
    autoScrollInterval: null,
    lastScrollTop: 0,
    scrollingDown: false,
    intervalId: null,
    elapsedSeconds: 0,
  }),
  mounted() {
    window.addEventListener('scroll', this.handleScroll);
    this.startClock();
  },
  methods: {
    setText(text) {
      this.generatedText = text;
    },
    startBottomScroll() {
      this.autoScrollInterval = setInterval(() => {
        window.scrollTo(0, document.body.scrollHeight);
      }, 100);
    },
    handleScroll() {
      let st = document.documentElement.scrollTop;
      if (st > this.lastScrollTop) {
        this.scrollingDown = true;
      } else {
        this.scrollingDown = false;
      }
      this.lastScrollTop = st <= 0 ? 0 : st;
      if (!this.scrollingDown) {
        clearInterval(this.autoScrollInterval);
      }
    },
    destroyed() {
      clearInterval(this.autoScrollInterval);
      window.removeEventListener('scroll', this.handleScroll);
    },
    formatTotalLength(length) {
      return length.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    },
    startClock() {
      if (this.intervalId) {
        clearInterval(this.intervalId);
      }
      this.intervalId = setInterval(() => {
        this.elapsedSeconds++;
      }, 1000);
    },
    formatTotalTime(totalSeconds) {
      const days = Math.floor(totalSeconds / (60 * 60 * 24));
      const hours = Math.floor((totalSeconds % (60 * 60 * 24)) / (60 * 60));
      const minutes = Math.floor((totalSeconds % (60 * 60)) / 60);
      const seconds = totalSeconds % 60;

      return `${days}d ${hours}h ${minutes}m ${seconds}s`;
    },
  },
  computed: {
    formattedTime() {
      return this.formatTotalTime(this.elapsedSeconds);
    },
  },
};
</script>

<style>
  #generatedtext {
    margin: 0;
    padding: 0;
    background-color: #ffcc99;
    height: 100%;
    font-size: 1.8vh;
    font-family: monospace;
  }

  .divider {
      width: 98%;
      margin-left: 1%;
      margin-top: 1vh;
      height: 2px;
      background-color: #000;
  }

  .header {
    display: flex;
    align-items: center;
  }

  .gif-monkey {
    width: 30vh;
    height: auto;
    margin-right: 2vh;
  }

  .content {
    flex: 1;
  }

  .column-flex {
    display: flex;
    flex-direction: row;
    margin-top: 3vh;
  }

  .preview {
    position: relative;
    flex-basis: 30vh;
    /* display: flex; */
  }

  .preview:hover {
    cursor: pointer;
  }

  .router {
    margin-left: 5vh;
  }

  .statistics {
    margin-left: 5vh;
  }

  .statistics p {
    margin-left: 4vh;
    font-size: 1.5vh;
  }

  .png-typewriter {
    width: 80%;
    margin-right: 1vh;
    margin-left: 4vh;
    /* position: absolute; */
  }

  .TextGenerator {
    top: 28%;
    left: 36%;
    /* transform: translate(-50%, -50%); */
    position: absolute;
  }

  .generatedText {
    margin: 2vh;
    width: 203vh;
    word-break: break-all;
    overflow-wrap: break-word;
    white-space: pre-wrap;
  }
</style>
