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
      this.generateText(); // Initial text generation
      this.interval = setInterval(this.generateText, 500); // Start text generation interval
    },
    beforeUnmount() {
      clearInterval(this.interval); // Clear interval to prevent memory leaks
    },
    methods: {
      generateText() {
        this.generatedText += getRandomText();
        this.$emit('textGenerated', this.generatedText); // Emit event to parent component
      }
    }
  };
  
  function getRandomText() {
    // Generate and return random text (you can customize this function)
    const text = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789 -.,;:!?()';
    return Array.from({ length: 10 }, () => text[Math.floor(Math.random() * text.length)]).join('');
  }
</script>

<style scoped>
  /* .text-generator {
  }
  
  .text-area {
  } */
</style>
  