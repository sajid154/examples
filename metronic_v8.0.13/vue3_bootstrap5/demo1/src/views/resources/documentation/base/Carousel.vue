<template>
  <!--begin::Card-->
  <div class="card">
    <!--begin::Card Body-->
    <div class="card-body p-10 p-lg-15">
      <Overview></Overview>

      <CustomExample></CustomExample>
    </div>
    <!--end::Card Body-->
  </div>
  <!--end::Card-->
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import { setCurrentPageTitle } from "@/core/helpers/breadcrumb";
import Overview from "@/views/resources/documentation/base/carousel/Overview.vue";
import CustomExample from "@/views/resources/documentation/base/carousel/CustomExample.vue";

export default defineComponent({
  name: "carousel",
  components: {
    Overview,
    CustomExample
  },
  setup() {
    onMounted(() => {
      setCurrentPageTitle("Carousel");
    });
  }
});
</script>
