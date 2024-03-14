<template>
  <div class="keyboardContainer">
    <div class="simple-keyboard-main"></div>

    <div class="controlArrows">
      <div class="simple-keyboard-control"></div>
      <div class="simple-keyboard-arrows"></div>
    </div>

    <div class="numPad">
      <div class="simple-keyboard-numpad"></div>
      <div class="simple-keyboard-numpadEnd"></div>
    </div>
  </div>
</template>

<script>
import Keyboard from "simple-keyboard";
import "simple-keyboard/build/css/index.css";

  export default {
    name: "SimpleKeyboard",
    props: {
      input: String
    },
    data: () => ({
      keyboard: null,
  }),
  mounted() {
    let commonKeyboardOptions = {
      onChange: input => this.onChange(input),
      // onKeyPress: button => this.onKeyPress(button),
      newLineOnEnter: true,
      theme: "simple-keyboard hg-theme-default hg-layout-default",
      debug: true
    };
    this.keyboard = new Keyboard(".simple-keyboard-main", {
      ...commonKeyboardOptions,
      /**
       * Layout by:
       * Sterling Butters (https://github.com/SterlingButters)
       */
      layout: {
        default: [
          "` 1 2 3 4 5 6 7 8 9 0 - = {backspace}",
          "{tab} q w e r t y u i o p [ ] \\",
          "{capslock} a s d f g h j k l ; ' {enter}",
          "{shiftleft} z x c v b n m , . / {shiftright}",
          "{space}"
        ],
        shift: [
          "~ ! @ # $ % ^ & * ( ) _ + {backspace}",
          "{tab} Q W E R T Y U I O P { } |",
          '{capslock} A S D F G H J K L : " {enter}',
          "{shiftleft} Z X C V B N M < > ? {shiftright}",
          "{space}"
        ]
      },
      display: {
        "{escape}": "esc ⎋",
        "{tab}": "tab ⇥",
        "{backspace}": "backspace ⌫",
        "{enter}": "enter ↵",
        "{capslock}": "caps lock ⇪",
        "{shiftleft}": "shift ⇧",
        "{shiftright}": "shift ⇧"
      }
    });
    this.keyboard.setInput(this.input);
  },
  methods: {
    onChange(input) {
      this.$emit("onChange", input);
      this.$emit("onKeyPress", input.slice(-1));
    },
    // onKeyPress(button) {
    //   this.$emit("onKeyPress", button);
    //   /**
    //    * If you want to handle the shift and caps lock buttons
    //    */
    //   if (
    //     button === "{shift}" ||
    //     button === "{shiftleft}" ||
    //     button === "{shiftright}" ||
    //     button === "{capslock}"
    //   )
    //     this.handleShift();
    // },
    // handleShift() {
    //   let currentLayout = this.keyboard.options.layoutName;
    //   let shiftToggle = currentLayout === "default" ? "shift" : "default";
    //   this.keyboard.setOptions({
    //     layoutName: shiftToggle
    //   });
    // }
  },
  watch: {
    input(input) {
      this.keyboard.setInput(input);
    }
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
