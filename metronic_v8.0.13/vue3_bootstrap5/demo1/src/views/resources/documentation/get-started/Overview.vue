<template>
  <!--begin::Card-->
  <div class="card">
    <!--begin::Card Body-->
    <div class="card-body p-10 p-lg-15">
      <div>
        <h2>Build Fast & Modern Admin Dashboards with {{ themeName }}.</h2>

        <p class="pt-10">
          {{ themeName }} - Bootstrap 5 Vue Multi-purpose Admin Dashboard Theme.
        </p>
      </div>
    </div>
    <!--end::Card Body-->
  </div>
  <!--end::Card-->
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import { setCurrentPageTitle } from "@/core/helpers/breadcrumb";
import { themeName } from "@/core/helpers/documentation";

export default defineComponent({
  name: "overview",
  setup() {
    onMounted(() => {
      setCurrentPageTitle("Overview");
    });

    return {
      themeName
    };
  }
});
</script>
