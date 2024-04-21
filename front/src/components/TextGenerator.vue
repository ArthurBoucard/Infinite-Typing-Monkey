<template>
  <div class="text-generator">
    <div class="text-area">
      <p>{{ generatedText }}</p>
    </div>
  </div>
</template>
  
<script>
  export default {
    name: 'TextGenerator',
    data() {
      return {
        generatedText: ''
      };
    },
    mounted() {
      this.generateText();
      this.interval = setInterval(this.generateText, 10);
    },
    beforeUnmount() {
      clearInterval(this.interval);
    },
    methods: {
      generateText() {
        this.generatedText += getRandomText();
        this.$emit('textGenerated', this.generatedText);
      }
    }
  };
  
  function getRandomText() {
    // Generate and return random text (you can customize this function)
    // const text = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789      -.,;:!?()';
    const text = 'abcdefghijklmnopqrstuvwxyz';
    return Array.from({ length: 1 }, () => text[Math.floor(Math.random() * text.length)]).join('');
  }
</script>

<style scoped>
  /* .text-generator {
  }
  
  .text-area {
  } */
</style>
  