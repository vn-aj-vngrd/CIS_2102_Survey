<template>
  <div class="container col-xxl-8 px-4 py-5">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
      <div class="col-10 col-sm-8 col-lg-6"></div>
      <div class="col-lg-6">
        <h3 class="display-5 fw-bold lh-1 mb-3">
          {{ $route.query.name }}
        </h3>
        <h6 class="text-muted border-top pt-4 border-bottom pb-4">
          Date Created: {{ $filters.formatDate($route.query.created_at) }}
          <br />
          Date Updated: {{ $filters.formatDate($route.query.updated_at) }}
        </h6>

        <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-4">
          <button
            type="button"
            class="btn btn-outline-primary btn-lg px-4 me-md-2"
          >
            Update
          </button>
          <button type="button" class="btn btn-outline-danger btn-lg px-4">
            Delete
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "SurveyInfo",
};
</script>