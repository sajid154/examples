<template>
  <!--begin::Card-->
  <div class="card">
    <!--begin::Card Body-->
    <div class="card-body p-10 p-lg-15">
      <Overview></Overview>
      <Usage></Usage>
      <IconColors></IconColors>
      <IconSizes></IconSizes>
    </div>
    <!--end::Card Body-->
  </div>
  <!--end::Card-->
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import { setCurrentPageTitle } from "@/core/helpers/breadcrumb";
import Overview from "@/views/resources/documentation/general/font-awesome/Overview.vue";
import Usage from "@/views/resources/documentation/general/font-awesome/Usage.vue";
import IconColors from "@/views/resources/documentation/general/font-awesome/IconColors.vue";
import IconSizes from "@/views/resources/documentation/general/font-awesome/IconSizes.vue";

export default defineComponent({
  name: "font-awesome",
  components: {
    Overview,
    Usage,
    IconColors,
    IconSizes
  },
  setup() {
    onMounted(() => {
      setCurrentPageTitle("Font Awesome");
    });
  }
});
</script>
