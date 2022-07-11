<template>
  <div>
    <button
      type="button"
      data-target="#editProductsStatus"
      data-toggle="modal"
      data-original-title="Delete"
    >
      <i class="ti-pencil-alt"></i>
    </button>

    <div class="modal-content" style="border: 0px;">
      <div
        class="modal fade"
        id="editProductsStatus"
        tabindex="-1"
        role="dialog"
        aria-labelledby="edit"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content text-left">
            <div class="modal-header">
              <h3 class="modal-title" id="exampleModalLabel">
                <strong>{{ messagetitle }}</strong>
              </h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i aria-hidden="true" class="ki ki-close"></i>
              </button>
            </div>
            <!-- Delete Product -->
            <div class="modal-body">
              <form>
                <div class="form-group">
                  <label for="status">{{statusproduct}}</label>
                  <select v-model="status" id="status" class="form-control status">
                    <option value="1">{{active}}</option>
                    <option value="0">{{inactive}}</option>
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
                    @click="editStatus"
                    class="btn btn-primary font-weight bolder edit_status"
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
  props: [
    "messagetitle",
    "cancel",
    "savechanges",
    "active",
    "inactive",
    "statusproduct"
  ],
  data() {
    return {
      status: ""
    };
  },
  methods: {
    editStatus() {
      $("#editProductsStatus").modal("hide");
      this.$emit("editstatus", this.status);
    }
  }
};
</script>
