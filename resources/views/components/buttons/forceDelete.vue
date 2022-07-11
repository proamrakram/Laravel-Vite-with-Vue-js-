<template>
  <div id="force_delete">
    <a
      data-toggle="modal"
      href="javascript:void(0)"
      v-bind:data-target="`#forceDeleteProduct${product.id}`"
      class="btn btn-danger btn-sm"
    >{{forcedelete}}</a>

    <div class="modal-content" style="border: 0px;">
      <div
        class="modal fade"
        v-bind:id="`forceDeleteProduct${product.id}`"
        tabindex="-1"
        role="dialog"
        aria-labelledby="edit"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content text-left">
            <div class="modal-header">
              <h3 class="modal-title" id="exampleModalLabel">
                <strong>{{forcedeleteproduct}}</strong>
              </h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i aria-hidden="true" class="ki ki-close"></i>
              </button>
            </div>

            <!-- Delete Product -->
            <div class="modal-body">
              <form>
                <div class="form-group">
                  <label for="name">{{nameproduct}}</label>
                  <input
                    type="text"
                    class="form-control"
                    id="name"
                    name="name"
                    v-model="name"
                    readonly
                  />
                </div>
                <!-- Production Date -->
                <div class="form-group">
                  <label for="production_date">{{productiondate}}</label>
                  <input
                    type="date"
                    class="form-control"
                    id="production_date"
                    name="production_date"
                    v-model="production_date"
                    readonly
                  />
                </div>
                <!-- Expired Date -->
                <div class="form-group">
                  <label for="expiry_date">{{expirationdate}}</label>
                  <input
                    type="date"
                    class="form-control"
                    id="expiry_date"
                    name="expiry_date"
                    v-model="expiry_date"
                    readonly
                  />
                </div>
                <!-- Price  -->
                <div class="form-group">
                  <label for="price">{{priceproduct}}</label>
                  <input
                    type="number"
                    class="form-control"
                    id="price"
                    name="price"
                    v-model="price"
                    readonly
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
                    class="btn btn-danger font-weight bolder"
                    @click="forceDeleteProduct(product.id)"
                  >{{forcedelete}}</button>
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
  name: "forceDeleteProduct",
  props: [
    "product",
    "forcedelete",
    "forcedeleteproduct",
    "nameproduct",
    "productiondate",
    "expirationdate",
    "priceproduct",
    "category",
    "barcode",
    "unitproduct",
    "statusproduct",
    "available",
    "unavailable",
    "descriptionproduct",
    "imageproduct",
    "cancel"
  ],

  data() {
    return {
      name: "",
      production_date: "",
      expiry_date: "",
      price: ""
    };
  },

  created() {
    this.name = this.product.name;
    this.production_date = this.product.production_date;
    this.expiry_date = this.product.expiry_date;
    this.price = this.product.price;
  },

  methods: {
    async forceDeleteProduct(product) {
      try {
        const response = await axios.delete(
          `http://localhost:8000/product/force-delete/${product}`
        );
        console.log(response);
        $(`#forceDeleteProduct${product}`).modal("hide");
        this.$emit("force_delete_product", product);
      } catch (error) {
        console.log(error);
      }
    }
  }
};
</script>
