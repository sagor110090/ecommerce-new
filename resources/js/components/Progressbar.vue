<template>
  <div>
    <vue-progress-bar></vue-progress-bar>
  </div>
</template>

<script>
export default {
  mounted() {
    this.$Progress.start();
    window.addEventListener("load", () => {
      this.$Progress.finish();
    });
    // setTimeout(
    //   function() {
    //     this.$Progress.finish();
    //   }.bind(this),
    //   2000
    // );
  }
};
</script>
