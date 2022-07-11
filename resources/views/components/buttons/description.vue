<template>
  <div>
    <button
      data-toggle="modal"
      v-bind:data-target="`#description${product.id}`"
      class="btn btn-info btn-sm"
      aria-haspopup="true"
      aria-expanded="false"
    >{{descriptionproduct}}</button>

    <div class="modal-content" style="border: 0px;">
      <div
        class="modal fade"
        v-bind:id="`description${product.id}`"
        tabindex="-1"
        role="dialog"
        aria-labelledby="edit"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content text-left">
            <div class="modal-header">
              <h3 class="modal-title" id="exampleModalLabel">
                <strong>{{descriptionproduct}}</strong>
              </h3>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i aria-hidden="true" class="ki ki-close"></i>
              </button>
            </div>

            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <textarea class="form-control" rows="5" v-model="product.description" readonly></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">{{cancel}}</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  name: "description",
  props: ["product", "descriptionproduct", "cancel"]
};
</script>
