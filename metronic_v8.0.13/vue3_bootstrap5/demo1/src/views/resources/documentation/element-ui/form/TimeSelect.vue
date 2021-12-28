<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h1 class="anchor fw-bolder mb-5">
      <a href="#time-select"></a>
      TimeSelect
    </h1>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      Use Time Select for time input.
    </div>
    <!--end::Block-->
  </div>
  <EUIFixedTimePicker></EUIFixedTimePicker>
  <EUIFixedTimeRange></EUIFixedTimeRange>
</template>

<script>
import { defineComponent } from "vue";
import { setCurrentPageTitle } from "@/core/helpers/breadcrumb";
import EUIFixedTimePicker from "@/views/resources/documentation/element-ui/form/time-select/FixedTimePicker.vue";
import EUIFixedTimeRange from "@/views/resources/documentation/element-ui/form/time-select/FixedTimeRange.vue";

export default defineComponent({
  name: "time-select",
  components: {
    EUIFixedTimePicker,
    EUIFixedTimeRange
  },
  setup() {
    setCurrentPageTitle("TimeSelect");
  }
});
</script>
