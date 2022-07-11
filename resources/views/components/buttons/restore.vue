<template>
  <div id="restore">
    <a
      data-toggle="modal"
      href="javascript:void(0)"
      v-bind:data-target="`#restoreProduct${product.id}`"
      class="btn btn-secondary btn-sm"
    >{{restore}}</a>

    <div class="modal-content" style="border: 0px;">
      <div
        class="modal fade"
        v-bind:id="`restoreProduct${product.id}`"
        tabindex="-1"
        role="dialog"
        aria-labelledby="edit"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content text-left">
            <div class="modal-header">
              <h3 class="modal-title" id="exampleModalLabel">
                <strong>{{restoreproduct}}</strong>
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
                <!-- Price -->
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
                    class="btn btn-primary font-weight bolder"
                    @click="restoreProduct(product.id)"
                  >{{restore}}</button>
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
import axios from "axios";

export default {
  name: "restoreProduct",
  props: [
    "product",
    "restore",
    "restoreproduct",
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
    this.name = this.$props.product.name;
    this.production_date = this.$props.product.production_date;
    this.expiry_date = this.$props.product.expiry_date;
    this.price = this.$props.product.price;
  },

  methods: {
    async restoreProduct(product) {
      try {
        const response = await axios.post(
          `http://localhost:8000/product/restore/${product}`
        );
        console.log(response);
        $(`#restoreProduct${product}`).modal("hide");
        this.$emit("restoreproduct", product);
      } catch (error) {
        console.log(error);
      }
    }
  }
};
</script>


