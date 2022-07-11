<template>
  <div style="display: inherit;display: inline-block;">
    <a
      data-toggle="modal"
      href="javascript:void(0)"
      data-target="#addProduct"
      class="btn btn-success"
    >{{ add }}</a>

    <div class="modal-content" style="border: 0px;">
      <div
        class="modal fade"
        id="addProduct"
        tabindex="-1"
        role="dialog"
        aria-labelledby="edit"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content text-left">
            <div class="modal-header">
              <h3 class="modal-title" id="exampleModalLabel">
                <strong>{{ adding }}</strong>
              </h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i aria-hidden="true" class="ki ki-close"></i>
              </button>
            </div>

            <!-- {{-- Edit Product --}} -->
            <div class="modal-body">
              <form>
                <!-- @csrf

                        @if ($method === 'PUT')
                            @method('PUT')
                @endif-->

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">{{ nameproduct }}</label>
                      <input type="text" class="form-control" id="name" v-model="name" required />
                    </div>
                  </div>

                  <!-- {{-- Production Date --}} -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="production_date">{{ productiondate }}</label>
                      <input type="date" class="form-control" v-model="production_date" required />
                    </div>
                  </div>
                </div>

                <div class="row">
                  <!-- {{-- Expired Date --}} -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="expiry_date">{{ expirationdate }}</label>
                      <input type="date" class="form-control" v-model="expiry_date" required />
                    </div>
                  </div>

                  <!-- {{-- Price --}} -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="price">{{ priceproduct }}</label>
                      <input type="number" class="form-control" v-model="price" required />
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <!-- {{-- Categroy --}} -->
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
                  </div>

                  <!-- {{-- BarCode Number --}} -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="barcode_number">{{ barcode }}</label>
                      <input type="text" class="form-control" v-model="barcode_number" required />
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <!-- {{-- Unit --}} -->
                    <div class="form-group">
                      <label for="unit">{{ unitproduct }}</label>
                      <select class="form-control" id="unit" v-model="unit" required>
                        <option v-for="unit in units" :key="unit.index" :value="`${unit}`">{{unit}}</option>
                      </select>
                    </div>
                  </div>

                  <!-- {{-- is_available --}} -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="is_available">{{ statusproduct }}</label>
                      <select
                        class="form-control"
                        id="is_available"
                        v-model="is_available"
                        required
                      >
                        <option value="1">{{ available }}</option>
                        <option value="0">{{ unavailable }}</option>
                      </select>
                    </div>
                  </div>
                </div>

                <!-- {{-- Details --}} -->
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="details">{{ descriptionproduct }}</label>
                      <textarea
                        class="form-control"
                        id="details"
                        v-model="description"
                        rows="3"
                        required
                      >'description' </textarea>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="image">{{ imageproduct }}</label>
                      <input type="file" class="form-control" v-on:change="SelectedImage" required />
                    </div>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ cancel }}</button>
                  <button type="button" class="btn btn-primary" @click="saveproduct">{{ add }}</button>
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
  name: "addProduct",
  props: [
    "add",
    "adding",
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
      categories: [],
      units: [],
      name: "",
      production_date: "",
      expiry_date: "",
      price: "",
      category_id: "",
      barcode_number: "",
      unit: "",
      is_available: "",
      description: "",
      image: null
    };
  },
  created() {
    this.getCategories();
    this.getUnits();
  },
  methods: {
    SelectedImage(e) {
      console.log("Images");
      this.image = e.target.files[0];
      console.log(this.image);
    },

    async getCategories() {
      const response = await axios.get("http://localhost:8000/category/index");
      this.categories = response.data.categories;
    },

    async getUnits() {
      const response = await axios.get("http://localhost:8000/product/units");
      this.units = response.data.units;
    },

    async saveproduct() {
      try {
        const formData = new FormData();
        formData.append("image", this.image);
        formData.append("name", this.name);
        formData.append("production_date", this.production_date);
        formData.append("expiry_date", this.expiry_date);
        formData.append("price", this.price);
        formData.append("category_id", this.category_id);
        formData.append("barcode_number", this.barcode_number);
        formData.append("unit", this.unit);
        formData.append("is_available", this.is_available);
        formData.append("description", this.description);

        const response = await axios.post(
          "http://localhost:8000/product/store",
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data"
            }
          }
        );

        if (response.status == 200) {
          console.log("cdscsdcds");
          this.name = "";
          this.production_date = "";
          this.expiry_date = "";
          this.price = "";
          this.category_id = "";
          this.barcode_number = "";
          this.unit = "";
          this.is_available = "";
          this.description = "";
          this.image = null;
          $("#addProduct").modal("hide");
          this.$emit("productadded", true);
        }
      } catch (error) {
        console.log(error);
      }
    }
  }
};
</script>
