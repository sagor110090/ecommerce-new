<template>
  <div>
    <content-placeholders>
      <!-- <content-placeholders-heading :img="false" /> -->
      <content-placeholders-text :lines="10" />
    </content-placeholders>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
