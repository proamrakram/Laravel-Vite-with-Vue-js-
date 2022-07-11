<template>
  <div>
    <button
      type="button"
      data-target="#editProductsUnits"
      data-toggle="modal"
      data-original-title="Delete"
    >
      <i class="ti-pencil-alt"></i>
    </button>

    <div class="modal-content" style="border: 0px;">
      <div
        class="modal fade"
        id="editProductsUnits"
        tabindex="-1"
        role="dialog"
        aria-labelledby="edit"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content text-left">
            <div class="modal-header">
              <h3 class="modal-title" id="exampleModalLabel">
                <strong>{{messagetitle}}</strong>
              </h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i aria-hidden="true" class="ki ki-close"></i>
              </button>
            </div>
            <!-- Delete Product -->
            <div class="modal-body">
              <form>
                <div class="form-group">
                  <label for="unit">{{ unitproduct }}</label>
                  <select class="form-control" id="unit" v-model="unit" required>
                    <option v-for="unit in units" :key="unit.index" :value="`${unit}`">{{unit}}</option>
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
                    class="btn btn-primary font-weight bolder edit_unit"
                    @click="editUnit"
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
  props: ["cancel", "savechanges", "messagetitle", "unitproduct"],

  data() {
    return {
      unit: "",
      units:[],
    };
  },

  created() {
    this.getUnits();
  },

  methods: {
    editUnit() {
      $("#editProductsUnits").modal("hide");
      this.$emit("editunit", this.unit);
    },

    async getUnits() {
      const response = await axios.get("http://localhost:8000/product/units");
      this.units = response.data.units;
    },


  }
};
</script>


