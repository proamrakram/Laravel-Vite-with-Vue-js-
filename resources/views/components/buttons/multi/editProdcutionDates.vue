<template>
  <div>
    <button
      type="button"
      data-target="#editProductsProductionDate"
      data-toggle="modal"
      data-original-title="Delete"
    >
      <i class="ti-pencil-alt"></i>
    </button>

    <div class="modal-content" style="border: 0px;">
      <div
        class="modal fade"
        id="editProductsProductionDate"
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
                  <label for="price">{{productiondate}}</label>
                  <input
                    type="date"
                    v-model="production_date"
                    id="production_date"
                    class="form-control production_date"
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
                    class="btn btn-primary font-weight bolder edit_production_date"
                    @click="editProductionDate"
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
  name: "editProductsProductionDate",
  props: ["productiondate", "messagetitle", "savechanges", "cancel"],
  data() {
    return {
      production_date: ""
    };
  },
  methods: {
     editProductionDate(event) {
      $("#editProductsProductionDate").modal("hide");
      this.$emit("editproductiondate", this.production_date);
    }
  }
};
</script>

