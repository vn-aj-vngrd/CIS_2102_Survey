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
          <div class="mb-3">
            <label for="survey-name" class="col-form-label">Survey Name</label>
            <input
              type="text"
              class="form-control"
              v-model="surveyName"
              required
            />
          </div>
          <label for="survey-questions" class="col-form-label"
            >Survey Questions</label
          >
          <div class="row g-2 mb-2" v-for="(question, k) in questions" :key="k">
            <div class="col">
              <input
                type="text"
                class="form-control"
                v-model="question.text"
              />
            </div>
            <div class="col-auto">
              <button
                class="btn btn-success btn-sm me-2 mt-1"
                @click="add(k)"
                v-show="k == questions.length - 1"
              >
                Add
              </button>
              <button
                class="btn btn-danger btn-sm mt-1"
                @click="remove(k)"
                v-show="k || (!k && questions.length > 1)"
              >
                Remove
              </button>
            </div>
          </div>
          
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
  data() {
    return {
      surveyName: "",
      questions: [
        {
          text: "",
        },
      ],
    };
  },
  methods: {
    add(index) {
      this.questions.push({ text: "" });
    },
    remove(index) {
      this.questions.splice(index, 1);
    },
    create() {
      // $("#create").modal("hide");
      console.log(this.questions);
    },
  },
};
</script>
