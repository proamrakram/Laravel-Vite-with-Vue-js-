<template>
  <v-pagination v-model="currentPage" :length="lastPage"></v-pagination>
</template>


<script>
export default {
  name: "Pagination",

  computed: {
    currentPage: {
      get() {
        return this.$store.state.products.currentPage;
      }
    },

    lastPage: {
      get() {
        return this.$store.state.products.lastPage;
      }
    }
  },
  total: {
    get() {
      return this.$store.state.products.total;
    }
  }
};
</script>
