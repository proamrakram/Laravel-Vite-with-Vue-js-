<template>
  <div id="tabel">
    <div
      v-if="is_message"
      class="alert alert-success alert-dismissible fade show"
      id="notificationdiv"
      role="alert"
    >
      <strong id="notification">{{getLocal('Notification')}}</strong>
      {{message}}
      <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>-->
    </div>

    <div class="ml-auto">
      <li class="nav-item search-box">
        <a class="nav-link waves-effect waves-dark" href="javascript:void(0)">
          <i class="ti-search font-16"></i>
        </a>

        <form class="app-search position-absolute">
          <input
            type="text"
            class="form-control"
            v-on:keydown.enter="searching"
            v-model="search"
            placeholder="Search &amp; enter"
          />
          <a class="srh-btn">
            <i class="ti-close"></i>
          </a>
        </form>
      </li>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="card bg-light">
          <div class="card-body">
            <div class="d-flex no-block align-items-center m-b-10">
              <h4 v-if="trashed" class="card-title">{{ getLocal('Products') }}</h4>
              <h4 v-if="!trashed" class="card-title">{{ getLocal('Deleted Products') }}</h4>

              <!-- <a href="{{ route('product.trash') }}" class="btn btn-success">{{ ('Trash') }}</a> -->

              <div class="ml-auto">
                <div class="d-inline">
                  <button
                    v-if="trashed"
                    type="button"
                    class="btn btn-secondary"
                    @click="getTrashedProducts"
                  >{{ getLocal('Trash') }}</button>
                  <button
                    v-if="!trashed"
                    type="button"
                    class="btn btn-primary"
                    @click="getProducts"
                  >{{ getLocal('Products') }}</button>
                </div>

                <div class="d-inline" v-if="trashed">
                  <addProduct
                    v-on:productadded="addProductNotification(current_page)"
                    v-bind:add="getLocal('Add')"
                    v-bind:adding="getLocal('Adding')"
                    v-bind:nameproduct="getLocal('Name')"
                    v-bind:productiondate="getLocal('Production Date')"
                    v-bind:expirationdate="getLocal('Expiration Date')"
                    v-bind:priceproduct="getLocal('Price')"
                    v-bind:category="getLocal('Category')"
                    v-bind:barcode="getLocal('Barcode')"
                    v-bind:unitproduct="getLocal('Unit')"
                    v-bind:statusproduct="getLocal('Status')"
                    v-bind:available="getLocal('Available')"
                    v-bind:unavailable="getLocal('Unavailable')"
                    v-bind:descriptionproduct="getLocal('Description')"
                    v-bind:imageproduct="getLocal('Image')"
                    v-bind:cancel="getLocal('Cancel')"
                  ></addProduct>
                </div>

                <div class="d-inline">
                  <button
                    v-if="trashed"
                    type="button"
                    class="btn btn-danger"
                    @click="deleteCollection"
                  >{{ getLocal('Delete Selected') }}</button>
                  <button
                    v-if="!trashed"
                    type="button"
                    class="btn btn-danger"
                    @click="forceDeleteCollection"
                  >{{ getLocal('Force Delete Selected') }}</button>
                </div>

                <div class="d-inline">
                  <button
                    v-if="!trashed"
                    type="button"
                    class="btn btn-secondary"
                    @click="restoreCollection"
                  >{{ getLocal('Restore Selected') }}</button>
                </div>
              </div>
            </div>

            <div class="table-responsive text-center">
              <table id="file_export" class="table bg-white table-bordered nowrap display">
                <thead>
                  <tr>
                    <th>
                      <div class="custom-checkbox form-check">
                        <input
                          class="custom-control-input"
                          type="checkbox"
                          id="allproducts"
                          v-model="selectAll"
                          v-on:change="selectAllIds"
                        />
                        <label class="custom-control-label" for="allproducts"></label>
                      </div>
                    </th>

                    <th>{{ getLocal('Image') }}</th>
                    <th>{{ getLocal('Name') }}</th>
                    <th>
                      <editProdcutionDates
                        v-if="trashed"
                        v-on:editproductiondate="editProductionDateNotification"
                        v-bind:productiondate="getLocal('Production Date')"
                        v-bind:savechanges="getLocal('Save Changes')"
                        v-bind:cancel="getLocal('Cancel')"
                        v-bind:messagetitle="getLocal('Modify the production date of the selected products')"
                      ></editProdcutionDates>
                      {{ getLocal('Production Date') }}
                    </th>
                    <th>
                      <editExpirationDates
                        v-if="trashed"
                        v-on:editexpirationdate="editExpirationDateNotification"
                        v-bind:expirationdate="getLocal('Expiration Date')"
                        v-bind:savechanges="getLocal('Save Changes')"
                        v-bind:cancel="getLocal('Cancel')"
                        v-bind:messagetitle="getLocal('Modify the expiration date of selected products')"
                      ></editExpirationDates>
                      {{ getLocal('Expiration Date') }}
                    </th>
                    <th>
                      <editPrices
                        v-if="trashed"
                        v-on:editprice="editPriceNotification"
                        v-bind:priceproduct="getLocal('Price')"
                        v-bind:savechanges="getLocal('Save Changes')"
                        v-bind:cancel="getLocal('Cancel')"
                        v-bind:messagetitle="getLocal('Modify the price of selected products')"
                      ></editPrices>
                      {{ getLocal('Price') }}
                    </th>
                    <th>
                      <editCategories
                        v-if="trashed"
                        v-on:editcategory="editCategoryNotification"
                        v-bind:category="getLocal('Category')"
                        v-bind:savechanges="getLocal('Save Changes')"
                        v-bind:cancel="getLocal('Cancel')"
                        v-bind:messagetitle="getLocal('Edit categories for selected products')"
                      ></editCategories>
                      {{ getLocal('Category') }}
                    </th>
                    <th>{{ getLocal('Barcode') }}</th>

                    <th>
                      <editUnits
                        v-if="trashed"
                        v-on:editunit="editUnitNotification"
                        v-bind:unitproduct="getLocal('Unit')"
                        v-bind:savechanges="getLocal('Save Changes')"
                        v-bind:cancel="getLocal('Cancel')"
                        v-bind:messagetitle="getLocal('Modify the unit for selected products')"
                      ></editUnits>
                      {{ getLocal('Unit') }}
                    </th>
                    <th>
                      <editStatus
                        v-if="trashed"
                        v-on:editstatus="editStatusNotification"
                        v-bind:statusproduct="getLocal('Status')"
                        v-bind:savechanges="getLocal('Save Changes')"
                        v-bind:active="getLocal('Active')"
                        v-bind:inactive="getLocal('Inactive')"
                        v-bind:cancel="getLocal('Cancel')"
                        v-bind:messagetitle="getLocal('Modify the status of selected products')"
                      ></editStatus>
                      {{ getLocal('Status') }}
                    </th>
                    <th>{{ getLocal('Description') }}</th>
                    <th v-if="trashed">{{ getLocal('Edit') }}</th>
                    <th v-if="trashed">{{ getLocal('Delete') }}</th>
                    <th v-if="!trashed">{{ getLocal('Restore') }}</th>
                    <th v-if="!trashed">{{ getLocal('Force Delete') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="product in products" :key="product.id">
                    <td>
                      <div class="custom-checkbox form-check">
                        <input
                          class="custom-control-input checkitem"
                          type="checkbox"
                          v-model="ids"
                          v-bind:value="`${product.id}`"
                          v-bind:id="`pro${ product.id }`"
                        />
                        <label class="custom-control-label" v-bind:for="`pro${ product.id }`"></label>
                      </div>
                    </td>

                    <td>
                      <img
                        v-bind:src="`storage${product.image}`"
                        alt="user"
                        class="rounded-circle"
                        width="50"
                      />
                    </td>

                    <td>{{product.name}}</td>
                    <td>{{product.production_date}}</td>
                    <td>{{product.expiry_date}}</td>
                    <td>{{product.price}}</td>
                    <td>{{product.category.ar_name}}</td>
                    <td>{{product.barcode_number}}</td>
                    <td>{{product.unit}}</td>
                    <td class="footable-last-visible" style="display: table-cell;">
                      <span
                        class="label label-table label-success"
                        v-if="product.is_available == 1"
                      >{{ getLocal('Available') }}</span>
                      <span
                        class="label label-table label-danger"
                        v-else
                      >{{ getLocal('Unavailable') }}</span>
                    </td>

                    <td>
                      <descriptionProduct
                        v-bind:product="product"
                        v-bind:descriptionproduct="getLocal('Description')"
                        v-bind:cancel="getLocal('Cancel')"
                      ></descriptionProduct>
                    </td>

                    <td v-if="trashed">
                      <editProduct
                        v-bind:product="product"
                        v-on:productupdated="editProductNotification(current_page)"
                        v-bind:edit="getLocal('Edit')"
                        v-bind:editproduct="getLocal('Editing')"
                        v-bind:nameproduct="getLocal('Name')"
                        v-bind:productiondate="getLocal('Production Date')"
                        v-bind:expirationdate="getLocal('Expiration Date')"
                        v-bind:priceproduct="getLocal('Price')"
                        v-bind:category="getLocal('Category')"
                        v-bind:barcode="getLocal('Barcode')"
                        v-bind:unitproduct="getLocal('Unit')"
                        v-bind:statusproduct="getLocal('Status')"
                        v-bind:available="getLocal('Available')"
                        v-bind:unavailable="getLocal('Unavailable')"
                        v-bind:descriptionproduct="getLocal('Description')"
                        v-bind:imageproduct="getLocal('Image')"
                        v-bind:cancel="getLocal('Cancel')"
                        v-bind:update="getLocal('Update')"
                      ></editProduct>
                    </td>

                    <td v-if="trashed">
                      <deleteProduct
                        v-bind:product="product"
                        v-on:delete="deleteNotification(current_page)"
                        v-bind:deleteproduct="getLocal('Delete')"
                        v-bind:deleting="getLocal('Deleting')"
                        v-bind:messagesure="getLocal('Are you sure you want to delete this product?')"
                        v-bind:cancel="getLocal('Cancel')"
                      ></deleteProduct>
                    </td>

                    <td v-if="!trashed">
                      <restoreProduct
                        v-bind:product="product"
                        v-on:restoreproduct="restoreProductNotification(current_page)"
                        v-bind:restore="getLocal('Restore')"
                        v-bind:restoreproduct="getLocal('Restore Product')"
                        v-bind:nameproduct="getLocal('Name')"
                        v-bind:productiondate="getLocal('Production Date')"
                        v-bind:expirationdate="getLocal('Expiration Date')"
                        v-bind:priceproduct="getLocal('Price')"
                        v-bind:category="getLocal('Category')"
                        v-bind:barcode="getLocal('Barcode')"
                        v-bind:unitproduct="getLocal('Unit')"
                        v-bind:statusproduct="getLocal('Status')"
                        v-bind:available="getLocal('Available')"
                        v-bind:unavailable="getLocal('Unavailable')"
                        v-bind:descriptionproduct="getLocal('Description')"
                        v-bind:imageproduct="getLocal('Image')"
                        v-bind:cancel="getLocal('Cancel')"
                      ></restoreProduct>
                    </td>

                    <td v-if="!trashed">
                      <forceDeleteProduct
                        v-bind:product="product"
                        v-on:force_delete_product="forceDeleteProductNotification(current_page)"
                        v-bind:forcedelete="getLocal('Force Delete')"
                        v-bind:forcedeleteproduct="getLocal('Force Delete Product')"
                        v-bind:nameproduct="getLocal('Name')"
                        v-bind:productiondate="getLocal('Production Date')"
                        v-bind:expirationdate="getLocal('Expiration Date')"
                        v-bind:priceproduct="getLocal('Price')"
                        v-bind:category="getLocal('Category')"
                        v-bind:barcode="getLocal('Barcode')"
                        v-bind:unitproduct="getLocal('Unit')"
                        v-bind:statusproduct="getLocal('Status')"
                        v-bind:available="getLocal('Available')"
                        v-bind:unavailable="getLocal('Unavailable')"
                        v-bind:descriptionproduct="getLocal('Description')"
                        v-bind:imageproduct="getLocal('Image')"
                        v-bind:cancel="getLocal('Cancel')"
                      ></forceDeleteProduct>
                    </td>
                  </tr>
                </tbody>

                <td
                  v-if="!this.products.length"
                  colspan="12"
                  class="alert alert-warning text-center text-center"
                >
                  <h4>{{ getLocal('No Products') }}</h4>
                </td>
              </table>

              <div class="pagination">
                <ul class="pagination">
                  <li class="page-item">
                    <button
                      type="button"
                      class="page-link"
                      v-on:click="prevPage(current_page)"
                      aria-label="Previous"
                    >
                      <span aria-hidden="true">&laquo;</span>
                      <span class="sr-only">Previous</span>
                    </button>
                  </li>

                  <li class="page-item" v-for="link in links" :key="link.index">
                    <button
                      type="button"
                      class="page-link"
                      v-on:click="getProducts(link.label)"
                    >{{link.label}}</button>
                  </li>

                  <li class="page-item">
                    <button
                      type="button"
                      class="page-link"
                      v-on:click="nextPage(current_page)"
                      aria-label="Next"
                    >
                      <span aria-hidden="true">&raquo;</span>
                      <span class="sr-only">Next</span>
                    </button>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

import AddProduct from "./buttons/addProduct.vue";
import EditProduct from "./buttons/editProduct.vue";
import DescriptionProduct from "./buttons/description.vue";
import DeleteProduct from "./buttons/delete.vue";
import ForceDeleteProduct from "./buttons/forceDelete.vue";
import RestoreProduct from "./buttons/restore.vue";

import Lang from "lang.js";
import EditProdcutionDates from "./buttons/multi/editProdcutionDates.vue";
import EditExpirationDates from "./buttons/multi/editExpirationDates.vue";
import EditPrices from "./buttons/multi/editPrices.vue";
import EditCategories from "./buttons/multi/editCategories.vue";
import EditUnits from "./buttons/multi/editUnits.vue";
import EditStatus from "./buttons/multi/editStatus.vue";

const default_locale = window.default_language;
const fallback_locale = window.fallback_locale;
const messages = window.messages;
var trans;

export default {
  name: "tableVue",
  components: {
    AddProduct,
    EditProduct,
    DescriptionProduct,
    DeleteProduct,
    ForceDeleteProduct,
    RestoreProduct,
    EditProdcutionDates,
    EditExpirationDates,
    EditPrices,
    EditCategories,
    EditUnits,
    EditStatus
  },

  data() {
    return {
      trashed: true,
      selectAll: false,
      is_message: false,
      search: "",
      message: "",
      locale: "ar",
      fallback: "ar",
      translations: null,
      ids: [],
      categories: [],
      products: [],
      current_page: 1,
      data: [],
      first_page_url: "",
      from: 1,
      last_page: 1,
      last_page_url: "",
      links: [],
      next_page_url: "",
      path: "",
      per_page: 10,
      prev_page_url: "",
      to: this.last_page,
      total: 0
    };
  },

  created() {
    trans = new Lang({ messages, default_locale, fallback_locale });
    console.log(trans, trans.locale);
    this.translations = trans.messages.json.ar;
    this.locale = trans.locale == "en" ? "en" : this.fallback;
    this.getCategories();
    this.getProducts();
  },

  methods: {
    getLocal(value) {
      if (this.locale == "ar") {
        for (var key in this.translations) {
          if (this.translations.hasOwnProperty(key)) {
            if (key == value) {
              console.log(
                "aljdbsakjfbclkajsbfcjlkasbclkjasblcvbasljcbalksj",
                this.locale,
                key,
                value
              );

              return this.translations[key];
            }
          }
        }

        return value;
      }

      if (this.locale == "en") {
        for (var key in this.translations) {
          if (this.translations.hasOwnProperty(key)) {
            if (key == value) {
              return key;
            }
          }
        }

        return value;
      }
    },

    selectAllIds() {
      if (this.selectAll) {
        this.ids = [];
        for (let i = 0; i < this.products.length; i++) {
          this.ids.push(this.products[i].id);
        }
      } else {
        this.ids = [];
      }
    },

    async getCategories() {
      try {
        const response = await axios.get(
          "http://localhost:8000/category/index"
        );
        this.categories = response.data.categories;
      } catch (error) {
        console.log(error);
      }
    },

    async getProducts(page = 1) {
      this.trashed = true;

      try {
        const response = await axios.get(
          "http://localhost:8000/product/index?page=" + page
        );

        this.products = response.data.products.data;

        this.registerPagination(response.data.products);

        console.log(
          response.data.products,
          response.data.products.links[1].url.split("?page=")[1]
        );
      } catch (error) {
        console.log(error);
      }
    },

    async getTrashedProducts(page = 1) {
      this.trashed = false;

      try {
        const response = await axios.get(
          "http://localhost:8000/product/trash?page=" + page
        );

        this.products = response.data.products.data;

        this.registerPagination(response.data.products);

        console.log(
          response.data.products,
          response.data.products.links[1].url.split("?page=")[1]
        );
      } catch (error) {
        console.log(error);
      }
    },

    async searching(e, page = 1) {
      e.preventDefault();
      if (this.trashed) {
        const response = await axios.post(
          `http://localhost:8000/searching/search-products?page=${page}`,
          { search: this.search }
        );
        this.products = response.data.products.data;
        this.registerPagination(response.data.products);
      } else {
        const response = await axios.post(
          `http://localhost:8000/searching/search-trashed-products?page=${page}`,
          { search: this.search }
        );
        this.products = response.data.products.data;
        this.registerPagination(response.data.products);
      }
    },

    registerPagination(data) {
      this.current_page = data.current_page;
      this.to = data.to;
      this.total = data.total;
      this.first_page_url = data.first_page_url;
      this.from = data.from;
      this.last_page = data.last_page;
      this.last_page_url = data.last_page_url;
      data.links.splice(0, 1);
      data.links.splice(this.last_page, this.last_page + 1);
      this.links = data.links;
      this.next_page_url = data.next_page_url;
      this.path = data.path;
      this.per_page = data.per_page;
      this.prev_page_url = data.prev_page_url;
    },

    nextPage(current_page) {
      if (!(current_page == this.last_page)) {
        if (this.trashed) {
          this.getProducts(current_page + 1);
        } else {
          this.getTrashedProducts(current_page + 1);
        }
      }
    },

    prevPage(current_page) {
      if (current_page < 0 || current_page == 0) {
        current_page = 2;
      }

      if (!(current_page == 1)) {
        if (this.trashed) {
          this.getProducts(current_page - 1);
        } else {
          this.getTrashedProducts(current_page - 1);
        }
      }
    },

    deleteNotification(current_page) {
      this.getProducts(current_page);
      this.is_message = false;
      this.is_message = true;
      this.message = this.getLocal("Product Deleted Successfully");
    },

    addProductNotification(current_page) {
      this.getProducts(current_page);
      this.is_message = false;
      this.is_message = true;

      this.message = this.getLocal("Product Added Successfully");
    },

    editProductNotification(current_page) {
      this.getProducts(current_page);
      this.is_message = false;
      this.is_message = true;
      this.message = this.getLocal("Product Updated Successfully");
    },

    restoreProductNotification(current_page) {
      this.getTrashedProducts(current_page);
      this.is_message = false;
      this.is_message = true;
      this.message = this.getLocal("Product Restored Successfully");
    },

    forceDeleteProductNotification(current_page) {
      this.getTrashedProducts(current_page);
      this.is_message = false;
      this.is_message = true;
      this.message = this.getLocal("Product Deleted Successfully");
    },

    async editProductionDateNotification(value) {
      try {
        const response = await axios.post(
          "http://localhost:8000/multiple-process/edit-production-date-products",
          {
            ids: this.ids,
            production_date: value
          }
        );

        this.ids = [];
        this.selectAll = false;
        this.is_message = false;
        this.is_message = true;
        this.message = this.getLocal(
          "Product production dates have been modified successfully"
        );
        this.getProducts();
      } catch (error) {
        console.log(error);
      }
    },

    async editExpirationDateNotification(value) {
      console.log(value);
      try {
        const response = await axios.post(
          "http://localhost:8000/multiple-process/edit-expiry-date-products",
          {
            ids: this.ids,
            expiry_date: value
          }
        );

        this.ids = [];
        this.selectAll = false;
        this.is_message = false;
        this.is_message = true;
        this.message = this.getLocal(
          "Product expiry dates have been modified successfully"
        );
        this.getProducts();
      } catch (error) {
        console.log(error);
      }
    },

    async editPriceNotification(value) {
      try {
        const response = await axios.post(
          "http://localhost:8000/multiple-process/edit-price-products",
          {
            ids: this.ids,
            price: value
          }
        );

        this.ids = [];
        this.selectAll = false;
        this.is_message = false;
        this.is_message = true;
        this.message = this.getLocal(
          "Product prices have been modified successfully"
        );
        this.getProducts();
      } catch (error) {
        console.log(error);
      }
    },

    async editStatusNotification(value) {
      console.log(value);

      try {
        const response = await axios.post(
          "http://localhost:8000/multiple-process/edit-availability-products",
          {
            ids: this.ids,
            is_available: value
          }
        );

        this.ids = [];
        this.selectAll = false;
        this.is_message = false;
        this.is_message = true;
        this.message = this.getLocal(
          "Product availability have been modified successfully"
        );
        this.getProducts();
      } catch (error) {
        console.log(error);
      }
    },

    async editUnitNotification(value) {
      console.log(value);
      try {
        const response = await axios.post(
          "http://localhost:8000/multiple-process/edit-unit-products",
          {
            ids: this.ids,
            unit: value
          }
        );

        this.ids = [];
        this.selectAll = false;
        this.is_message = false;
        this.is_message = true;
        this.message = this.getLocal(
          "Product units have been modified successfully"
        );
        this.getProducts();
      } catch (error) {
        console.log(error);
      }
    },

    async editCategoryNotification(value) {
      console.log(value);
      try {
        const response = await axios.post(
          "http://localhost:8000/multiple-process/edit-category-products",
          {
            ids: this.ids,
            category_id: value
          }
        );

        this.ids = [];
        this.selectAll = false;
        this.is_message = false;
        this.is_message = true;
        this.message = this.getLocal(
          "Product categories have been modified successfully"
        );
        this.getProducts();
      } catch (error) {
        console.log(error);
      }
    },

    async deleteCollection() {
      try {
        const response = await axios.post(
          "http://localhost:8000/multiple-process/delete-products",
          {
            ids: this.ids
          }
        );

        this.ids = [];
        this.selectAll = false;
        this.is_message = false;
        this.is_message = true;
        this.message = this.getLocal("Products deleted successfully");
        this.getProducts();
      } catch (error) {
        console.log(error);
      }
    },

    async forceDeleteCollection() {
      try {
        const response = await axios.post(
          "http://localhost:8000/multiple-process/force-delete-products",
          {
            ids: this.ids
          }
        );
        this.ids = [];
        this.selectAll = false;
        this.is_message = false;
        this.is_message = true;
        this.message = this.getLocal("Products deleted successfully");
        this.getTrashedProducts();
      } catch (error) {
        console.log(error);
      }
    },

    async restoreCollection() {
      try {
        const response = await axios.post(
          "http://localhost:8000/multiple-process/restore-products",
          {
            ids: this.ids
          }
        );
        this.ids = [];
        this.selectAll = false;
        this.message = "Products restored successfully";
        this.is_message = false;
        this.is_message = true;
        this.message = this.getLocal("Products restored successfully");
        this.getTrashedProducts();
      } catch (error) {
        console.log(error);
      }
    }
  }
};
</script>




