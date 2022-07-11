<template>
  <div id="delete">
    <button
      type="button"
      v-bind:data-target="`#deleteProduct${product.id}`"
      class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn"
      data-toggle="modal"
      data-original-title="Delete"
    >
      <i class="ti-close" aria-hidden="true"></i>
    </button>

    <div class="modal-content" style="border: 0px;">
      <div
        class="modal fade"
        v-bind:id="`deleteProduct${product.id}`"
        tabindex="-1"
        role="dialog"
        aria-labelledby="edit"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content text-left">
            <div class="modal-header">
              <h3 class="modal-title" id="exampleModalLabel">
                <strong>{{deleting}}</strong>
              </h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i aria-hidden="true" class="ki ki-close"></i>
              </button>
            </div>
            <!-- Delete Product -->
            <div class="modal-body">
              <form>
                <div class="form-group">
                  <label for="message-text" class="form-control-label">{{ messagesure }}</label>
                </div>

                <div class="modal-footer">
                  <button
                    type="button"
                    class="btn btn-light-primary font-weight-bold"
                    data-dismiss="modal"
                  >{{cancel}}</button>
                  <button
                    type="button"
                    class="btn btn-primary font-weight bolder"
                    @click="deleteProduct(product.id)"
                  >{{ deleteproduct}}</button>
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
  name: "deleteProduct",
  props: ["product", "deleteproduct", "messagesure", "deleting", "cancel"],

  data() {
    return {
      name: ""
    };
  },

  methods: {
    async deleteProduct(product) {
      try {
        const response = await axios.delete(
          `http://localhost:8000/product/delete/${product}`
        );
        this.$emit("delete", true);
        $(`#deleteProduct${product}`).modal("hide");

      } catch (error) {
        console.log(error);
      }
    }
  }
};
</script>
