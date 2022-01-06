<template>
  <button
    type="button"
    :class="myclass"
    data-bs-toggle="modal"
    data-bs-target="#create"
  >
    Create Survey
  </button>

  <div
    class="modal fade text-start"
    id="create"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            <b>Create Survey</b>
          </h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label"
                >Survey Name</label
              >
              <input
                type="text"
                class="form-control"
                name="surveyName"
                required
              />
            </div>

            <!-- Note: jquery to add more input fields or questions -->
            <div class="form-group" v-for="(input, k) in inputs" :key="k">
              <input type="text" class="form-control" v-model="input.name" />
              <span>
                <i
                  class="fas fa-minus-circle"
                  @click="remove(k)"
                  v-show="k || (!k && inputs.length > 1)"
                ></i>
                <i
                  class="fas fa-plus-circle"
                  @click="add(k)"
                  v-show="k == inputs.length - 1"
                ></i>
              </span>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button @click="create" class="btn btn-primary">Create</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Create",
  props: {
    myclass: String,
  },
  methods: {
    create() {
      $("#create").modal("hide");
    },
  },
};
</script>
