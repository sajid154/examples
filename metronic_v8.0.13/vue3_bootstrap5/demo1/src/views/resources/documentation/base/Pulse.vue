<template>
  <!--begin::Card-->
  <div class="card">
    <!--begin::Card Body-->
    <div class="card-body p-10 p-lg-15">
      <Overview></Overview>

      <Basic></Basic>

      <Colors></Colors>

      <BorderWidth></BorderWidth>
    </div>
    <!--end::Card Body-->
  </div>
  <!--end::Card-->
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import { setCurrentPageTitle } from "@/core/helpers/breadcrumb";
import Overview from "@/views/resources/documentation/base/pulse/Overview.vue";
import Basic from "@/views/resources/documentation/base/pulse/Basic.vue";
import Colors from "@/views/resources/documentation/base/pulse/Colors.vue";
import BorderWidth from "@/views/resources/documentation/base/pulse/BorderWidth.vue";

export default defineComponent({
  name: "pulse",
  components: {
    Overview,
    Basic,
    Colors,
    BorderWidth
  },
  setup() {
    onMounted(() => {
      setCurrentPageTitle("Pulse");
    });
  }
});
</script>
