<template>
  <div>
    <button
      type="button"
      data-target="#editProductCategory"
      data-toggle="modal"
      data-original-title="Delete"
    >
      <i class="ti-pencil-alt"></i>
    </button>

    <div class="modal-content" style="border: 0px;">
      <div
        class="modal fade"
        id="editProductCategory"
        tabindex="-1"
        role="dialog"
        aria-labelledby="edit"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content text-left">
            <div class="modal-header">
              <h3 class="modal-title" id="exampleModalLabel">
                <strong>{{ messagetitle}}</strong>
              </h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i aria-hidden="true" class="ki ki-close"></i>
              </button>
            </div>

            <!-- Delete Product  -->
            <div class="modal-body">
              <form>
                <div class="form-group">
                  <label for="category">{{ category }}</label>
                  <select class="form-control" id="category_id" v-model="category_id" required>
                    <option
                      v-for="category in categories"
                      :key="category.id"
                      :value="`${category.id}`"
                    >{{category.ar_name}}</option>
                  </select>
                </div>
                <div class="modal-footer">
                  <button
                    type="button"
                    class="btn btn-light-primary font-weight-bold"
                    data-dismiss="modal"
                  >{{cancel}}</button>
                  <button
                    type="button"
                    class="btn btn-primary font-weight bolder edit_category"
                    @click="editCategory"
                  >{{savechanges}}</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["cancel", "savechanges", "messagetitle", "category"],

  data() {
    return {
      category_id: "",
      categories: []
    };
  },

  created() {
    this.getCategories();
  },

  methods: {
    editCategory() {
      $("#editProductCategory").modal("hide");
      this.$emit("editcategory", this.category_id);
    },

    async getCategories() {
      const response = await axios.get("http://localhost:8000/category/index");
      this.categories = response.data.categories;
    }
  }
};
</script>
