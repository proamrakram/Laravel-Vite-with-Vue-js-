<template>
  <div>
    <button
      type="button"
      data-target="#editProductsExpiryDate"
      data-toggle="modal"
      data-original-title="Delete"
    >
      <i class="ti-pencil-alt"></i>
    </button>

    <div class="modal-content" style="border: 0px;">
      <div
        class="modal fade"
        id="editProductsExpiryDate"
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
            <!-- Delete Product -->
            <div class="modal-body">
              <form>
                <div class="form-group">
                  <label for="price">{{expirationdate}}</label>
                  <input
                    type="date"
                    v-model="expiration_date"
                    id="expiry_date"
                    class="form-control expiry_date"
                  />
                </div>

                <div class="modal-footer">
                  <button
                    type="button"
                    class="btn btn-light-primary font-weight-bold"
                    data-dismiss="modal"
                  >{{cancel}}</button>
                  <button
                    type="button"
                    class="btn btn-primary font-weight bolder edit_expiry_date"
                    @click="editExpirationDate"
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
  name: "editProductsExpiryDate",
  props: ["expirationdate", "messagetitle", "savechanges", "cancel"],
  data() {
    return {
      expiration_date: ""
    };
  },

  methods: {
    editExpirationDate() {
      $("#editProductsExpiryDate").modal("hide");
      this.$emit("editexpirationdate", this.expiration_date);
    }
  }
};
</script>




